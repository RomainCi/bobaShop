<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Propaganistas\LaravelPhone\PhoneNumber;

class StoreRegisterRequest extends FormRequest
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
            "lastname" => 'required|max:55|string',
            "firstname" => 'required|max:55|string',
            "birthdays" => 'date_format:d/m/Y|before:today',
            'phone'=> 'phone:INTERNATIONAL',
            "email" => 'required|email',
            "password" => ['required', 'confirmed', Password::min(8)->numbers()->mixedCase()->symbols()],
            "password_confirmation" => 'required',
            "check" => ['required', Rule::in(true)],
        ];
    }
}
