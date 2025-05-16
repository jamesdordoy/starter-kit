<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case VIEW_USERS = 'view_users';
    case CREATE_USERS = 'create_users';
    case UPDATE_USERS = 'update_users';
    case DELETE_USERS = 'delete_users';
    case RESTORE_USERS = 'restore_users';
}
