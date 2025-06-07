<?php

namespace App\Enums;

enum ActivityLogEnum: string
{
    case VIEW = 'view';
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case RESTORE = 'restore';
    case LOGIN = 'login';
    case LOGOUT = 'logout';
    case REGISTER = 'register';
    case IMPERSONATE = 'impersonate';
    case LEAVE_IMPERSONATE = 'leave_impersonate';
    case MEDIA_ADDED = 'media_added';

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
            self::REGISTER => 'Register',
            self::IMPERSONATE => 'Impersonate',
            self::LEAVE_IMPERSONATE => 'Leave Impersonate',
            self::MEDIA_ADDED => 'Media Added',
        };
    }
}
