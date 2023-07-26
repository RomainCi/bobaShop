<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInformationRequest extends FormRequest
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
            'address.street' => 'required|string',
            'address.country' => 'required|string',
            'address.city' => 'required|string',
            'address.postal_code' => 'required|string',
            'address.society' => 'nullable|string',
            'user.lastname' => 'required|string',
            'user.firstname' => 'required|string',
            'user.phone'=>'phone:INTERNATIONAL',
        ];
    }
}
