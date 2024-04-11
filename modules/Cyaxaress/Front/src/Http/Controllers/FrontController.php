<?php

namespace Cyaxaress\Front\Http\Controllers;

use Cyaxaress\Course\Repositories\CourseRepo;
use Cyaxaress\Course\Repositories\LessonRepo;
use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Support\Str;

class FrontController
{
    public function index()
    {
        return view('Front::index');
    }

    public function singleCourse($slug, CourseRepo $courseRepo, LessonRepo $lessonRepo)
    {
        $courseId = $this->extractId($slug, 'c');
        $course = $courseRepo->findByid($courseId);
        $lessons = $lessonRepo->getAcceptedLessons($courseId);

        if (request()->lesson) {
            $lesson = $lessonRepo->getLesson($courseId, $this->extractId(request()->lesson, 'l'));
        } else {
            $lesson = $lessonRepo->getFirstLesson($courseId);
        }

        return view('Front::singleCourse', compact('course', 'lessons', 'lesson'));
    }

    public function extractId($slug, $key)
    {
        return Str::before(Str::after($slug, $key.'-'), '-');
    }

    public function singleTutor($username)
    {
        $tutor = User::permission(Permission::PERMISSION_TEACH)->where('username', $username)->first();

        return view('Front::tutor', compact('tutor'));
    }
}
