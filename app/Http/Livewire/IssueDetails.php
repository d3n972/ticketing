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
        $this->issue=Issue::getTicketById($iid);

    }
    public function render()
    {
        $dueDateDiffToToday=Carbon::now()->diffInDays($this->issue->due_at);
        if($dueDateDiffToToday<5){
          $dateColor="text-red-500 font-bold";
        }else{
            $dateColor='text-white';
        }
        return view('livewire.issue-details',['issue'=>$this->issue,'dateColor'=>$dateColor]);
    }
}
