<?php

namespace App\Http\Requests;

use App\Models\ProductsMenu;
use App\Models\ProductsPearl;
use App\Models\ProductsSide;
use App\Models\ProductsSyrup;
use App\Models\ProductsTea;
use App\Rules\OrdersRule;
use Illuminate\Foundation\Http\FormRequest;
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
//    public function rules()
//    {
//        $rules = [
//            'data' => ['required', 'array'],
//        ];
//
//        $data = $this->input('data');
//        $chunks = array_chunk($data, 100); // divise le tableau en parties de 100 entrées
////        dd($chunks);
//        foreach ($chunks as $index => $chunk) {
//            $chunkRules = [
//                "{$index}.*.teas" => ['required','sometimes', 'array'],
//                "{$index}.*.teas.id" => ['required','sometimes', 'integer', 'min:1'],
//                "{$index}.*.syrups" => ['required','sometimes', 'array'],
//                "{$index}.*.syrups.id" => ['required','sometimes', 'integer', 'min:1'],
//                "{$index}.*.pearls" => ['required','sometimes', 'array'],
//                "{$index}.*.pearls.id" => ['required','sometimes', 'integer', 'min:1'],
//                "{$index}.*.menus" => ['required','sometimes', 'array'],
//                "{$index}.*.menus.id" => ['required','sometimes', 'integer', 'min:1'],
//                "{$index}.*.sides" => ['nullable', 'array'],
//                "{$index}.*.sides.*.id" => ['required','sometimes', 'integer', 'min:1'],
//            ];
//
//            $rules = array_merge($rules, $chunkRules);
//        }
//
//        return $rules;
//    }
//    public function rules()
//    {
//        $rules = [
//            'data' => ['required', 'array'],
//        ];
//
//        $data = $this->input('data');
//
//        $rules['data.*'] = ['required', 'array', function ($attribute, $value, $fail) {
//            $validator = Validator::make($value, [
//                'teas' => ['required', 'array'],
//                'teas.id' => ['required', 'integer', 'min:1'],
//                'syrups' => ['required', 'array'],
//                'syrups.id' => ['required', 'integer', 'min:1'],
//                'pearls' => ['required', 'array'],
//                'pearls.id' => ['required', 'integer', 'min:1'],
//                'menus' => ['required', 'array'],
//                'menus.id' => ['required', 'integer', 'min:1'],
//                'sides' => ['nullable', 'array'],
//                'sides.*.id' => ['required', 'integer', 'min:1'],
//            ]);
//
//            if ($validator->fails()) {
//                $fail("Invalid data in {$attribute}.");
//            }
//        }];
//
//        return $rules;
//    }
//    public function rules()
//    {
//        $menuIds = ProductsMenu::pluck('id')->toArray();
//        $teaIds = ProductsTea::pluck('id')->toArray();
//        $syrupIds = ProductsSyrup::pluck('id')->toArray();
//        $pearlIds = ProductsPearl::pluck('id')->toArray();
//        $sideIds = ProductsSide::pluck('id')->toArray();
//
//        return [
//            'data' => ['required', 'array'],
//            'data.*' => ['required', 'array'],
//            'data.*.teas' => ['required', 'array'],
//            'data.*.teas.id' => ['required', 'integer', 'min:1', Rule::in($teaIds)],
//            'data.*.syrups' => ['required', 'array'],
//            'data.*.syrups.id' => ['required', 'integer', 'min:1', Rule::in($syrupIds)],
//            'data.*.pearls' => ['required', 'array'],
//            'data.*.pearls.id' => ['required', 'integer', 'min:1', Rule::in($pearlIds)],
//            'data.*.menus' => ['required', 'array'],
//            'data.*.menus.id' => ['required', 'integer', 'min:1', Rule::in($menuIds)],
//            'data.*.sides' => ['nullable', 'array'],
//            'data.*.sides.*.id' => ['required', 'integer', 'min:1', Rule::in($sideIds)],
//        ];
//    }

    public function rules()
    {
        return [
            'data' => ['required', 'array', new OrdersRule()],
        ];
    }

//    public function rules()
//    {
//        return [
//            'data' => ['required', 'array'],
//            'data.*' => ['required', 'array'],
//            'data.*.teas' => ['required', 'array'],
//            'data.*.teas.id' => ['required', 'integer', 'min:1'],
//            'data.*.syrups' => ['required', 'array'],
//            'data.*.syrups.id' => ['required', 'integer', 'min:1'],
//            'data.*.pearls' => ['required', 'array'],
//            'data.*.pearls.id' => ['required', 'integer', 'min:1'],
//            'data.*.menus' => ['required', 'array'],
//            'data.*.menus.id' => ['required', 'integer', 'min:1'],
//            'data.*.sides' => ['nullable', 'array'],
//            'data.*.sides.*.id' => ['required', 'integer', 'min:1'],
//        ];
//    }
//    public function rules()
//    {
//        $rules = [
//            'data' => ['required', 'array'],
//        ];
//
//        $data = $this->input('data');
//
//        $rules['data.*'] = [
//            'required',
//            'array',
//            Rule::each(
//                Validator::make([], [
//                    'teas' => ['required', 'array'],
//                    'teas.id' => ['required', 'integer', 'min:1'],
//                    'syrups' => ['required', 'array'],
//                    'syrups.id' => ['required', 'integer', 'min:1'],
//                    'pearls' => ['required', 'array'],
//                    'pearls.id' => ['required', 'integer', 'min:1'],
//                    'menus' => ['required', 'array'],
//                    'menus.id' => ['required', 'integer', 'min:1'],
//                    'sides' => ['nullable', 'array'],
//                    'sides.*.id' => ['required', 'integer', 'min:1'],
//                ])
//            )
//        ];
//
//        return $rules;
//    }

}
