<?php

namespace Cyaxaress\Course\Models;


use Cyaxaress\Media\Models\Media;
use Cyaxaress\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Lesson extends Model
{
    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_PENDING, self::CONFIRMATION_STATUS_REJECTED];

    const STATUS_OPENED = 'opened';
    const STATUS_LOCKED = 'locked';
    static $statuses = [self::STATUS_OPENED, self::STATUS_LOCKED];


    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function getConfirmationStatusCssClass()
    {
        if ($this->confirmation_status == self::CONFIRMATION_STATUS_ACCEPTED) return "text-success";
        elseif ($this->confirmation_status == self::CONFIRMATION_STATUS_REJECTED) return "text-error";
    }

    public function isFree()
    {

    }

    public function path()
    {
        return $this->course->path() . '?lesson=l-' . $this->id . "-" . $this->slug;
    }

    public function downloadLink()
    {
        if ($this->media_id)
        return URL::temporarySignedRoute('media.download', now()->addDay() , ['media' => $this->media_id]);
    }
}
