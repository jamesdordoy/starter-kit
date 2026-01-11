<?php

declare(strict_types=1);

namespace App\Http\Requests\Settings\Roles;

use App\Data\RoleStoreData;
use Illuminate\Foundation\Http\FormRequest;

final class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:roles,name',
            'guard_name' => 'nullable|string',
            'permissions' => 'sometimes|array',
            'permissions.*' => 'exists:permissions,id',
        ];
    }

    public function toDto(): RoleStoreData
    {
        return RoleStoreData::from($this->validated());
    }
}
