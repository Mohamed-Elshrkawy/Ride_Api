<?php

namespace App\Http\Requests\UserApp\App;

use Illuminate\Foundation\Http\FormRequest;

class CreateRideRequest extends FormRequest
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
            'start_location.name'=>'required|string',
            'start_location.latitude' => 'required|numeric',
            'start_location.longitude' => 'required|numeric',
            'end_location.name'=>'required|string',
            'end_location.latitude' => 'required|numeric',
            'end_location.longitude' => 'required|numeric',
            'start_time'=>'required|date',
            'category_id'=>'required|exists:categories,id'

        ];
    }
}
