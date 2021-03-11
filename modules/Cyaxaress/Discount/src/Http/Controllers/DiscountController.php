<?php


namespace Cyaxaress\Discount\Http\Controllers;


use App\Http\Controllers\Controller;
use Cyaxaress\Course\Models\Course;
use Cyaxaress\Course\Repositories\CourseRepo;
use Cyaxaress\Discount\Http\Requests\DiscountRequest;
use Cyaxaress\Discount\Models\Discount;
use Cyaxaress\Discount\Repositories\DiscountRepo;

class DiscountController extends Controller
{
    public function index(CourseRepo $courseRepo, DiscountRepo $repo)
    {
        $this->authorize("manage", Discount::class);
        $discounts = $repo->paginateAll();
        $courses = $courseRepo->getAll(Course::CONFIRMATION_STATUS_ACCEPTED);
        return view("Discounts::index", compact("courses", "discounts"));
    }

    public function store(DiscountRequest $request, DiscountRepo $repo)
    {
        $this->authorize("manage", Discount::class);
        $repo->store($request->all());
        newFeedback();
        return back();
    }

    public function edit(Discount $discount, CourseRepo $courseRepo)
    {
        $this->authorize("manage", Discount::class);
        $courses = $courseRepo->getAll(Course::CONFIRMATION_STATUS_ACCEPTED);
        return view("Discounts::edit", compact("discount", "courses"));
    }

    public function update(Discount $discount, DiscountRequest $request, DiscountRepo $repo)
    {
        $this->authorize("manage", Discount::class);
        $repo->update($discount->id, $request->all());
        newFeedback();
        return redirect()->route("discounts.index");

    }

    public function destroy(Discount $discount)
    {
        $this->authorize("manage", Discount::class);
        $discount->delete();
        return AjaxResponses::SuccessResponse();
    }
}
