<?php
namespace Cyaxaress\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Comment\Http\Requests\CommentRequest;

class CommentController extends Controller{
    public function store(CommentRequest $request)
    {
        $commentable = $request->commentable_type::findOrFail($request->commentable_id);

        return $commentable;
    }
}
