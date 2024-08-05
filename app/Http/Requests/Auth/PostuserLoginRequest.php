<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PostuserLoginRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required',
            'uuid' => 'required',
        ];
    }

    public function authenticate(): void
    {
        if (!Auth::guard('postuser')->attempt($this->only('email', 'password', 'uuid'))) {
            throw ValidationException::withMessages(['failed' => __('auth.failed')]);
        }
    }
}
