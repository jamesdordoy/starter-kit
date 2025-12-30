<?php

namespace App\Enums;

enum ActivityLogEnum: string
{
    case VIEW = 'view';
    case CREATED = 'created';
    case UPDATED = 'updated';
    case DELETED = 'deleted';
    case RESTORED = 'restored';
    case FORCE_DELETED = 'forceDeleted';
    case LOGIN = 'login';
    case LOGOUT = 'logout';
    case REGISTER = 'register';
    case IMPERSONATE = 'impersonate';
    case LEAVE_IMPERSONATE = 'leaveImpersonation';
    case MEDIA_ADDED = 'mediaAdded';

    public function description(): string
    {
        return match ($this) {
            self::VIEW => 'View',
            self::CREATED => 'Created',
            self::UPDATED => 'Updated',
            self::DELETED => 'Deleted',
            self::RESTORED => 'Restore',
            self::FORCE_DELETED => 'Force Deleted',
            self::LOGIN => 'Login',
            self::LOGOUT => 'Logout',
            self::REGISTER => 'Registered',
            self::IMPERSONATE => 'Impersonate',
            self::LEAVE_IMPERSONATE => 'Leave Impersonation',
            self::MEDIA_ADDED => 'Media Added',
        };
    }
}
