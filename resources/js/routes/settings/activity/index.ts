import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Settings\ActivityLogController::index
* @see app/Http/Controllers/Settings/ActivityLogController.php:18
* @route '/settings/activity'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/settings/activity',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\ActivityLogController::index
* @see app/Http/Controllers/Settings/ActivityLogController.php:18
* @route '/settings/activity'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\ActivityLogController::index
* @see app/Http/Controllers/Settings/ActivityLogController.php:18
* @route '/settings/activity'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\ActivityLogController::index
* @see app/Http/Controllers/Settings/ActivityLogController.php:18
* @route '/settings/activity'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\ActivityLogController::show
* @see app/Http/Controllers/Settings/ActivityLogController.php:41
* @route '/settings/activity/{activity}'
*/
export const show = (args: { activity: number | { id: number } } | [activity: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/settings/activity/{activity}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\ActivityLogController::show
* @see app/Http/Controllers/Settings/ActivityLogController.php:41
* @route '/settings/activity/{activity}'
*/
show.url = (args: { activity: number | { id: number } } | [activity: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { activity: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { activity: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            activity: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        activity: typeof args.activity === 'object'
        ? args.activity.id
        : args.activity,
    }

    return show.definition.url
            .replace('{activity}', parsedArgs.activity.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\ActivityLogController::show
* @see app/Http/Controllers/Settings/ActivityLogController.php:41
* @route '/settings/activity/{activity}'
*/
show.get = (args: { activity: number | { id: number } } | [activity: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\ActivityLogController::show
* @see app/Http/Controllers/Settings/ActivityLogController.php:41
* @route '/settings/activity/{activity}'
*/
show.head = (args: { activity: number | { id: number } } | [activity: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

const activity = {
    index: Object.assign(index, index),
    show: Object.assign(show, show),
}

export default activity