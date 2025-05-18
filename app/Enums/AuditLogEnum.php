<?php

namespace App\Enums;

enum AuditLogEnum: string
{
    case VIEW = 'view';
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case RESTORE = 'restore';
    case LOGIN = 'login';
    case LOGOUT = 'logout';

    public function description(): string
    {
        return match ($this) {
            self::VIEW => 'View',
            self::CREATE => 'Create',
            self::UPDATE => 'Update',
            self::DELETE => 'Delete',
            self::RESTORE => 'Restore',
            self::LOGIN => 'Login',
            self::LOGOUT => 'Log Out',
        };
    }
}
