<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Payloads\API\LoginPayload;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    public function payload(): LoginPayload
    {
        return LoginPayload::make($this->all());
    }
}
