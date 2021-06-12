<?php
namespace Cyaxaress\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Comment\Http\Requests\CommentRequest;
use Cyaxaress\Comment\Repositories\CommentRepo;

class CommentController extends Controller{
    public function store(CommentRequest $request, CommentRepo $repo)
    {
        $commentable = $request->commentable_type::findOrFail($request->commentable_id);
        $repo->store($request->all());
        newFeedback("عملیات موفقیت آمیز", "دیدگاه شما با ثبت گردید.");
        return redirect($commentable->path());
    }
}
