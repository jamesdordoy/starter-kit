<?php

namespace App\Enums;

enum AuditLogEnum: string
{
    case VIEW = 'view';
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case RESTORE = 'restore';
    case LOGIN = 'view_settings';
    case LOGOUT = 'view_activity_log';

    public function description(): string
    {
        return match ($this) {
            self::VIEW => 'Tools',
            self::CREATE => 'Consumables',
            self::UPDATE => 'Hardware',
            self::DELETE => 'Equipment',
            self::RESTORE => 'Product',
            self::LOGIN => 'Equipment',
            self::LOGOUT => 'Product',
        };
    }
}
