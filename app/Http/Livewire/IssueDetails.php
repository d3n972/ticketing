<?php

namespace App\Http\Livewire;

use Livewire\Component;

class IssueDetails extends Component
{
    public $issue;
    public function mount($iid){
        $this->issue=\App\Models\Issue::with('author', 'assignee', 'severity')->where('id','=',$iid)->get()[0];
    }
    public function render()
    {
       // dd($this->iid);
        return view('livewire.issue-details',['issue'=>$this->issue]);
    }
}
