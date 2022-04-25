<?php

namespace Alikeshtkar\Tag\View\Components;

use Alikeshtkar\Tag\Repositories\TagRepository;
use Illuminate\View\Component;
use function view;

class TagSelect extends Component
{
    public $tags;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->tags = $this->getTags();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('tag::components.tag-select');
    }

    public function getTags()
    {
        return resolve(TagRepository::class)->getAll();
    }
}
