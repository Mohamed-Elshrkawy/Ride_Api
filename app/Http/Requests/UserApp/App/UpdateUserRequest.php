<?php

namespace App\Http\Requests\UserApp\App;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'=>'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|string|email|max:100|unique:users',
            'phone' => 'nullable|string|max:20',
            'country_id'=>'nullable|string|max:20',
            'gender'=>'nullable|string|max:20',

        ];
    }
}
