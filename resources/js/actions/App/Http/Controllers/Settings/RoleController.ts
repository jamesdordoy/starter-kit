import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Settings\RoleController::index
* @see app/Http/Controllers/Settings/RoleController.php:24
* @route '/settings/roles'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/settings/roles',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\RoleController::index
* @see app/Http/Controllers/Settings/RoleController.php:24
* @route '/settings/roles'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\RoleController::index
* @see app/Http/Controllers/Settings/RoleController.php:24
* @route '/settings/roles'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\RoleController::index
* @see app/Http/Controllers/Settings/RoleController.php:24
* @route '/settings/roles'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\RoleController::create
* @see app/Http/Controllers/Settings/RoleController.php:36
* @route '/settings/roles/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/settings/roles/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\RoleController::create
* @see app/Http/Controllers/Settings/RoleController.php:36
* @route '/settings/roles/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\RoleController::create
* @see app/Http/Controllers/Settings/RoleController.php:36
* @route '/settings/roles/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\RoleController::create
* @see app/Http/Controllers/Settings/RoleController.php:36
* @route '/settings/roles/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\RoleController::store
* @see app/Http/Controllers/Settings/RoleController.php:44
* @route '/settings/roles'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/settings/roles',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Settings\RoleController::store
* @see app/Http/Controllers/Settings/RoleController.php:44
* @route '/settings/roles'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\RoleController::store
* @see app/Http/Controllers/Settings/RoleController.php:44
* @route '/settings/roles'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Settings\RoleController::show
* @see app/Http/Controllers/Settings/RoleController.php:54
* @route '/settings/roles/{role}'
*/
export const show = (args: { role: number | { id: number } } | [role: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/settings/roles/{role}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\RoleController::show
* @see app/Http/Controllers/Settings/RoleController.php:54
* @route '/settings/roles/{role}'
*/
show.url = (args: { role: number | { id: number } } | [role: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { role: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { role: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            role: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        role: typeof args.role === 'object'
        ? args.role.id
        : args.role,
    }

    return show.definition.url
            .replace('{role}', parsedArgs.role.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\RoleController::show
* @see app/Http/Controllers/Settings/RoleController.php:54
* @route '/settings/roles/{role}'
*/
show.get = (args: { role: number | { id: number } } | [role: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\RoleController::show
* @see app/Http/Controllers/Settings/RoleController.php:54
* @route '/settings/roles/{role}'
*/
show.head = (args: { role: number | { id: number } } | [role: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\RoleController::edit
* @see app/Http/Controllers/Settings/RoleController.php:67
* @route '/settings/roles/{role}/edit'
*/
export const edit = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/settings/roles/{role}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\RoleController::edit
* @see app/Http/Controllers/Settings/RoleController.php:67
* @route '/settings/roles/{role}/edit'
*/
edit.url = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { role: args }
    }

    if (Array.isArray(args)) {
        args = {
            role: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        role: args.role,
    }

    return edit.definition.url
            .replace('{role}', parsedArgs.role.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\RoleController::edit
* @see app/Http/Controllers/Settings/RoleController.php:67
* @route '/settings/roles/{role}/edit'
*/
edit.get = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\RoleController::edit
* @see app/Http/Controllers/Settings/RoleController.php:67
* @route '/settings/roles/{role}/edit'
*/
edit.head = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\RoleController::update
* @see app/Http/Controllers/Settings/RoleController.php:77
* @route '/settings/roles/{role}'
*/
const update85581a55f617828e21b8e5546a942933 = (args: { role: number | { id: number } } | [role: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update85581a55f617828e21b8e5546a942933.url(args, options),
    method: 'put',
})

update85581a55f617828e21b8e5546a942933.definition = {
    methods: ["put","patch"],
    url: '/settings/roles/{role}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Settings\RoleController::update
* @see app/Http/Controllers/Settings/RoleController.php:77
* @route '/settings/roles/{role}'
*/
update85581a55f617828e21b8e5546a942933.url = (args: { role: number | { id: number } } | [role: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { role: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { role: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            role: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        role: typeof args.role === 'object'
        ? args.role.id
        : args.role,
    }

    return update85581a55f617828e21b8e5546a942933.definition.url
            .replace('{role}', parsedArgs.role.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\RoleController::update
* @see app/Http/Controllers/Settings/RoleController.php:77
* @route '/settings/roles/{role}'
*/
update85581a55f617828e21b8e5546a942933.put = (args: { role: number | { id: number } } | [role: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update85581a55f617828e21b8e5546a942933.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\Settings\RoleController::update
* @see app/Http/Controllers/Settings/RoleController.php:77
* @route '/settings/roles/{role}'
*/
update85581a55f617828e21b8e5546a942933.patch = (args: { role: number | { id: number } } | [role: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update85581a55f617828e21b8e5546a942933.url(args, options),
    method: 'patch',
})

export const update = {
    '/settings/roles/{role}': update85581a55f617828e21b8e5546a942933,
}

/**
* @see \App\Http\Controllers\Settings\RoleController::destroy
* @see app/Http/Controllers/Settings/RoleController.php:86
* @route '/settings/roles/{role}'
*/
export const destroy = (args: { role: number | { id: number } } | [role: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/settings/roles/{role}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Settings\RoleController::destroy
* @see app/Http/Controllers/Settings/RoleController.php:86
* @route '/settings/roles/{role}'
*/
destroy.url = (args: { role: number | { id: number } } | [role: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { role: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { role: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            role: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        role: typeof args.role === 'object'
        ? args.role.id
        : args.role,
    }

    return destroy.definition.url
            .replace('{role}', parsedArgs.role.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\RoleController::destroy
* @see app/Http/Controllers/Settings/RoleController.php:86
* @route '/settings/roles/{role}'
*/
destroy.delete = (args: { role: number | { id: number } } | [role: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const RoleController = { index, create, store, show, edit, update, destroy }

export default RoleController
