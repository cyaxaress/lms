<?php

namespace Cyaxaress\Course\Repositories;


use Cyaxaress\Course\Models\Course;
use Cyaxaress\Course\Models\Lesson;
use Illuminate\Support\Str;

class CourseRepo
{
    public function store($values)
    {
        return Course::create([
            'teacher_id' => $values->teacher_id,
            'category_id' => $values->category_id,
            'banner_id' => $values->banner_id,
            'title' => $values->title,
            'slug' => Str::slug($values->slug),
            'priority' => $values->priority,
            'price' => $values->price,
            'percent' => $values->percent,
            'type' => $values->type,
            'status' => $values->status,
            'body' => $values->body,
            'confirmation_status' => Course::CONFIRMATION_STATUS_PENDING,
        ]);
    }

    public function paginate()
    {
        return Course::paginate();
    }

    public function findByid($id)
    {
        return Course::findOrFail($id);
    }

    public function update($id, $values)
    {
        return Course::where('id', $id)->update([
            'teacher_id' => $values->teacher_id,
            'category_id' => $values->category_id,
            'banner_id' => $values->banner_id,
            'title' => $values->title,
            'slug' => Str::slug($values->slug),
            'priority' => $values->priority,
            'price' => $values->price,
            'percent' => $values->percent,
            'type' => $values->type,
            'status' => $values->status,
            'body' => $values->body,
        ]);
    }

    public function updateConfirmationStatus($id, string $status)
    {
        return Course::where('id', $id)->update(['confirmation_status' => $status]);
    }

    public function updateStatus($id, string $status)
    {
        return Course::where('id', $id)->update(['status' => $status]);
    }

    public function getCoursesByTeacherId(?int $id)
    {
        return Course::where('teacher_id', $id)->get();
    }

    public function latestCourses()
    {
        return Course::where('confirmation_status', Course::CONFIRMATION_STATUS_ACCEPTED)->latest()->take(8)->get();
    }

    public function getDuration($id)
    {
        return $this->getLessonsQuery($id)->sum('time');
    }

    public function getLessons($id)
    {
        return $this->getLessonsQuery($id)->get();
    }

    public function getLessonsCount($id)
    {
        return $this->getLessonsQuery($id)->count();
    }

    public function addStudentToCourse(Course $course, $studentId)
    {
        if (!$this->getCourseStudentById($course, $studentId)) {
            $course->students()->attach($studentId);
        }
    }

    public function getCourseStudentById(Course $course, $studentId)
    {
        return $course->students()->where("id", $studentId)->first();
    }

    public function hasStudent(Course $course, $student_id)
    {
        return $course->students->contains($student_id);
    }

    private function getLessonsQuery($id)
    {
        return Lesson::where('course_id', $id)
            ->where('confirmation_status', Lesson::CONFIRMATION_STATUS_ACCEPTED);
    }

    public function getAll(string $status = null)
    {
        $query = Course::query();
        if ($status) $query->where("confirmation_status", $status);

        return $query
            ->latest()
            ->get();
    }

}
