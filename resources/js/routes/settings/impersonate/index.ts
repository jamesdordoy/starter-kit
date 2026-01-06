import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../wayfinder'
/**
* @see \Lab404\Impersonate\Controllers\ImpersonateController::leave
* @see vendor/lab404/laravel-impersonate/src/Controllers/ImpersonateController.php:67
* @route '/settings/impersonate/leave'
*/
export const leave = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: leave.url(options),
    method: 'get',
})

leave.definition = {
    methods: ["get","head"],
    url: '/settings/impersonate/leave',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Lab404\Impersonate\Controllers\ImpersonateController::leave
* @see vendor/lab404/laravel-impersonate/src/Controllers/ImpersonateController.php:67
* @route '/settings/impersonate/leave'
*/
leave.url = (options?: RouteQueryOptions) => {
    return leave.definition.url + queryParams(options)
}

/**
* @see \Lab404\Impersonate\Controllers\ImpersonateController::leave
* @see vendor/lab404/laravel-impersonate/src/Controllers/ImpersonateController.php:67
* @route '/settings/impersonate/leave'
*/
leave.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: leave.url(options),
    method: 'get',
})

/**
* @see \Lab404\Impersonate\Controllers\ImpersonateController::leave
* @see vendor/lab404/laravel-impersonate/src/Controllers/ImpersonateController.php:67
* @route '/settings/impersonate/leave'
*/
leave.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: leave.url(options),
    method: 'head',
})

const impersonate = {
    leave: Object.assign(leave, leave),
}

export default impersonate