<?php

namespace Cyaxaress\Course\Repositories;

use Cyaxaress\Course\Models\Lesson;
use Illuminate\Support\Str;

class LessonRepo
{
    public function store($courseId, $values)
    {
        return Lesson::create([
            "title" => $values->title,
            "slug" => $values->slug ? Str::slug($values->slug) : Str::slug($values->title), // todo generate auto slug
            "time" => $values->time,
            "number" => $this->generateNumber($values->number, $courseId),
            'season_id' => $values->season_id,
            'media_id' => $values->media_id,
            'course_id' => $courseId,
            'user_id' => auth()->id(),
            'body' => $values->body,
            'confirmation_status' => Lesson::CONFIRMATION_STATUS_PENDING,
            "status"=> Lesson::STATUS_OPENED
        ]);
    }

    public function paginate()
    {
        return Lesson::orderBy('number')->paginate();
    }

    public function findByid($id)
    {
        return Lesson::findOrFail($id);
    }

    public function update($id, $values)
    {
        return Lesson::where('id', $id)->update([
            'teacher_id' => $values->teacher_id,
            'category_id' => $values->category_id,
            'banner_id' => $values->banner_id,
            'title' => $values->title,
            'slug' => Str::slug($values->slug),
            'number' => $values->number,
            'price' => $values->price,
            'percent' => $values->percent,
            'type' => $values->type,
            'status' => $values->status,
            'body' => $values->body,
        ]);
    }

    public function updateConfirmationStatus($id, string $status)
    {
        return Lesson::where('id', $id)->update(['confirmation_status'=> $status]);
    }

    public function updateStatus($id, string $status)
    {
        return Lesson::where('id', $id)->update(['status'=> $status]);
    }

    public function generateNumber($number, $courseId): int
    {
        $courseRepo = new CourseRepo();
        if (is_null($number)) {
            $number = $courseRepo->findByid($courseId)->lessons()->orderBy('number', 'desc')->firstOrNew([])->number ?: 0;
            $number++;
        }
        return $number;
    }
}
