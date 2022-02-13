<?php

namespace Cyaxaress\Slider\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Media\Services\MediaFileService;
use Cyaxaress\Slider\Http\Requests\SlideRequest;
use Cyaxaress\Slider\Models\Slide;
use Cyaxaress\Slider\Repositories\SlideRepo;

class SlideController extends Controller
{
    public function index(SlideRepo $repo)
    {
        $this->authorize('manage', Slide::class);
        $slides = $repo->all();
        return view("Slider::index", compact("slides"));
    }

    public function store(SlideRequest $request, SlideRepo $repo)
    {
        $this->authorize('manage', Slide::class);
        $request->request->add(['media_id' => MediaFileService::publicUpload($request->file('image'))->id]);
        $repo->store($request);
        return redirect()->route('slides.index');
    }

    public function edit()
    {
        $this->authorize('manage', Slide::class);
    }

    public function update()
    {
        $this->authorize('manage', Slide::class);

    }

    public function destroy()
    {
        $this->authorize('manage', Slide::class);
    }
}
