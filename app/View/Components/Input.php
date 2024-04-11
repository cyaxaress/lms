<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;

    public $placeholder;

    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $placeholder, $type)
    {
        //
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
