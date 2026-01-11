<?php

namespace App\Http\Requests\Settings\Users;

use App\Http\Requests\BaseFormRequest;

class UpdateRolesAndPermissionsRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'roles' => 'sometimes|array',
            'roles.*.id' => 'required_with:roles|integer|exists:roles,id',
            'roles.*.name' => 'required_with:roles|string|exists:roles,name',
            'permissions' => 'sometimes|array',
            'permissions.*' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'roles.*.id.exists' => 'The selected role is invalid.',
            'roles.*.name.exists' => 'The selected role is invalid.',
        ];
    }
}
