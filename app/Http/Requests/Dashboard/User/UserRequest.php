<?php

namespace App\Http\Requests\Dashboard\User;

use App\Models\Dashboard\User\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = User::VALIDATION_RULES;
        if($this->isMethod('PUT')) {
            if(request()->has('password') && request()->password !== null) {
                $rules['password'] = ['required', 'confirmed'];
            } else {
                $rules['password'] = ['nullable'];
            }
        }

        return $rules;
    }
}
