<?php


namespace Cyaxaress\Discount\Http\Controllers;


use Cyaxaress\Course\Models\Course;
use Cyaxaress\Course\Repositories\CourseRepo;
use Cyaxaress\Discount\Http\Requests\DiscountRequest;
use Cyaxaress\Discount\Repositories\DiscountRepo;

class DiscountController
{
    public function index(CourseRepo $courseRepo, DiscountRepo $repo)
    {
        $discounts = $repo->paginateAll();
        $courses = $courseRepo->getAll(Course::CONFIRMATION_STATUS_ACCEPTED);
        return view("Discounts::index", compact("courses", "discounts"));
    }

    public function store(DiscountRequest $request, DiscountRepo $repo)
    {
        $repo->store($request->all());

        newFeedback();

        return back();
    }
}
