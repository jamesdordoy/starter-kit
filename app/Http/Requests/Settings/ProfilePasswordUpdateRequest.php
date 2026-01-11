<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rules\Password;

class ProfilePasswordUpdateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ];
    }
}
