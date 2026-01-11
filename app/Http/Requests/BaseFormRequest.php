<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseFormRequest extends FormRequest
{
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
