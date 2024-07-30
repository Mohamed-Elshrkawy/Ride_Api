<?php

namespace App\Http\Requests\UserApp\App;

use Illuminate\Foundation\Http\FormRequest;

class CreateCarRequest extends FormRequest
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
            'car_type_id' => 'required|integer|exists:car_types,id',
            'car_model_id' => 'required|integer|exists:car_models,id',
            'car_color_id' => 'required|integer|exists:car_colors,id',
            'plate_type' => 'required|string|max:255',
            'manufacturing_year' => 'required|integer|min:2000|max:' . date('Y'),
            'numbers' => 'required|string|max:10',
            'plate_letters' => 'required|string|max:3',
            'form_expiration' => 'required|date|after:today',
            'insurance_expiration' => 'required|date|after:today',
            'form_serial_number' => 'required|string|max:255',
            'form_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Insurance_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delegation_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'the_lift_side_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'the_righ_side_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'front_seat_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'back_seat_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
