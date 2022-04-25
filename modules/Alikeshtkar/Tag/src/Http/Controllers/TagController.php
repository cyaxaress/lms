<?php

namespace Alikeshtkar\Tag\Http\Controllers;

use Alikeshtkar\Tag\Http\Requests\TagRequest;
use Alikeshtkar\Tag\Models\Tag;
use Alikeshtkar\Tag\Repositories\TagRepository;
use App\Http\Controllers\Controller;
use Cyaxaress\Common\Responses\AjaxResponses;

class TagController extends Controller
{
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $this->authorize('index', Tag::class);
        $tags = $this->tagRepository->paginate();
        return view('tag::dashboard.index', compact('tags'));
    }

    public function show($slug)
    {
        $tag = $this->tagRepository->findOrFailByColumn('slug', $slug);
        return view('tag::front.show', compact('tag'));
    }

    public function store(TagRequest $request)
    {
        $this->tagRepository->store($request);
        newFeedback();
        return redirect()->route('tags.index');
    }

    public function edit($tag)
    {
        $this->authorize('update', Tag::class);
        $tag = $this->tagRepository->findOrFailById($tag);
        return view('tag::dashboard.edit', compact('tag'));
    }

    public function update(TagRequest $request, $tag)
    {
        $tag = $this->tagRepository->findOrFailById($tag);
        $this->tagRepository->update($tag, $request);
        newFeedback();
        return redirect()->route('tags.index');
    }

    public function destroy($tag)
    {
        $this->authorize('update', Tag::class);
        $tag = $this->tagRepository->findOrFailById($tag);
        try {
            $this->tagRepository->delete($tag);
            return AjaxResponses::SuccessResponse();
        } catch (\Throwable $e) {
            return AjaxResponses::FailedResponse();
        }
    }
}
