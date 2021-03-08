<?php


namespace Cyaxaress\Discount\Http\Controllers;


use Cyaxaress\Course\Models\Course;
use Cyaxaress\Course\Repositories\CourseRepo;

class DiscountController
{
    public function index(CourseRepo $courseRepo)
    {
        $courses = $courseRepo->getAll(Course::CONFIRMATION_STATUS_ACCEPTED);
        return view("Discounts::index", compact("courses"));
    }
}
