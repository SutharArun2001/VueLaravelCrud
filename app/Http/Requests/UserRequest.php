<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string|max:250',
            'lastname' => 'required|string|max:250',
            'username' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'phonenumber' => 'required|numeric|digits:10',
            'gender' => 'required|string|max:50',
            'password' => 'required|string|max:250',
        ];
    }
}
