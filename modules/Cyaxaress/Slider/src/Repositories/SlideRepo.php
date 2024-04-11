<?php

namespace Cyaxaress\Slider\Repositories;

use Cyaxaress\Slider\Models\Slide;

class SlideRepo
{
    public function all()
    {
        return Slide::query()->orderBy('priority')->get();
    }

    public function findById($id)
    {
        return Slide::findOrFail($id);
    }

    public function store($values)
    {
        return Slide::create([
            'user_id' => auth()->id(),
            'priority' => $values->priority,
            'media_id' => $values->media_id,
            'link' => $values->link,
            'status' => $values->status,
        ]);
    }

    public function update($id, $values)
    {
        Slide::where('id', $id)->update([
            'priority' => $values->priority,
            'media_id' => $values->media_id,
            'link' => $values->link,
            'status' => $values->status,
        ]);
    }

    public function delete($id)
    {
        Slide::where('id', $id)->delete();
    }
}
