<?php

namespace Cyaxaress\Comment\Rules;

use Cyaxaress\Comment\Repositories\CommentRepo;
use Illuminate\Contracts\Validation\Rule;

class ApprovedComment implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $commentRepo = new CommentRepo();
        return ! is_null($commentRepo->findApproved($value));
    }

    public function message()
    {
        return 'The validation error message.';
    }
}
