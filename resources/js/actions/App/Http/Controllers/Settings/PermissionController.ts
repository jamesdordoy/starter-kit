import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Settings\PermissionController::index
* @see app/Http/Controllers/Settings/PermissionController.php:24
* @route '/settings/permissions'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/settings/permissions',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\PermissionController::index
* @see app/Http/Controllers/Settings/PermissionController.php:24
* @route '/settings/permissions'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\PermissionController::index
* @see app/Http/Controllers/Settings/PermissionController.php:24
* @route '/settings/permissions'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\PermissionController::index
* @see app/Http/Controllers/Settings/PermissionController.php:24
* @route '/settings/permissions'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\PermissionController::create
* @see app/Http/Controllers/Settings/PermissionController.php:36
* @route '/settings/permissions/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/settings/permissions/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\PermissionController::create
* @see app/Http/Controllers/Settings/PermissionController.php:36
* @route '/settings/permissions/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\PermissionController::create
* @see app/Http/Controllers/Settings/PermissionController.php:36
* @route '/settings/permissions/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\PermissionController::create
* @see app/Http/Controllers/Settings/PermissionController.php:36
* @route '/settings/permissions/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\PermissionController::store
* @see app/Http/Controllers/Settings/PermissionController.php:44
* @route '/settings/permissions'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/settings/permissions',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Settings\PermissionController::store
* @see app/Http/Controllers/Settings/PermissionController.php:44
* @route '/settings/permissions'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\PermissionController::store
* @see app/Http/Controllers/Settings/PermissionController.php:44
* @route '/settings/permissions'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Settings\PermissionController::show
* @see app/Http/Controllers/Settings/PermissionController.php:54
* @route '/settings/permissions/{permission}'
*/
export const show = (args: { permission: number | { id: number } } | [permission: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/settings/permissions/{permission}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\PermissionController::show
* @see app/Http/Controllers/Settings/PermissionController.php:54
* @route '/settings/permissions/{permission}'
*/
show.url = (args: { permission: number | { id: number } } | [permission: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { permission: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { permission: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            permission: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        permission: typeof args.permission === 'object'
        ? args.permission.id
        : args.permission,
    }

    return show.definition.url
            .replace('{permission}', parsedArgs.permission.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\PermissionController::show
* @see app/Http/Controllers/Settings/PermissionController.php:54
* @route '/settings/permissions/{permission}'
*/
show.get = (args: { permission: number | { id: number } } | [permission: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\PermissionController::show
* @see app/Http/Controllers/Settings/PermissionController.php:54
* @route '/settings/permissions/{permission}'
*/
show.head = (args: { permission: number | { id: number } } | [permission: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\PermissionController::edit
* @see app/Http/Controllers/Settings/PermissionController.php:67
* @route '/settings/permissions/{permission}/edit'
*/
export const edit = (args: { permission: string | number } | [permission: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/settings/permissions/{permission}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\PermissionController::edit
* @see app/Http/Controllers/Settings/PermissionController.php:67
* @route '/settings/permissions/{permission}/edit'
*/
edit.url = (args: { permission: string | number } | [permission: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { permission: args }
    }

    if (Array.isArray(args)) {
        args = {
            permission: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        permission: args.permission,
    }

    return edit.definition.url
            .replace('{permission}', parsedArgs.permission.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\PermissionController::edit
* @see app/Http/Controllers/Settings/PermissionController.php:67
* @route '/settings/permissions/{permission}/edit'
*/
edit.get = (args: { permission: string | number } | [permission: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\PermissionController::edit
* @see app/Http/Controllers/Settings/PermissionController.php:67
* @route '/settings/permissions/{permission}/edit'
*/
edit.head = (args: { permission: string | number } | [permission: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\PermissionController::update
* @see app/Http/Controllers/Settings/PermissionController.php:77
* @route '/settings/permissions/{permission}'
*/
const update85581a55f617828e21b8e5546a942934 = (args: { permission: number | { id: number } } | [permission: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update85581a55f617828e21b8e5546a942934.url(args, options),
    method: 'put',
})

update85581a55f617828e21b8e5546a942934.definition = {
    methods: ["put","patch"],
    url: '/settings/permissions/{permission}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Settings\PermissionController::update
* @see app/Http/Controllers/Settings/PermissionController.php:77
* @route '/settings/permissions/{permission}'
*/
update85581a55f617828e21b8e5546a942934.url = (args: { permission: number | { id: number } } | [permission: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { permission: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { permission: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            permission: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        permission: typeof args.permission === 'object'
        ? args.permission.id
        : args.permission,
    }

    return update85581a55f617828e21b8e5546a942934.definition.url
            .replace('{permission}', parsedArgs.permission.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\PermissionController::update
* @see app/Http/Controllers/Settings/PermissionController.php:77
* @route '/settings/permissions/{permission}'
*/
update85581a55f617828e21b8e5546a942934.put = (args: { permission: number | { id: number } } | [permission: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update85581a55f617828e21b8e5546a942934.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\Settings\PermissionController::update
* @see app/Http/Controllers/Settings/PermissionController.php:77
* @route '/settings/permissions/{permission}'
*/
update85581a55f617828e21b8e5546a942934.patch = (args: { permission: number | { id: number } } | [permission: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update85581a55f617828e21b8e5546a942934.url(args, options),
    method: 'patch',
})

export const update = {
    '/settings/permissions/{permission}': update85581a55f617828e21b8e5546a942934,
}

/**
* @see \App\Http\Controllers\Settings\PermissionController::destroy
* @see app/Http/Controllers/Settings/PermissionController.php:86
* @route '/settings/permissions/{permission}'
*/
export const destroy = (args: { permission: number | { id: number } } | [permission: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/settings/permissions/{permission}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Settings\PermissionController::destroy
* @see app/Http/Controllers/Settings/PermissionController.php:86
* @route '/settings/permissions/{permission}'
*/
destroy.url = (args: { permission: number | { id: number } } | [permission: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { permission: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { permission: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            permission: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        permission: typeof args.permission === 'object'
        ? args.permission.id
        : args.permission,
    }

    return destroy.definition.url
            .replace('{permission}', parsedArgs.permission.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\PermissionController::destroy
* @see app/Http/Controllers/Settings/PermissionController.php:77
* @route '/settings/permissions/{permission}'
*/
destroy.delete = (args: { permission: number | { id: number } } | [permission: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const PermissionController = { index, create, store, show, edit, update, destroy }

export default PermissionController
