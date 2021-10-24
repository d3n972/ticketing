<?php

namespace App\Http\Livewire;

use App\Events\IssueFiled;
use App\Models\Issue;
use App\Models\Severity;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class CreateTicket extends Component
{
    public $owner;
    public $title;
    public $severity;
    public $project;
    public $description;
    public $due_at;

    public $rules=[
        'owner'=>'max:20',
        'title'=>'required|max:255',
        'severity'=>'max:20',
        'project'=>'max:20',
        'due_at'=>'required',
        'description'=>'required|max:65565'
    ];
    public function submit(Request $r) {

        $validatedData = $this->validate();

        $validatedData['author']=$r->user()->id;
        $i=new Issue();
        $i->author=$validatedData['author'];
        $i->title=$validatedData['title'];
        $i->severity=$validatedData['severity']??1;
        $i->project=$validatedData['project']??1;
        $i->content=$validatedData['description'];
        $i->due_at=$validatedData['due_at'];
        $i->assignee = 1;
        if($i->save()){
            //IssueFiled::dispatch($i);
            Mail::to($r->user())->send((new \App\Mail\IssueFiled($i))->build());
        }

        session()->flash('message', 'Post successfully updated.');

    }

    public function render(Request $r)
    {
       if(!$r->user()->tokenCan('site:read-write')){
            return 404;
       }
        $sevs=Severity::all();
        $teams=Team::all();
        return view('livewire.create-ticket',[
            "severities"=>$sevs,
            "teams"=>$teams,
            "u"=>$r->user(),
            "mindate"=>Carbon::now()->nextWeekday()->format('Y-m-d')
        ]);

    }
}
