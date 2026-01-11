<?php

namespace App\Enums;

enum RoleEnum: string
{
    case MANAGER = 'manager';
    case STAFF = 'staff';
    case ADMIN = 'admin';
}
