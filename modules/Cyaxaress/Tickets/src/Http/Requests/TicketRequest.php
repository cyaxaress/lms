<?php
namespace Cyaxaress\Ticket\Http\Requests;

use Cyaxaress\Course\Models\Course;
use Cyaxaress\Course\Rules\ValidSeason;
use Cyaxaress\Course\Rules\ValidTeacher;
use Cyaxaress\Media\Services\MediaFileService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        return [
            "title" => 'required|min:3|max:190',
            "body" => "required",
            "attachment" => "nullable|file|mimes:avi,mkv,mp4,zip,rar|max:10240",
        ];
    }

    public function attributes()
    {
        return [
            "title" => 'عنوان تیکت',
            "lesson_file" => "فایل پیوست",
            "body" => "متن تیکت"
        ];
    }
}
