<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ProfileDeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required', 'current_password'],
        ];
    }
}
