<?php

namespace App\Http\Requests;

use App\Rules\OrdersRule;
use App\Rules\StockRule;
use Illuminate\Foundation\Http\FormRequest;

class PostBasketRequest extends FormRequest
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
            'data' => ['required', 'array', new OrdersRule(),new StockRule()],
        ];
    }
}
