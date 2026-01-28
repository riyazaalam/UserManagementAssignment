<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(){
    if ($this->routeIs('show.user')) {
        return [
            'id' => 'required|exists:users,id',
        ];
    }

    if ($this->isMethod('post')) {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];
    }

    if ($this->isMethod('put')) {
        return [
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->input('id'),
            'password' => 'sometimes|required|min:6',
        ];
    }

    return [];
}


    public function messages()
    {
        return [
            'id.required' => 'User ID is required.',
            'id.exists'   => 'The selected user does not exist.',

            'name.required' => 'Name is required.',
            'name.string'   => 'Name must be a valid string.',
            'name.max'      => 'Name cannot exceed 255 characters.',

            'email.required' => 'Email is required.',
            'email.email'    => 'Please provide a valid email address.',
            'email.unique'   => 'This email is already registered.',

            'password.required' => 'Password is required.',
            'password.min'      => 'Password must be at least 6 characters long.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, response()->json([
        'message' => 'The given data was invalid.',
        'errors' => $validator->errors()
    ], 422));
    }
}
