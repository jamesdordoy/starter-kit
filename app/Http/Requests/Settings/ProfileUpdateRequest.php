<?php

namespace App\Http\Requests\Settings;

use App\Data\UserData;
use App\Models\User;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => UserData::getValidationRules([])['name'],
            'email' => [
                ...UserData::getValidationRules([])['email'],
                Rule::unique(User::class, 'email')->ignore($this->user()->id),
            ],
        ];
    }
}
