<?php

namespace App\Enums;

enum MediaCollectionEnum: string
{
    case DEFAULT = 'default';
    case AVATARS = 'avatars';
    const SITE_LOGO = 'site_logo';
}
