<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'email'=>['required', 'email', Rule::unique(User::class)],
            'password'=>['required', 'min:3', 'regex:/[A-Z]/', 'regex:/[a-z]/', 'regex:/\d/', 'regex:/[_!$%#]/'],
        ];
    }
}
