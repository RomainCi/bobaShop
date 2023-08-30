<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsSideRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "image" => 'nullable|image|mimes:jpeg,png,jpg|max:300',
            "name" => 'required|string',
            "description" => 'required|string',
            'price' => 'required|decimal:2',
            'quantity' => 'integer|required|min:1',
            "stock" => 'integer|required|min:0',
        ];
    }
}
