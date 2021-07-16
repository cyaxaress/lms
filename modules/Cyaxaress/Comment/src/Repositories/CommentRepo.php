<?php

namespace Cyaxaress\Comment\Repositories;

use Cyaxaress\Comment\Models\Comment;
use Cyaxaress\RolePermissions\Models\Permission;

class CommentRepo
{

    public function paginate()
    {
        return Comment::query()->latest()->paginate();
    }

    public function store($data)
    {
        return Comment::query()->create([
            "user_id" => auth()->id(),
            "status" => (auth()->user()->can(Permission::PERMISSION_MANAGE_COMMENTS) ||
                        auth()->user()->can(Permission::PERMISSION_TEACH))
                        ?
                        Comment::STATUS_APPROVED
                        :
                        Comment::STATUS_NEW,
            "comment_id" => array_key_exists("comment_id", $data) ? $data["comment_id"] : null,
            "body" => $data["body"],
            "commentable_id" => $data["commentable_id"],
            "commentable_type" => $data["commentable_type"],
        ]);
    }

    public function findApproved($id)
    {
        return Comment::query()
            ->where("status", Comment::STATUS_APPROVED)
            ->where("id", $id)
            ->first();
    }

    public function findOrFail($id)
    {
        return Comment::query()->findOrFail($id);
    }

    public function paginateParents()
    {
        return Comment::query()->whereNull("comment_id")->withCount("notApprovedComments")->latest()->paginate();
    }

    public function updateStatus($id, string $status)
    {
        return Comment::query()->where("id", $id)->update([
            "status" => $status
        ]);
    }
}
