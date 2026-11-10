<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateModelShowroomRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'model_name'    => 'required|string|min:2|max:60',
            'description'   => 'nullable|string|max:255',
            'year'          => 'required|integer|min:1990|max:2030',
            'price'         => 'required|numeric|min:1',
            'image'         => 'nullable|image|mimes:png,jpg,jpeg,webp,gif|max:2048',
            'status'        => 'nullable|boolean',
            'display_order' => 'required|integer|min:1',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'model_name.required'    => 'The model name is required.',
            'model_name.min'         => 'The model name must be at least 2 characters.',
            'model_name.max'         => 'The model name must not exceed 60 characters.',
            'year.required'          => 'The manufacturing year is required.',
            'year.min'               => 'The year must be at least 1990.',
            'year.max'               => 'The year must not exceed 2030.',
            'price.required'         => 'The vehicle price is required.',
            'price.min'              => 'The price must be greater than 0.',
            'image.image'            => 'The file must be an image.',
            'image.mimes'            => 'The image must be a PNG, JPG, WEBP or GIF file.',
            'image.max'              => 'The image must be 2 MB or smaller.',
            'display_order.required' => 'The display order is required.',
            'display_order.min'      => 'The display order must be 1 or higher.',
        ];
    }
}

