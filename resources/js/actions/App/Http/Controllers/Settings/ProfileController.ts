import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Settings\ProfileController::edit
* @see app/Http/Controllers/Settings/ProfileController.php:24
* @route '/settings/profile/{profile}/edit'
*/
export const edit = (args: { profile: number | { id: number } } | [profile: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/settings/profile/{profile}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\ProfileController::edit
* @see app/Http/Controllers/Settings/ProfileController.php:24
* @route '/settings/profile/{profile}/edit'
*/
edit.url = (args: { profile: number | { id: number } } | [profile: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { profile: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { profile: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            profile: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        profile: typeof args.profile === 'object'
        ? args.profile.id
        : args.profile,
    }

    return edit.definition.url
            .replace('{profile}', parsedArgs.profile.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\ProfileController::edit
* @see app/Http/Controllers/Settings/ProfileController.php:24
* @route '/settings/profile/{profile}/edit'
*/
edit.get = (args: { profile: number | { id: number } } | [profile: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\ProfileController::edit
* @see app/Http/Controllers/Settings/ProfileController.php:24
* @route '/settings/profile/{profile}/edit'
*/
edit.head = (args: { profile: number | { id: number } } | [profile: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\ProfileController::update
* @see app/Http/Controllers/Settings/ProfileController.php:38
* @route '/settings/profile/{profile}'
*/
export const update = (args: { profile: number | { id: number } } | [profile: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/settings/profile/{profile}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Settings\ProfileController::update
* @see app/Http/Controllers/Settings/ProfileController.php:38
* @route '/settings/profile/{profile}'
*/
update.url = (args: { profile: number | { id: number } } | [profile: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { profile: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { profile: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            profile: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        profile: typeof args.profile === 'object'
        ? args.profile.id
        : args.profile,
    }

    return update.definition.url
            .replace('{profile}', parsedArgs.profile.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\ProfileController::update
* @see app/Http/Controllers/Settings/ProfileController.php:38
* @route '/settings/profile/{profile}'
*/
update.put = (args: { profile: number | { id: number } } | [profile: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\Settings\ProfileController::update
* @see app/Http/Controllers/Settings/ProfileController.php:38
* @route '/settings/profile/{profile}'
*/
update.patch = (args: { profile: number | { id: number } } | [profile: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\Settings\ProfileController::destroy
* @see app/Http/Controllers/Settings/ProfileController.php:53
* @route '/settings/profile/{profile}'
*/
export const destroy = (args: { profile: number | { id: number } } | [profile: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/settings/profile/{profile}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Settings\ProfileController::destroy
* @see app/Http/Controllers/Settings/ProfileController.php:53
* @route '/settings/profile/{profile}'
*/
destroy.url = (args: { profile: number | { id: number } } | [profile: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { profile: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { profile: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            profile: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        profile: typeof args.profile === 'object'
        ? args.profile.id
        : args.profile,
    }

    return destroy.definition.url
            .replace('{profile}', parsedArgs.profile.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\ProfileController::destroy
* @see app/Http/Controllers/Settings/ProfileController.php:53
* @route '/settings/profile/{profile}'
*/
destroy.delete = (args: { profile: number | { id: number } } | [profile: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const ProfileController = { edit, update, destroy }

export default ProfileController