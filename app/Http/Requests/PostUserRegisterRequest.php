<?php

namespace App\Http\Requests;

use App\Models\PostUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostUserRegisterRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'affiliate' => ['string', 'max:255'],
            'zipcode' => ['integer', 'max:7'],
            'address_country' => ['string', 'max:10'],
            'address_city' => ['string'],
            'address_etc' => ['string'],
            'uuid' => ['string', 'max:36'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'お名前（姓）は必須項目です。',
            'last_name.required' => 'お名前（名）は必須項目です。',
        ];
    }
}
