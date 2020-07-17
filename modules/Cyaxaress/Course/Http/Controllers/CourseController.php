<?php
namespace Cyaxaress\Course\Http\Controllers;

use Cyaxaress\User\Repositories\UserRepo;

class CourseController
{
    public function index()
    {
        return 'courses';
    }

    public function create(UserRepo $userRepo)
    {
        $teachers = $userRepo->getTeachers();
        return view('Courses::create', compact('teachers'));
    }
}
