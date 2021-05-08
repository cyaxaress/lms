<?php
namespace Cyaxaress\Ticket\Models;

use Cyaxaress\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model{

    const STATUS_OPEN = "open";
    const STATUS_CLOSE = "open";
    const STATUS_PENDING = "open";

    static $statuses = [
        self::STATUS_OPEN,
        self::STATUS_CLOSE,
        self::STATUS_PENDING
    ];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function ticketable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
