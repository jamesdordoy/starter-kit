<?php

namespace App\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Lowercase;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Sometimes;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

/** @typescript */
#[MapName(SnakeCaseMapper::class)]
class UserData extends Data
{
    public const DATA_NAME = 'user';

    public const COLLECTION_NAME = 'users';

    public function __construct(
        #[
            IntegerType,
            Min(1),
            Sometimes
        ]
        public ?int $id,

        #[
            Required,
            StringType,
            Max(255)
        ]
        public string $name,

        #[
            Required,
            Email,
            StringType,
            Lowercase,
            Max(255)
        ]
        public string $email,

        #[
            Required,
            StringType,
            Max(255),
        ]
        public string $password,

        public ?string $avatar,

        public ?string $twoFactorSecret,

        public ?string $twoFactorRecoveryCodes,

        public ?string $rememberToken,

        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $twoFactorConfirmedAt,

        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $emailVerifiedAt,

        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $createdAt,

        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $updatedAt,
    ) {}
}
