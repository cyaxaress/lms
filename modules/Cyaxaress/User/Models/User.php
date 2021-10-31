<?php

namespace Cyaxaress\User\Models;

use Cyaxaress\Comment\Models\Comment;
use Cyaxaress\Course\Models\Course;
use Cyaxaress\Course\Models\Lesson;
use Cyaxaress\Course\Models\Season;
use Cyaxaress\Media\Models\Media;
use Cyaxaress\Payment\Models\Payment;
use Cyaxaress\Payment\Models\Settlement;
use Cyaxaress\RolePermissions\Models\Role;
use Cyaxaress\Ticket\Models\Reply;
use Cyaxaress\Ticket\Models\Ticket;
use Cyaxaress\User\Notifications\ResetPasswordRequestNotification;
use Cyaxaress\User\Notifications\VerifyMailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use HasFactory;

    const STATUS_ACTIVE = "active";
    const STATUS_INACTIVE = "inactive";
    const STATUS_BAN = "ban";
    public static $statuses = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_BAN
    ];

    public static $defaultUsers = [
        [
            'email' => 'admin@site.com',
            'password' => 'admin',
            'name' => 'Admin',
            'role' => Role::ROLE_SUPER_ADMIN
        ],
        [
            'email' => 'teacher@site.com',
            'password' => 'teacher',
            'name' => 'Teacher',
            'role' => Role::ROLE_TEACHER
        ],
        [
            'email' => 'student@site.com',
            'password' => 'student',
            'name' => 'Student',
            'role' => Role::ROLE_STUDENT
        ]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyMailNotification());
    }

    public function sendResetPasswordRequestNotification()
    {
        $this->notify(new ResetPasswordRequestNotification());
    }

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function purchases()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, "buyer_id");
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticketReplies()
    {
        return $this->hasMany(Reply::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function profilePath()
    {
        return null;
        return $this->username ? route('viewProfile', $this->username) : route('viewProfile', 'username');
    }

    public function getThumbAttribute()
    {
        if ($this->image)
            return '/storage/' . $this->image->files[300];

        return '/panel/img/profile.jpg';
    }


    public function studentsCount()
    {
        return \DB::table("courses")
            ->select("course_id")->where("teacher_id", $this->id)
            ->join("course_user", "courses.id", "=", "course_user.course_id")->count();
    }

    public function routeNotificationForSms()
    {
        return $this->mobile;
    }
}
