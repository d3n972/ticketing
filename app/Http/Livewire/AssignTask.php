<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Issue;
use App\Models\User;
use Error;
use Illuminate\Support\Facades\Auth;
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
    private function getAssigneeModel($id=null){
        return User::where('id','=', $id??$this->issue->assignee)->first();
    }
    public function submit(){
        $validatedData = $this->validate();
        $this->issue->assignee=$validatedData["assignee"]??1;
        if(!$this->issue->save()){
            throw new Error("FAIL");
        }
      session()->flash('message', __('Ticket has been assigned to').' '.$this->getAssigneeModel($this->issue->assignee)->name);
        $c = new Comment();
        $c->issue=$this->issue->id;
        $c->author=Auth::user()->id;
        $c->content=sprintf(__('The ticket has been assigned to %s.'),$this->getAssigneeModel($this->issue->assignee)->name);
        $c->save();
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
