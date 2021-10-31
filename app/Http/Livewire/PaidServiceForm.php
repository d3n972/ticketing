<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class PaidServiceForm extends ModalComponent
{
    public $issue;
    public function accept(){}
    public function reject(){}
    
    public function render()
    {
        return view('livewire.paid-service-form');
    }
}
