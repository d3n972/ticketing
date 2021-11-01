<?php

namespace App\Http\Livewire;

use App\Models\Issue;
use Livewire\Component;

class TicketList extends Component
{
    public function render()
    {
        return view('livewire.ticket-list',['issues'=>Issue::all()->all()]);
    }
}
