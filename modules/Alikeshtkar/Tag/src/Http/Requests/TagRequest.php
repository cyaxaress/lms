<?php

namespace Alikeshtkar\Tag\Http\Requests;

use Alikeshtkar\Tag\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can($this->isMethod('patch') || $this->isMethod('put') ? 'update' : 'create', Tag::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'unique:' . Tag::class . ',title,' . $this->tag],
        ];
    }
}
