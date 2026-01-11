<?php

namespace App\Enums;

enum RoleEnum: string
{
    case VISITOR = 'visitor';
    case MANAGER = 'manager';
    case STAFF = 'staff';
    case ADMIN = 'admin';
}
