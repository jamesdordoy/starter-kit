<?php

declare(strict_types=1);

namespace App\Http\Requests\Settings\Roles;

use App\Data\RoleUpdateData;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $roleId = $this->getRoleId();

        return [
            'name' => ['required', 'string', Rule::unique('roles', 'name')->ignore($roleId)],
            'guard_name' => 'nullable|string',
            'permissions' => 'sometimes|array',
            'permissions.*' => 'exists:permissions,id',
        ];
    }

    public function toDto(): RoleUpdateData
    {
        return RoleUpdateData::from($this->validated());
    }

    private function getRoleId(): int|string
    {
        $roleId = $this->route('role');

        return $roleId instanceof Role ? $roleId->id : $roleId;
    }
}
