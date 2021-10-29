<?php

namespace App\Http\Livewire;

use App\Models\Issue;
use Livewire\Component;

class IssueLabel extends Label
{

    /**
     * @var Issue
     */
    public $issue;

    public function remove($id)
    {
        //dd($this,'removeLabel_'.$this->label_id);
        $this->emit('removeLabel_'.$this->label_id,['id'=>$this->label_id]);
    }


}
