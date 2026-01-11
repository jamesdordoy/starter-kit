<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\BaseFormRequest;

class ProfileDeleteRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required', 'current_password'],
        ];
    }
}
