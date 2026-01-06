import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults, validateParameters } from './../../wayfinder'
import users from './users'
import activity from './activity'
import mediaItems from './media-items'
import logo from './logo'
import impersonate1fe2a3 from './impersonate'
/**
* @see \Lab404\Impersonate\Controllers\ImpersonateController::impersonate
* @see vendor/lab404/laravel-impersonate/src/Controllers/ImpersonateController.php:32
* @route '/settings/impersonate/take/{id}/{guardName?}'
*/
export const impersonate = (args: { id: string | number, guardName?: string | number } | [id: string | number, guardName: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: impersonate.url(args, options),
    method: 'get',
})

impersonate.definition = {
    methods: ["get","head"],
    url: '/settings/impersonate/take/{id}/{guardName?}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Lab404\Impersonate\Controllers\ImpersonateController::impersonate
* @see vendor/lab404/laravel-impersonate/src/Controllers/ImpersonateController.php:32
* @route '/settings/impersonate/take/{id}/{guardName?}'
*/
impersonate.url = (args: { id: string | number, guardName?: string | number } | [id: string | number, guardName: string | number ], options?: RouteQueryOptions) => {
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

    return impersonate.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace('{guardName?}', parsedArgs.guardName?.toString() ?? '')
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Lab404\Impersonate\Controllers\ImpersonateController::impersonate
* @see vendor/lab404/laravel-impersonate/src/Controllers/ImpersonateController.php:32
* @route '/settings/impersonate/take/{id}/{guardName?}'
*/
impersonate.get = (args: { id: string | number, guardName?: string | number } | [id: string | number, guardName: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: impersonate.url(args, options),
    method: 'get',
})

/**
* @see \Lab404\Impersonate\Controllers\ImpersonateController::impersonate
* @see vendor/lab404/laravel-impersonate/src/Controllers/ImpersonateController.php:32
* @route '/settings/impersonate/take/{id}/{guardName?}'
*/
impersonate.head = (args: { id: string | number, guardName?: string | number } | [id: string | number, guardName: string | number ], options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: impersonate.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\SettingController::index
* @see app/Http/Controllers/Settings/SettingController.php:15
* @route '/settings'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/settings',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\SettingController::index
* @see app/Http/Controllers/Settings/SettingController.php:15
* @route '/settings'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\SettingController::index
* @see app/Http/Controllers/Settings/SettingController.php:15
* @route '/settings'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\SettingController::index
* @see app/Http/Controllers/Settings/SettingController.php:15
* @route '/settings'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\SettingController::create
* @see app/Http/Controllers/Settings/SettingController.php:73
* @route '/settings/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/settings/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\SettingController::create
* @see app/Http/Controllers/Settings/SettingController.php:73
* @route '/settings/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\SettingController::create
* @see app/Http/Controllers/Settings/SettingController.php:73
* @route '/settings/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\SettingController::create
* @see app/Http/Controllers/Settings/SettingController.php:73
* @route '/settings/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\SettingController::store
* @see app/Http/Controllers/Settings/SettingController.php:81
* @route '/settings'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/settings',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Settings\SettingController::store
* @see app/Http/Controllers/Settings/SettingController.php:81
* @route '/settings'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\SettingController::store
* @see app/Http/Controllers/Settings/SettingController.php:81
* @route '/settings'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Settings\SettingController::show
* @see app/Http/Controllers/Settings/SettingController.php:89
* @route '/settings/{setting}'
*/
export const show = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/settings/{setting}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\SettingController::show
* @see app/Http/Controllers/Settings/SettingController.php:89
* @route '/settings/{setting}'
*/
show.url = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { setting: args }
    }

    if (Array.isArray(args)) {
        args = {
            setting: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        setting: args.setting,
    }

    return show.definition.url
            .replace('{setting}', parsedArgs.setting.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\SettingController::show
* @see app/Http/Controllers/Settings/SettingController.php:89
* @route '/settings/{setting}'
*/
show.get = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\SettingController::show
* @see app/Http/Controllers/Settings/SettingController.php:89
* @route '/settings/{setting}'
*/
show.head = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\SettingController::edit
* @see app/Http/Controllers/Settings/SettingController.php:97
* @route '/settings/{setting}/edit'
*/
export const edit = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/settings/{setting}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\SettingController::edit
* @see app/Http/Controllers/Settings/SettingController.php:97
* @route '/settings/{setting}/edit'
*/
edit.url = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { setting: args }
    }

    if (Array.isArray(args)) {
        args = {
            setting: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        setting: args.setting,
    }

    return edit.definition.url
            .replace('{setting}', parsedArgs.setting.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\SettingController::edit
* @see app/Http/Controllers/Settings/SettingController.php:97
* @route '/settings/{setting}/edit'
*/
edit.get = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\SettingController::edit
* @see app/Http/Controllers/Settings/SettingController.php:97
* @route '/settings/{setting}/edit'
*/
edit.head = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\SettingController::update
* @see app/Http/Controllers/Settings/SettingController.php:105
* @route '/settings/{setting}'
*/
export const update = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/settings/{setting}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Settings\SettingController::update
* @see app/Http/Controllers/Settings/SettingController.php:105
* @route '/settings/{setting}'
*/
update.url = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { setting: args }
    }

    if (Array.isArray(args)) {
        args = {
            setting: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        setting: args.setting,
    }

    return update.definition.url
            .replace('{setting}', parsedArgs.setting.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\SettingController::update
* @see app/Http/Controllers/Settings/SettingController.php:105
* @route '/settings/{setting}'
*/
update.put = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\Settings\SettingController::update
* @see app/Http/Controllers/Settings/SettingController.php:105
* @route '/settings/{setting}'
*/
update.patch = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\Settings\SettingController::destroy
* @see app/Http/Controllers/Settings/SettingController.php:113
* @route '/settings/{setting}'
*/
export const destroy = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/settings/{setting}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Settings\SettingController::destroy
* @see app/Http/Controllers/Settings/SettingController.php:113
* @route '/settings/{setting}'
*/
destroy.url = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { setting: args }
    }

    if (Array.isArray(args)) {
        args = {
            setting: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        setting: args.setting,
    }

    return destroy.definition.url
            .replace('{setting}', parsedArgs.setting.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\SettingController::destroy
* @see app/Http/Controllers/Settings/SettingController.php:113
* @route '/settings/{setting}'
*/
destroy.delete = (args: { setting: string | number } | [setting: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const settings = {
    users: Object.assign(users, users),
    activity: Object.assign(activity, activity),
    mediaItems: Object.assign(mediaItems, mediaItems),
    logo: Object.assign(logo, logo),
    impersonate: Object.assign(impersonate, impersonate1fe2a3),
    index: Object.assign(index, index),
    create: Object.assign(create, create),
    store: Object.assign(store, store),
    show: Object.assign(show, show),
    edit: Object.assign(edit, edit),
    update: Object.assign(update, update),
    destroy: Object.assign(destroy, destroy),
}

export default settings