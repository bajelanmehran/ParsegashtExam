<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'country'        => 'string|nullable',
            'currency'       => 'string|nullable',
            'orderBy'        => 'nullable|in:id,name,email,country,currency',
            'orderDirection' => 'nullable|in:asc,desc,ASC,DESC',
        ];
    }
}
