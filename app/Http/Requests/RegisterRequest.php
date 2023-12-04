<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'username' => 'required|string|min:4|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];
    }
}
