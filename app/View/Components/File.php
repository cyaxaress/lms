<?php

namespace App\View\Components;

use Illuminate\View\Component;

class File extends Component
{
    public $placeholder;

    public $name;

    /**
     * @var null
     */
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($placeholder, $name, $value = null)
    {
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.file');
    }
}
