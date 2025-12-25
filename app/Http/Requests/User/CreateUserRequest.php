<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string|min:6',
            'email'     => 'required|string|email|unique:users,email',
            'country'   => 'string'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Name is required',
            'name.string'       => 'Name must be string',
            'name.min'          => 'Name must be at least 6 characters',
            'email.required'    => 'Email is required',
            'email.string'      => 'Email must be string',
            'email.email'       => 'Email must be a valid email',
            'email.unique'      => 'Email already exists',
        ];
    }
}
