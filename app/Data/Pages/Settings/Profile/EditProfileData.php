<?php

namespace App\Data\Pages\Settings\Profile;

use Spatie\LaravelData\Attributes\MapName;
use App\Data\UserData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[
    MapName(SnakeCaseMapper::class)
]
class EditProfileData extends Data
{
    public function __construct(
        public bool $mustVerifyEmail,
        public ?string $status,
        public UserData $user,

    ) {}
}
