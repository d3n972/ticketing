<?php

namespace App\Models;

use App\Extensions\Auditable;
use App\Extensions\AuditEntryTypes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = ['*'];
    const STATUS_LOCKED = 1;
    const STATUS_OPEN = 0;
    const STATUS_CREATED = -1;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {

            /**
             * Check if we have a due date, if not set it to today +30 working days.
             */
            if (!isset($model->due_at) || $model->due_at == null) {
                $model->due_at = Carbon::now()->addWeekdays(30);
            }
            switch ($model->severity) {
                case 0:
                    $currDueAt = Carbon::parse($model->due_at);
                    /**
                     * If the ticket is not urgent or it's informational onyl(lvl 1) we force
                     * the due date to today+30 business days.
                     */
                    if ($currDueAt->diffInDays(Carbon::now()) < 30) {
                        $model->due_at = Carbon::now()->addWeekdays(30);
                    }
                    break;
                case 4/*Major*/ :
                    $model->due_at = Carbon::now()->addWeekdays(14);
                    break;
                case 5/*Severe*/ :
                    $model->due_at = Carbon::now()->addWeekdays(5)->setHour(8);
                    break;
                case 6/*Critical*/ :
                    $model->due_at = Carbon::now()->nextWeekday()->setHour(8);
                    break;
                default:
                    //don't touch the due date
                    break;
            }
            $ticketIdInstance = $model->getTicketIdModel();
            $model->ticket_id = $ticketIdInstance->getNext();
        });

    }

    public static function getTicketById($id){
        return static::with('author', 'assignee', 'severity')->where('id','=',$id)->orWhere('ticket_id','=',$id)->first();
    }
    public function getCreatedAt(){
        $c= Carbon::parse($this->created_at);
        return $c->format('Y. m. d. H:i');
    }
    public function getContent(){
        return  Str::markdown($this->content);
    }
    public function getTicketIdModel()
    {
        $ticketIdInstance = TicketId::where('project', '=', $this->project()->first()->id)->first();
        if ($ticketIdInstance == null) {
            $tid = new TicketId();
            $tid->project = $this->project()->first()->id;
            $tid->pattern = "T-######";
            $tid->current = 1;
            $tid->save();
            $ticketIdInstance = $this->getTicketIdModel();
        }
        return $ticketIdInstance;
    }

    public function assignee()
    {
        return $this->hasOne(User::class, 'id', 'assignee')->latest();
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author')->latest();
    }

    public function severity()
    {
        return $this->hasOne(Severity::class, 'id', 'severity')->latest();
    }

    public function project()
    {
        return $this->hasOne(Team::class, 'id', 'project')->latest();
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'issue')->latest()->get();
    }

    public function isWorkInProgress()
    {
        return false;
    }
    public function getComments(){
        return Comment::where('issue',$this->id)->get()->all();
    }
}
