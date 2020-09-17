<?php

namespace Cyaxaress\Course\Http\Controllers;

use Cyaxaress\Course\Http\Requests\SeasonRequest;
use Cyaxaress\Course\Repositories\SeasonRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeasonController extends Controller
{
    private $seasonRepo;
    public function __construct(SeasonRepo $seasonRepo)
    {
        $this->seasonRepo = $seasonRepo;
    }

    public function store($course, SeasonRequest $request )
    {
        $this->seasonRepo->store($course, $request);
        newFeedback();
        return back();
    }

    public function edit($id)
    {
        $season = $this->seasonRepo->findByid($id);
        return view('Courses::seasons.edit', compact('season'));
    }

    public function update($id, SeasonRequest $request)
    {
        $this->seasonRepo->update($id, $request);
        newFeedback();
        return back();
    }
}
