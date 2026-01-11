<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\BaseFormRequest;

class ProfileAvatarUpdateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
