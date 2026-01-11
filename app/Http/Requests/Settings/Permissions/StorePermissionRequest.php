<?php

declare(strict_types=1);

namespace App\Http\Requests\Settings\Permissions;

use App\Data\PermissionStoreData;
use Illuminate\Foundation\Http\FormRequest;

final class StorePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:permissions,name',
            'guard_name' => 'nullable|string',
            'routes' => 'sometimes|array',
            'routes.*' => 'exists:routes,id',
        ];
    }

    public function toDto(): PermissionStoreData
    {
        return PermissionStoreData::from($this->validated());
    }
}
