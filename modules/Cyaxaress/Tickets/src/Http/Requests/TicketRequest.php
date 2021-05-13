<?php
namespace Cyaxaress\Ticket\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            "attachment" => "nullable|file|mimes:avi,mkv,mp4,zip,rar|max:102400",
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
