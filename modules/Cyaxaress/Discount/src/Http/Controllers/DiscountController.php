<?php


namespace Cyaxaress\Discount\Http\Controllers;


use Cyaxaress\Course\Models\Course;
use Cyaxaress\Course\Repositories\CourseRepo;
use Cyaxaress\Discount\Http\Requests\DiscountRequest;
use Cyaxaress\Discount\Models\Discount;
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

    public function edit(Discount $discount, CourseRepo $courseRepo)
    {
        $courses = $courseRepo->getAll(Course::CONFIRMATION_STATUS_ACCEPTED);
        return view("Discounts::edit", compact("discount", "courses"));
    }

    public function update(Discount $discount, DiscountRequest $request, DiscountRepo $repo)
    {
        $repo->update($discount->id, $request->all());
        newFeedback();
        return redirect()->route("discounts.index");

    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return AjaxResponses::SuccessResponse();
    }
}
