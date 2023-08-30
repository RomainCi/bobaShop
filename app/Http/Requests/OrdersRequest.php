<?php

namespace App\Http\Requests;

use App\Models\ProductsMenu;
use App\Models\ProductsPearl;
use App\Models\ProductsSide;
use App\Models\ProductsSyrup;
use App\Models\ProductsTea;
use App\Rules\OrdersRule;
use App\Rules\TimeAfter33Minutes;
use DateTimeZone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class OrdersRequest extends FormRequest

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
            'hours' => [
                'required',
                'date_format:H:i',
                new TimeAfter33Minutes(),
            ],
        ];
    }
}
