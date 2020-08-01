<?php
namespace Cyaxaress\Course\Http\Controllers;

use Cyaxaress\Category\Repositories\CategoryRepo;
use Cyaxaress\Category\Responses\AjaxResponses;
use Cyaxaress\Course\Http\Requests\CourseRequest;
use Cyaxaress\Course\Repositories\CourseRepo;
use Cyaxaress\Media\Services\MediaFileService;
use Cyaxaress\User\Repositories\UserRepo;

class CourseController
{
    public function index(CourseRepo $courseRepo)
    {
        $courses = $courseRepo->paginate();
        return view('Courses::index', compact('courses'));
    }

    public function create(UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->all();
        return view('Courses::create', compact('teachers', 'categories'));
    }

    public function store(CourseRequest $request, CourseRepo $courseRepo)
    {
        $request->request->add(['banner_id' => MediaFileService::upload($request->file('image'))->id ]);
        $courseRepo->store($request);
        return redirect()->route('courses.index');
    }

    public function destroy($id, CourseRepo $courseRepo)
    {
        $course =  $courseRepo->findByid($id);

        if ($course->banner) {
            $course->banner->delete();
        }

        $course->delete();

        return AjaxResponses::SuccessResponse();
    }
}
