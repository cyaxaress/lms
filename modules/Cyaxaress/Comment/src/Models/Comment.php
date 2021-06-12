<?php

namespace Cyaxaress\Comment\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const STATUS_NEW = "new";
    const STATUS_APPROVED = "approved";
    const STATUS_REJECTED = "rejected";

    static $statues = [
        self::STATUS_REJECTED,
        self::STATUS_APPROVED,
        self::STATUS_NEW
    ];

    protected $guarded = [];

    public function commentable()
    {
        return $this->morphTo();
    }
}
