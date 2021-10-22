<?php

namespace App\Http\Livewire;

use App\Models\User;
use Error;
use LivewireUI\Modal\ModalComponent;

class AssignTask extends ModalComponent
{
    public $issue;
    public $assignee;
    protected $rules=[
        'assignee'=>'max:25'
    ];
    public function submit(){
        $validatedData = $this->validate();
        $this->issue->assignee=$validatedData["assignee"];
        if(!$this->issue->save()){
            throw new Error("FAIL");
        }
    }
    public function mount(\App\Models\Issue $issue)
    {


        $this->issue = $issue;
    }
    public function render()
    {
        $u=User::all();
        return view('livewire.assign-task',['issue'=>$this->issue,"users"=>$u]);
    }
}
