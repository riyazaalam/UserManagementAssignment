<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow public access
    }

    public function rules()
    {
        $userId = $this->input('id'); // get ID from request body

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => $this->isMethod('post')
                        ? 'required|min:6'
                        : 'sometimes|min:6'
        ];
    }

    // ✅ Add custom messages
    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name cannot exceed 255 characters.',

            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'This email is already registered.',

            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
        ];
    }

    // Optional: make JSON output for validation errors
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all(); // get all messages as flat array

        throw new ValidationException($validator, response()->json([
            'status' => false,
            'messages' => $errors
        ], 422));
    }
}
