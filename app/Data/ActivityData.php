<?php

namespace App\Data;

use Spatie\Activitylog\Models\Activity;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;

class ActivityData extends Data
{
    public function __construct(
        public int $id,
        public string $log_name,
        public string $description,
        public ?UserData $causer,
        public array $properties,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public \DateTimeInterface $created_at,
    ) {
    }
} 