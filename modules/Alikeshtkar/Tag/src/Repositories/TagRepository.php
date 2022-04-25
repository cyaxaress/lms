<?php

namespace Alikeshtkar\Tag\Repositories;

use Alikeshtkar\Tag\Http\Requests\TagRequest;
use Alikeshtkar\Tag\Models\Tag;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class TagRepository
{
    private function query(): Builder
    {
        return Tag::query();
    }

    public function getAll()
    {
        return $this->query()->get();
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->query()->paginate(10);
    }

    public function store(TagRequest $request)
    {
        return $this->query()->create([
            'user_id' => auth()->id(),
            'title' => $request->title,
        ]);
    }

    public function update($tag, TagRequest $request)
    {
        return $tag->update([
            'title' => $request->title,
        ]);
    }

    public function delete($tag)
    {
        return $tag->delete();
    }

    public function findOrFailById($tag)
    {
        return $this->query()->findOrFail($tag);
    }

    public function findOrFailByColumn(string $column,$slug)
    {
        return $this->query()->where($column, $slug)->firstOrFail();
    }

    public function insertGetIds(array $tags): array
    {
        return collect($tags)->map(function ($item, $key) {
            return $this->query()->firstOrCreate(['title' => $item], [
                'user_id' => auth()->id(),
                'title' => $item,
                'slug' => SlugService::createSlug(Tag::class, 'slug', $item, ['unique' => true]),
            ])->id;
        })->toArray();
    }
}
