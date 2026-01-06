import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults, validateParameters } from './../../../../wayfinder'
/**
* @see \Lab404\Impersonate\Controllers\ImpersonateController::take
* @see vendor/lab404/laravel-impersonate/src/Controllers/ImpersonateController.php:32
* @route '/settings/impersonate/take/{id}/{guardName?}'
*/
export const take = (args: { id: string | number, guardName?: string | number } | [id: string | number, guardName: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: take.url(args, options),
    method: 'get',
})

take.definition = {
    methods: ["get","head"],
    url: '/settings/impersonate/take/{id}/{guardName?}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Lab404\Impersonate\Controllers\ImpersonateController::take
* @see vendor/lab404/laravel-impersonate/src/Controllers/ImpersonateController.php:32
* @route '/settings/impersonate/take/{id}/{guardName?}'
*/
take.url = (args: { id: string | number, guardName?: string | number } | [id: string | number, guardName: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
            id: args[0],
            guardName: args[1],
        }
    }

    args = applyUrlDefaults(args)

    validateParameters(args, [
        "guardName",
    ])

    const parsedArgs = {
        id: args.id,
        guardName: args.guardName,
    }

    return take.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace('{guardName?}', parsedArgs.guardName?.toString() ?? '')
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Lab404\Impersonate\Controllers\ImpersonateController::take
* @see vendor/lab404/laravel-impersonate/src/Controllers/ImpersonateController.php:32
* @route '/settings/impersonate/take/{id}/{guardName?}'
*/
take.get = (args: { id: string | number, guardName?: string | number } | [id: string | number, guardName: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: take.url(args, options),
    method: 'get',
})

/**
* @see \Lab404\Impersonate\Controllers\ImpersonateController::take
* @see vendor/lab404/laravel-impersonate/src/Controllers/ImpersonateController.php:32
* @route '/settings/impersonate/take/{id}/{guardName?}'
*/
take.head = (args: { id: string | number, guardName?: string | number } | [id: string | number, guardName: string | number ], options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: take.url(args, options),
    method: 'head',
})

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

const ImpersonateController = { take, leave }

export default ImpersonateController