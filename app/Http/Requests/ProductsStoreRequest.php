<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            '*.selectedTea.id' => 'required|numeric',
            '*.selectedSirop.id' => 'required|numeric',
            '*.selectedPerle.id' => 'required|numeric',
            '*.selectedMenu.id' => 'required|numeric',
            '*.selectedSide' => 'array',
            '*.selectedSide.*.id' => 'required|numeric',
        ];

    }
}
