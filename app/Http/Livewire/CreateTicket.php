<?php

namespace App\Http\Livewire;

use App\Models\Issue;
use Illuminate\Http\Request;
use Livewire\Component;

class CreateTicket extends Component
{
    public $owner;
    public $title;
    public $severity;
    public $project;
    public $description;


    public $rules=[
        'owner'=>'max:20',
        'title'=>'required|max:255',
        'severity'=>'max:20',
        'project'=>'max:20',
        'description'=>'required|max:65565'
    ];
    public function submit(Request $r) {

        $validatedData = $this->validate();
        $validatedData['author']=$r->user()->id;
        $i=new Issue();
        $i->author=$validatedData['author'];
        $i->title=$validatedData['title'];
        $i->severity=$validatedData['severity'];
        $i->project=$validatedData['project'];
        $i->content=$validatedData['description'];
        $i->save();

        dd([$validatedData,$i]);

    }

    public function render()
    {
        return view('livewire.create-ticket');
    }
}
