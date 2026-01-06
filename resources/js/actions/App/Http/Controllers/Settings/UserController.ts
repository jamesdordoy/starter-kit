import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Settings\UserController::index
* @see app/Http/Controllers/Settings/UserController.php:26
* @route '/settings/users'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/settings/users',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\UserController::index
* @see app/Http/Controllers/Settings/UserController.php:26
* @route '/settings/users'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\UserController::index
* @see app/Http/Controllers/Settings/UserController.php:26
* @route '/settings/users'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\UserController::index
* @see app/Http/Controllers/Settings/UserController.php:26
* @route '/settings/users'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\UserController::create
* @see app/Http/Controllers/Settings/UserController.php:42
* @route '/settings/users/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/settings/users/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\UserController::create
* @see app/Http/Controllers/Settings/UserController.php:42
* @route '/settings/users/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\UserController::create
* @see app/Http/Controllers/Settings/UserController.php:42
* @route '/settings/users/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\UserController::create
* @see app/Http/Controllers/Settings/UserController.php:42
* @route '/settings/users/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\UserController::store
* @see app/Http/Controllers/Settings/UserController.php:50
* @route '/settings/users'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/settings/users',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Settings\UserController::store
* @see app/Http/Controllers/Settings/UserController.php:50
* @route '/settings/users'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\UserController::store
* @see app/Http/Controllers/Settings/UserController.php:50
* @route '/settings/users'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Settings\UserController::show
* @see app/Http/Controllers/Settings/UserController.php:58
* @route '/settings/users/{user}'
*/
export const show = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/settings/users/{user}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\UserController::show
* @see app/Http/Controllers/Settings/UserController.php:58
* @route '/settings/users/{user}'
*/
show.url = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { user: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { user: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            user: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        user: typeof args.user === 'object'
        ? args.user.id
        : args.user,
    }

    return show.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\UserController::show
* @see app/Http/Controllers/Settings/UserController.php:58
* @route '/settings/users/{user}'
*/
show.get = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\UserController::show
* @see app/Http/Controllers/Settings/UserController.php:58
* @route '/settings/users/{user}'
*/
show.head = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\UserController::edit
* @see app/Http/Controllers/Settings/UserController.php:75
* @route '/settings/users/{user}/edit'
*/
export const edit = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/settings/users/{user}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\UserController::edit
* @see app/Http/Controllers/Settings/UserController.php:75
* @route '/settings/users/{user}/edit'
*/
edit.url = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { user: args }
    }

    if (Array.isArray(args)) {
        args = {
            user: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        user: args.user,
    }

    return edit.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\UserController::edit
* @see app/Http/Controllers/Settings/UserController.php:75
* @route '/settings/users/{user}/edit'
*/
edit.get = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\UserController::edit
* @see app/Http/Controllers/Settings/UserController.php:75
* @route '/settings/users/{user}/edit'
*/
edit.head = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\UserController::update
* @see app/Http/Controllers/Settings/UserController.php:83
* @route '/settings/users/{user}'
*/
const update85581a55f617828e21b8e5546a942932 = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update85581a55f617828e21b8e5546a942932.url(args, options),
    method: 'put',
})

update85581a55f617828e21b8e5546a942932.definition = {
    methods: ["put","patch"],
    url: '/settings/users/{user}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Settings\UserController::update
* @see app/Http/Controllers/Settings/UserController.php:83
* @route '/settings/users/{user}'
*/
update85581a55f617828e21b8e5546a942932.url = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { user: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { user: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            user: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        user: typeof args.user === 'object'
        ? args.user.id
        : args.user,
    }

    return update85581a55f617828e21b8e5546a942932.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\UserController::update
* @see app/Http/Controllers/Settings/UserController.php:83
* @route '/settings/users/{user}'
*/
update85581a55f617828e21b8e5546a942932.put = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update85581a55f617828e21b8e5546a942932.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\Settings\UserController::update
* @see app/Http/Controllers/Settings/UserController.php:83
* @route '/settings/users/{user}'
*/
update85581a55f617828e21b8e5546a942932.patch = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update85581a55f617828e21b8e5546a942932.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\Settings\UserController::update
* @see app/Http/Controllers/Settings/UserController.php:83
* @route '/settings/users/{user}/roles-permissions'
*/
const update9917474c676aaee363a194e929ad798b = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update9917474c676aaee363a194e929ad798b.url(args, options),
    method: 'put',
})

update9917474c676aaee363a194e929ad798b.definition = {
    methods: ["put"],
    url: '/settings/users/{user}/roles-permissions',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Settings\UserController::update
* @see app/Http/Controllers/Settings/UserController.php:83
* @route '/settings/users/{user}/roles-permissions'
*/
update9917474c676aaee363a194e929ad798b.url = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { user: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { user: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            user: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        user: typeof args.user === 'object'
        ? args.user.id
        : args.user,
    }

    return update9917474c676aaee363a194e929ad798b.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\UserController::update
* @see app/Http/Controllers/Settings/UserController.php:83
* @route '/settings/users/{user}/roles-permissions'
*/
update9917474c676aaee363a194e929ad798b.put = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update9917474c676aaee363a194e929ad798b.url(args, options),
    method: 'put',
})

export const update = {
    '/settings/users/{user}': update85581a55f617828e21b8e5546a942932,
    '/settings/users/{user}/roles-permissions': update9917474c676aaee363a194e929ad798b,
}

/**
* @see \App\Http\Controllers\Settings\UserController::destroy
* @see app/Http/Controllers/Settings/UserController.php:93
* @route '/settings/users/{user}'
*/
export const destroy = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/settings/users/{user}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Settings\UserController::destroy
* @see app/Http/Controllers/Settings/UserController.php:93
* @route '/settings/users/{user}'
*/
destroy.url = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { user: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { user: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            user: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        user: typeof args.user === 'object'
        ? args.user.id
        : args.user,
    }

    return destroy.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\UserController::destroy
* @see app/Http/Controllers/Settings/UserController.php:93
* @route '/settings/users/{user}'
*/
destroy.delete = (args: { user: number | { id: number } } | [user: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const UserController = { index, create, store, show, edit, update, destroy }

export default UserController