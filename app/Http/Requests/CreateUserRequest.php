<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'password' => 'required | confirmed |min:6 ',
            'address' => 'required',
            'user_type' => 'required',
            'phone' => '',
            'dob' => '',
            'profile' => 'required | image | mimes:jpeg,png,jpg | max:2048'

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'name is required',
            'email.required' => 'email is required',
            'password.required' => 'password is required',
            'address.required' => 'address is required',
            'user_type.required' => 'user type is require',
            'address.required' => 'address is require',
            'profile.required' => 'select profile image',
        ];
    }
}
