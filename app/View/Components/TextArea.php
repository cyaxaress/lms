<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $placeholder;
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($placeholder, $name)
    {
        $this->placeholder = $placeholder;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.text-area');
    }
}
