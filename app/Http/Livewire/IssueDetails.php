<?php

namespace App\Http\Livewire;

use App\Models\Issue;
use Carbon\Carbon;
use Livewire\Component;

class IssueDetails extends Component
{
  /**
   * @var Issue
   */
    public $issue;
    public function mount($iid){
        $this->issue=\App\Models\Issue::with('author', 'assignee', 'severity')->where('id','=',$iid)->get()[0];
    }
    public function render()
    {
       // dd($this->iid);
        $dateColor="text-gray-900"; //default
        $dueDateDiffToToday=Carbon::now()->diffInDays($this->issue->due_at);
        if($dueDateDiffToToday<5){
          $dateColor="text-red-500 font-bold";
        }
        return view('livewire.issue-details',['issue'=>$this->issue,'dateColor'=>$dateColor]);
    }
}
