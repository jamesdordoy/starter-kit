<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Automatically checks route permissions based on the route name.
     * Uses the user's getAccessibleRouteNames() method which leverages
     * Spatie Laravel Permissions (via getAllPermissions()) to check if
     * the user has access to the route through their permissions (direct
     * or via roles). Also handles admin access.
     *
     * @see \App\Models\User::getAccessibleRouteNames()
     * @see https://spatie.be/docs/laravel-permission
     *
     * Override this method if you need custom authorization logic.
     */
    public function authorize(): bool
    {
        $routeName = $this->route()?->getName();

        if (! $routeName) {
            return false;
        }

        $user = $this->user();

        if (! $user) {
            return false;
        }

        return in_array($routeName, $user->getAccessibleRouteNames());
    }
}
