<?php
namespace Cyaxaress\Category\Responses;

use Illuminate\Http\Response;

class AjaxResponses
{
    public static function SuccessResponse()
    {
        return response()->json(['message' => 'عملیات با موفقیت انجام شد.'], Response::HTTP_OK);
    }
}
