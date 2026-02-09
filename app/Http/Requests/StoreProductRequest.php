<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            "name" => "required|string|unique:products|max:255",
            "price" => "required|numeric|min:1",
            "size" => "required|string",
            "quantity" => "required|numeric|min:1",
            "description" => "required|string|max:1000",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" =>
                "The product needs a name before it can be saved.",
            "name.unique" =>
                "Nama product duplicate. Gunakan nama product lain.",
            "price.min" => "The price cannot be less than one.",
            "quantity.min" => "You must have at least :min item in stock.",
            "description.required" => "Wajib isi deskripsi",
        ];
    }
}
