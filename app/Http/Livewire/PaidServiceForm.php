<?php

namespace App\Http\Livewire;

use App\Models\PaidService;
use Illuminate\Support\Facades\Redirect;
use LivewireUI\Modal\ModalComponent;

class PaidServiceForm extends ModalComponent
{
    public $issue;
    public PaidService $ps;

    public function accept()
    {
        $url=$this->ps->accpetProposal();
        return Redirect::to($url);
    }

    public function reject()
    {
        //not yet implemented
    }

    public function mount()
    {
        $this->ps = PaidService::where('issue', $this->issue)->first();
    }

    public function render()
    {
       return view('livewire.paid-service-form');
    }
}
