<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function render()
    {
        return view('components.select');
    }
}
