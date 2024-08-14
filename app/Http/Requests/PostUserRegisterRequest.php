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
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'affiliate' => 'required|string|max:255',
            'zipcode' => 'integer|digits:7',
            'address_country' => 'string|max:10',
            'address_city' => 'string',
            'address_etc' => 'string|nullable',
            'uuid' => 'string|max:36',
            'password' => 'required|alpha-num|min:8|max:50|confirmed',
            'password_confirmation' => 'required|string|max:50',
            'email' => 'string|lowercase|max:100',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => '※お名前（姓）は必須項目です',
            'first_name.max' => '※最大20文字までです',
            'last_name.required' => '※お名前（名）は必須項目です',
            'last_name.max' => '※最大20文字までです',
            'affiliate.required' => '※所属施設名は必須項目です',
            'zipcode.integer' => '※郵便番号は数字で入力してください',
            'zipcode.digits' => '※郵便番号は7文字で入力してください',
            'password.alpha-num' => '※パスワードは英数字のみで入力してください',
            'password.min' => '※パスワードは8文字以上50文字以内で入力してください',
            'password.max' => '※パスワードは8文字以上50文字以内で入力してください',
            'password.confirmed' => '※パスワードが一致しません'
        ];
    }
}
