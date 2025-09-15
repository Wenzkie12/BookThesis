<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => ['nullable', 'regex:/^(09|\+639)\d{9}$/'],
            'birthdate' => 'nullable|date',
            'age' => 'nullable|integer|min:1|max:120',
            'bio' => 'nullable|string|max:500',
            'province' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'barangay' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'The phone number must start with 09 or +639 and contain 11 digits.',
            'birthdate.date' => 'The birthdate must be a valid date.',
            'age.integer' => 'The age must be a valid number.',
            'avatar.image' => 'The avatar must be an image.',
            'avatar.mimes' => 'The avatar must be a file of type: jpeg, png, jpg.',
            'avatar.max' => 'The avatar must not be greater than 2MB.',
        ];
    }
}
