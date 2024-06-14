<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Payloads\API\RegisterPayload;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ];
    }

    public function payload(): RegisterPayload
    {
        return RegisterPayload::make($this->all());
    }
}
