<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlateRequest extends FormRequest
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
            'name' => 'required|max:50',
            'image' => 'nullable|image|max:5000',
            'description' => 'nullable|max:600',
            'price' => 'required|numeric|max:1000|decimal:2',
            'is_visible' => 'nullable|boolean',
        ];
    }
}
