<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\MediaCollectionEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $email
 * @property-read string $password
 * @property-read string|null $remember_token
 * @property-read string|null $email_verified_at
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read string $formatted_email_verified_at
 */
#[UseFactory(UserFactory::class)]
final class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasFactory, HasRoles, Impersonate, InteractsWithMedia, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'formatted_email_verified_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function formattedEmailVerifiedAt(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->email_verified_at?->format('d/m/Y'),
        );
    }

    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'causer');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "User has been {$eventName}")
            ->logUnguarded()
            ->logOnlyDirty();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollectionEnum::AVATARS->value)->singleFile();
    }

    public function scopeRoles(Builder $query, $roles): Builder
    {
        return $query->whereHas('roles', fn ($query) => $query->whereIn('name', $roles)
            ->where('guard_name', 'web')
        );
    }

    #[Scope]
    public function search(Builder $query, $search): Builder
    {
        return $query->where(fn ($query) => $query->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
        );
    }

    public function accessibleRoutes()
    {
        if ($this->hasRole('admin')) {
            return Route::query();
        }

        $permissionIds = $this->getAllPermissions()->pluck('id')->toArray();

        return Route::where(function ($query) use ($permissionIds) {
            // Public routes are accessible to all authenticated users (except visitors)
            $query->where('is_public', true)
                // OR routes assigned to user's permissions
                ->orWhereHas('permissions', function ($q) use ($permissionIds) {
                    $q->whereIn('permissions.id', $permissionIds);
                });
        });
    }

    public function getAccessibleRouteNames(): array
    {
        return $this->accessibleRoutes()->pluck('name')->toArray();
    }
}
