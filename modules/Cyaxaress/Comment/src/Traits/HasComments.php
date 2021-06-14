<?php


namespace Cyaxaress\Comment\Traits;


use Cyaxaress\Comment\Models\Comment;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

trait HasComments
{
    use HasRelationships;
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function approvedComments()
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->where("status", Comment::STATUS_APPROVED)
            ->whereNull("comment_id")->with("comments");
    }
}
