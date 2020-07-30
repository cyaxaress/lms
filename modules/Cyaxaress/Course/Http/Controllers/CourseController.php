<?php
namespace Cyaxaress\Course\Http\Controllers;

use Cyaxaress\Category\Repositories\CategoryRepo;
use Cyaxaress\Course\Http\Requests\CourseRequest;
use Cyaxaress\Course\Repositories\CourseRepo;
use Cyaxaress\User\Repositories\UserRepo;

class CourseController
{
    public function index()
    {
        return 'courses';
    }

    public function create(UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->all();
        return view('Courses::create', compact('teachers', 'categories'));
    }

    public function store(CourseRequest $request, CourseRepo $courseRepo)
    {
        $course = $courseRepo->store($request);

        return $course;
    }
}
