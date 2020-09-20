<?php


namespace Cyaxaress\Course\Http\Controllers;


use App\Http\Controllers\Controller;
use Cyaxaress\Course\Repositories\SeasonRepo;

class LessonController extends Controller
{
    public function create($course, SeasonRepo $seasonRepo)
    {
        $seasons = $seasonRepo->getCourseSeasons($course);
        return view('Courses::lessons.create', compact('seasons'));
    }
}
