<?php

namespace App\Http\Livewire;

use App\Models\Issue;
use App\Models\WorkOnTask;
use Illuminate\Http\Request;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class WorkOnTaskForm extends ModalComponent{

  /**
   * @var Issue
   */
  public $issue;
  public $description;


  public function mount(\App\Models\Issue $issue){
    $this->issue = $issue;
  }

  public function render(){
    return view('livewire.work-on-task-form');
  }

  public function submit(Request $r){

    if(WorkOnTask::where('issue', $this->issue->id)->where('status', 'STARTED')->first() == null){
      $w = new WorkOnTask();
      $w->issue = $this->issue->id;
      $w->status = 'STARTED';
      $w->author = $r->user()->id;
      $w->save();
      session()->flash('message', 'work started with id '.$w->id);
    }
    else{
      $work = WorkOnTask::where('issue', $this->issue->id)->where('status', 'STARTED')->first();
      $work->status = 'STOPPED';
      $work->save();

      session()->flash('message', 'Work stopped. Duration: '.$work->getDuration());
    }
  }
}
