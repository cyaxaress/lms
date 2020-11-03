<?php
namespace Cyaxaress\Front\Http\Controllers;

use Cyaxaress\Course\Repositories\CourseRepo;
use Illuminate\Support\Str;

class FrontController
{
    public function index()
    {
        return view('Front::index');
    }

    public function singleCourse($slug, CourseRepo $courseRepo)
    {
        $courseId = Str::before(Str::after($slug, 'c-'), '-');
        $course = $courseRepo->findByid($courseId);
        return view('Front::singleCourse', compact('course'));
    }
}
