<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request as BaseRequest;

class UserRegisterRequest extends FormRequest
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
    public function rules()//helps identifying why the request is denied when registering users
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ];
    }
    public function messages()
    {
    return [
        'first_name.required'=>'First Name field required',
        'last_name.required'=>'Last Name field required',
        'email.required'=>'Email field required',
        'password.required'=>'Password required'
    ];
    }

}
