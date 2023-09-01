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
            'first_name' => 'required|string|max:250',
            'last_name' => 'required|string|max:250',
            'user_name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'phone_number' => 'required|numeric|digits:10',
            'gender' => 'required|string|max:50',
            'password' => 'required|string',
            'password_confirmation' => 'required|string|same:password',
        ];
    }

    public function messages()
    {
        return [
            'phone_number.numberic' => 'Phone Number should be numberic',
            'password_confirmation.required' => 'Confirmation Password is required. ',
            'password_confirmation.same' => 'Password is not match. ',
        ];
    }
}
