<?php

namespace App\Enums;

enum RoleEnum: string
{
    case MANAGER = 'manager';
    case STAFF = 'staff';
    case ADMIN = 'admin';

    public function getPermissions(): array
    {
        return match ($this) {
            self::MANAGER => [
                PermissionEnum::VIEW_USERS,
                PermissionEnum::CREATE_USERS,
                PermissionEnum::UPDATE_USERS,
                PermissionEnum::DELETE_USERS,
                PermissionEnum::RESTORE_USERS,
            ],
            self::STAFF => [

            ],
            self::ADMIN => [
                // All permissions
                PermissionEnum::values(),
            ],
            default => [],
        };
    }
}
