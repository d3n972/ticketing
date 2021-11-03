<?php

namespace App\Http\Livewire;

use App\Events\IssueFiled;
use App\Models\Attachment;
use App\Models\Issue;
use App\Models\Severity;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Livewire\WithFileUploads;
use function Ramsey\Uuid\v4;

class CreateTicket extends Component
{
    use WithFileUploads;

    public $owner;
    public $title;
    public $severity;
    public $project;
    public $description;
    public $due_at;
    public $attachments = [];

    public $rules = [
        'owner' => 'max:20',
        'title' => 'required|max:255',
        'severity' => 'max:20',
        'project' => 'max:20',
        'due_at' => 'date',
        'description' => 'required|max:65565',
        'attachments.*' => 'max:10240', // 1MB Max

    ];

    public function getTeams()
    {
        if (Auth::user()->belongsToTeam(Team::where('id', 1)->first())) {
            return Team::all()->all();
        } else {
            return Auth::user()->user()->allTeams();
        }
    }

    public function submit(Request $r)
    {
        if ($this->due_at == null) {
            $this->due_at = Carbon::now();
        }
        $validatedData = $this->validate();


        $validatedData['author'] = $r->user()->id;
        $i = new Issue();
        $i->author = $validatedData['author'];
        $i->title = $validatedData['title'];
        $i->severity = $validatedData['severity'] ?? 1;
        $i->project = $validatedData['project'] ?? 1;
        $i->content = $validatedData['description'];
        $i->due_at = $validatedData['due_at'];
        $i->assignee = 1;
        if ($i->saveOrFail() && isset($validatedData['attachments'])) {

            foreach ($validatedData['attachments'] as $attachment) {
                $fn = v4();
                $attachment->storeAs('attachments', $fn);
                $a = new Attachment();
                $a->issue = $i->id;
                $a->size = $attachment->getSize();
                $a->filename = $fn;
                $a->original_name = $attachment->getClientOriginalName();
                $a->created_by = Auth::user();
                $a->save();

            }
        }
        Mail::to($r->user())->send((new \App\Mail\IssueFiled($i))->build());

        session()->flash('message', __('Ticket has been created: ') . $i->id);

    }


    public function render(Request $r)
    {
        if (!$r->user()->tokenCan('site:read-write')) {
            return 404;
        }
        $sevs = Severity::all();
        $teams = $this->getTeams();


        return view('livewire.create-ticket', [
            "severities" => $sevs,
            "teams" => $teams,
            "u" => $r->user(),
            "mindate" => Carbon::now()->nextWeekday()->format('Y-m-d')
        ]);

    }
}
