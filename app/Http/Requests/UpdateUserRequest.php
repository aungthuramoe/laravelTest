<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'type' => 'required',
            'phone' => '',
            'dob' => '',
            'profile' => 'required | max:2048'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'name is required',
            'email.required' => 'email is required',
            'address.required' => 'address is required',
            'user_type.required' => 'user type is require',
            'address.required' => 'address is require',
            'profile.required' => 'select profile image',
            'profile.max' => 'profile image max length is 2 mb',

        ];
    }
}
