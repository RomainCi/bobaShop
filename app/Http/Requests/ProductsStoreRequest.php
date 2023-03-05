<?php

namespace App\Http\Requests;

use App\Models\ProductsMenu;
use Illuminate\Http\Request;
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
    public function rules(Request $request): array
    {
        //        dd("hello", $request);
//
//        $rules = [
//            "idPerle" => 'required|integer',
//            "idTea" => 'required|integer',
//            "idSirop" => 'required|integer'
//        ];
//
//        $menu = ProductsMenu::select('sides')->find($this->route('id'));
//        if ($menu->sides === 0) {
//            return $rules;
//        } else {
//            $idSideRules = ['idSide' => ['required', 'array']];
//            switch ($menu->sides) {
//                case 1:
//                    $idSideRules['idSide'][] = 'size:1';
//                    break;
//                case 2:
//                    $idSideRules['idSide'][] = 'size:2';
//                    break;
//                case 3:
//                    $idSideRules['idSide'][] = 'size:3';
//                    break;
//            }
//        };
//        $idSideRules['idSide.*'] = ['required', 'integer'];
//        $rules = array_merge($rules, $idSideRules);

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
