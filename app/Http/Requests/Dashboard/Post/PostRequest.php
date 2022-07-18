<?php

namespace App\Http\Requests\Dashboard\Post;

use App\Models\Dashboard\Post\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Post::VALIDATION_RULES;
        if($this->isMethod('PUT')) {
            $rules['image'] = ['nullable'];
        }
        return $rules;
    }
}
