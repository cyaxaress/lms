<?php

namespace Cyaxaress\Course\Http\Controllers;

use Cyaxaress\Course\Http\Requests\SeasonRequest;
use Cyaxaress\Course\Repositories\SeasonRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeasonController extends Controller
{
    public function store($course, SeasonRequest $request, SeasonRepo $seasonRepo)
    {
        $seasonRepo->store($course, $request);

        newFeedback();

        return back();
    }
}
