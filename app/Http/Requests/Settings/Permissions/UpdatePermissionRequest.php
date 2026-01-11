<?php

declare(strict_types=1);

namespace App\Http\Requests\Settings\Permissions;

use App\Data\PermissionUpdateData;
use App\Http\Requests\BaseFormRequest;
use App\Models\Permission;
use Illuminate\Validation\Rule;

final class UpdatePermissionRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $permissionId = $this->getPermissionId();

        return [
            'name' => ['required', 'string', Rule::unique('permissions', 'name')->ignore($permissionId)],
            'guard_name' => 'nullable|string',
            'routes' => 'sometimes|array',
            'routes.*' => 'exists:routes,id',
        ];
    }

    public function toDto(): PermissionUpdateData
    {
        return PermissionUpdateData::from($this->validated());
    }

    private function getPermissionId(): int|string
    {
        $permissionId = $this->route('permission');

        return $permissionId instanceof Permission ? $permissionId->id : $permissionId;
    }
}
