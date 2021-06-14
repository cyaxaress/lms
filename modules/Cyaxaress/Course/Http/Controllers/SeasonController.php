<?php

namespace Cyaxaress\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Common\Responses\AjaxResponses;
use Cyaxaress\Course\Http\Requests\SeasonRequest;
use Cyaxaress\Course\Models\Season;
use Cyaxaress\Course\Repositories\CourseRepo;
use Cyaxaress\Course\Repositories\SeasonRepo;

class SeasonController extends Controller
{
    private $seasonRepo;
    public function __construct(SeasonRepo $seasonRepo)
    {
        $this->seasonRepo = $seasonRepo;
    }

    public function store($course, SeasonRequest $request, CourseRepo $courseRepo)
    {
        $this->authorize('createSeason', $courseRepo->findByid($course));
        $this->seasonRepo->store($course, $request);
        newFeedback();
        return back();
    }

    public function edit($id)
    {
        $season = $this->seasonRepo->findByid($id);
        $this->authorize('edit', $season);
        return view('Courses::seasons.edit', compact('season'));
    }

    public function update($id, SeasonRequest $request)
    {
        $this->authorize('edit', $this->seasonRepo->findByid($id));
        $this->seasonRepo->update($id, $request);
        newFeedback();
        return back();
    }

    public function accept($id)
    {
        $this->authorize('change_confirmation_status', Season::class);
        if ($this->seasonRepo->updateConfirmationStatus($id, Season::CONFIRMATION_STATUS_ACCEPTED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }

    public function reject($id)
    {
        $this->authorize('change_confirmation_status', Season::class);
        if ($this->seasonRepo->updateConfirmationStatus($id, Season::CONFIRMATION_STATUS_REJECTED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }

    public function lock($id)
    {
        $this->authorize('change_confirmation_status', Season::class);
        if ($this->seasonRepo->updateStatus($id, Season::STATUS_LOCKED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }
    public function unlock($id)
    {
        $this->authorize('change_confirmation_status', Season::class);
        if ($this->seasonRepo->updateStatus($id, Season::STATUS_OPENED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }
    public function destroy($id)
    {
        $season = $this->seasonRepo->findByid($id);
        $this->authorize('delete', $season);
        $season->delete();
        return AjaxResponses::SuccessResponse();
    }
}
