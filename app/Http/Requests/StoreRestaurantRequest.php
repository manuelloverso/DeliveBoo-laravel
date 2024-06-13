<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
            'address' => 'required|min:5|max:100',
            'mail' => 'required|min:5|max:100|unique:restaurants,mail',
            'phone_number' => 'required|min:5|max:15',
            'vat' => 'required|min:10|max:20',
            'name' => 'required|min:3|max:50',
            'image' => 'nullable|max:255',
            'user_id' => 'nullable|exists:user,id',

        ];
    }
}
