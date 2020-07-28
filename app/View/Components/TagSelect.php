<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TagSelect extends Component
{
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        //
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tag-select');
    }
}
