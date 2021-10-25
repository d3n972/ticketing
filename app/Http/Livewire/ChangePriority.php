<?php

namespace App\Http\Livewire;

use App\Models\Issue;
use App\Models\Severity;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ChangePriority extends ModalComponent
{
  /**
   * @var Issue
   */
  public $issue;
  public $new_sev;
  protected $rules=[
    'new_sev'=>'max:25'
  ];
  public function submit(){
    $validatedData = $this->validate();
    $this->issue->severity=$validatedData["new_sev"]??1;
    if(!$this->issue->save()){
      throw new Error("FAIL");
    }
    session()->flash('message', __('Ticket saved'));
  }
  public function mount(\App\Models\Issue $issue)
  {


    $this->issue = $issue;
  }
    public function render()
    {
        return view('livewire.change-priority',["severities"=>Severity::all()]);
    }
}
