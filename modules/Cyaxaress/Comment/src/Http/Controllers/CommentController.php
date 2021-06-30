<?php
namespace Cyaxaress\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Comment\Http\Requests\CommentRequest;
use Cyaxaress\Comment\Repositories\CommentRepo;
use Cyaxaress\Common\Responses\AjaxResponses;

class CommentController extends Controller{

    public function index(CommentRepo $repo)
    {
        $comments = $repo->paginate();

        return view("Comments::index", compact("comments"));
    }

    public function store(CommentRequest $request, CommentRepo $repo)
    {
        $commentable = $request->commentable_type::findOrFail($request->commentable_id);
        $repo->store($request->all());
        newFeedback("عملیات موفقیت آمیز", "دیدگاه شما با ثبت گردید.");
        return redirect($commentable->path());
    }

    public function destroy($id, CommentRepo $repo)
    {
        $comment = $repo->findOrFail($id);
        $comment->delete();
        return AjaxResponses::SuccessResponse();
    }
}
