<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Label extends Component
{
    public $label_id;
    public $css;
    public $content;
    public $removable;

    public function mount($label_id,$color, $content, $data, $removable = true)
    {
        $this->label_id=$label_id;
        $this->css = $color;
        $this->content = $content;
        $this->removable = $removable;
    }



    public function render()
    {
        return view('livewire.label');
    }
}
