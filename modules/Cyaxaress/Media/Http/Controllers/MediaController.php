<?php
namespace Cyaxaress\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Media\Models\Media;
use Cyaxaress\Media\Services\MediaFileService;
use Illuminate\Http\Request;

class MediaController extends Controller{
    public function download(Media $media, Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        return MediaFileService::stream($media);
    }
}
