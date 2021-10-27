<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
            $model->ticket_id=TicketId::where('id',$model->project()->get()[0]->id)->get()[0]->getNext();
        });

    }

        static::updated(function ($model) {

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
}
