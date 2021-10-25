<?php

namespace App\Http\Livewire;

use App\Models\Issue;
use App\Models\User;
use Error;
use LivewireUI\Modal\ModalComponent;

class AssignTask extends ModalComponent
{
  /**
   * @var Issue
   */
    public $issue;
    public $assignee;
    protected $rules=[
        'assignee'=>'max:25'
    ];
    public function submit(){
        $validatedData = $this->validate();
        $this->issue->assignee=$validatedData["assignee"]??1;
        if(!$this->issue->save()){
            throw new Error("FAIL");
        }
      session()->flash('message', __('Ticket has been assigned to').' '.User::where('id','=', $this->issue->assignee)->get()[0]->name);
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
