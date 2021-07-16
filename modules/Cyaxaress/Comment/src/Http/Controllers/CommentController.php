<?php
namespace Cyaxaress\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Comment\Http\Requests\CommentRequest;
use Cyaxaress\Comment\Models\Comment;
use Cyaxaress\Comment\Repositories\CommentRepo;
use Cyaxaress\Common\Responses\AjaxResponses;

class CommentController extends Controller{

    public function index(CommentRepo $repo)
    {
        $comments = $repo->paginateParents();
        return view("Comments::index", compact("comments"));
    }

    public function show($comment)
    {
        $comment = Comment::query()->where("id", $comment)->with("commentable", "user", "comments")->firstOrFail();
        return view("Comments::show", compact("comment"));
    }

    public function store(CommentRequest $request, CommentRepo $repo)
    {
        $commentable = $request->commentable_type::findOrFail($request->commentable_id);
        $repo->store($request->all());
        newFeedback("عملیات موفقیت آمیز", "دیدگاه شما با ثبت گردید.");
        return redirect($commentable->path());
    }

    public function accept($id, CommentRepo $commentRepo)
    {
//        $this->authorize('change_confirmation_status', Course::class);
        if ($commentRepo->updateStatus($id, Comment::STATUS_APPROVED)) {
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }

    public function reject($id, CommentRepo $commentRepo)
    {
//        $this->authorize('change_confirmation_status', Course::class);
        if ($commentRepo->updateStatus($id, Comment::STATUS_REJECTED)) {
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }

    public function destroy($id, CommentRepo $repo)
    {
        $comment = $repo->findOrFail($id);
//        $comment->delete();
        return AjaxResponses::SuccessResponse();
    }
}
