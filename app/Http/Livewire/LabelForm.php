<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;


class LabelColor
{
    public string $fg;
    public string $bg;
    public bool $forcefg=false;
    public function __construct($bg)
    {
        $this->bg=$bg;
        $parts = explode('-', $bg);
        $strength = array_pop($parts);
        if (in_array($strength, [50, 100, 200, 300, 400, 500, 600, 700, 800, 900])) {
            $iv = (int)$strength;
            if ($iv <= 400) {
                $this->fg = 'text-black';
                $this->forcefg = true;
            }
        } else {
            if ($strength == 'white') {
                $this->fg = 'text-black';
                $this->forcefg = true;
            }
            if ($strength == 'black') {
                $this->fg = 'text-white';
                $this->forcefg = true;
            }
        }
    }
}
class LabelForm extends ModalComponent
{
    const COLORS = [
        "bg-black",
        "bg-white",
        "bg-gray-50",
        "bg-gray-100",
        "bg-gray-200",
        "bg-gray-300",
        "bg-gray-400",
        "bg-gray-500",
        "bg-gray-600",
        "bg-gray-700",
        "bg-gray-800",
        "bg-gray-900",
        "bg-red-50",
        "bg-red-100",
        "bg-red-200",
        "bg-red-300",
        "bg-red-400",
        "bg-red-500",
        "bg-red-600",
        "bg-red-700",
        "bg-red-800",
        "bg-red-900",
        "bg-yellow-50",
        "bg-yellow-100",
        "bg-yellow-200",
        "bg-yellow-300",
        "bg-yellow-400",
        "bg-yellow-500",
        "bg-yellow-600",
        "bg-yellow-700",
        "bg-yellow-800",
        "bg-yellow-900",
        "bg-green-50",
        "bg-green-100",
        "bg-green-200",
        "bg-green-300",
        "bg-green-400",
        "bg-green-500",
        "bg-green-600",
        "bg-green-700",
        "bg-green-800",
        "bg-green-900",
        "bg-blue-50",
        "bg-blue-100",
        "bg-blue-200",
        "bg-blue-300",
        "bg-blue-400",
        "bg-blue-500",
        "bg-blue-600",
        "bg-blue-700",
        "bg-blue-800",
        "bg-blue-900",
        "bg-indigo-50",
        "bg-indigo-100",
        "bg-indigo-200",
        "bg-indigo-300",
        "bg-indigo-400",
        "bg-indigo-500",
        "bg-indigo-600",
        "bg-indigo-700",
        "bg-indigo-800",
        "bg-indigo-900",
        "bg-purple-50",
        "bg-purple-100",
        "bg-purple-200",
        "bg-purple-300",
        "bg-purple-400",
        "bg-purple-500",
        "bg-purple-600",
        "bg-purple-700",
        "bg-purple-800",
        "bg-purple-900",
        "bg-pink-50",
        "bg-pink-100",
        "bg-pink-200",
        "bg-pink-300",
        "bg-pink-400",
        "bg-pink-500",
        "bg-pink-600",
        "bg-pink-700",
        "bg-pink-800",
        "bg-pink-900"
    ];
    public function getColors()
    {
        $o = [];
        foreach (LabelForm::COLORS as $color) {
            array_push($o, new LabelColor($color));
        }
        return $o;
    }
    public function render()
    {
        return view('livewire.label-form',['colors'=>$this->getColors()]);
    }
}
