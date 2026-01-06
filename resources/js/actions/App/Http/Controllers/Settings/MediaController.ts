import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Settings\MediaController::index
* @see app/Http/Controllers/Settings/MediaController.php:16
* @route '/settings/media-items'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/settings/media-items',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\MediaController::index
* @see app/Http/Controllers/Settings/MediaController.php:16
* @route '/settings/media-items'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\MediaController::index
* @see app/Http/Controllers/Settings/MediaController.php:16
* @route '/settings/media-items'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\MediaController::index
* @see app/Http/Controllers/Settings/MediaController.php:16
* @route '/settings/media-items'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\MediaController::create
* @see app/Http/Controllers/Settings/MediaController.php:0
* @route '/settings/media-items/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/settings/media-items/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\MediaController::create
* @see app/Http/Controllers/Settings/MediaController.php:0
* @route '/settings/media-items/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\MediaController::create
* @see app/Http/Controllers/Settings/MediaController.php:0
* @route '/settings/media-items/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\MediaController::create
* @see app/Http/Controllers/Settings/MediaController.php:0
* @route '/settings/media-items/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\MediaController::store
* @see app/Http/Controllers/Settings/MediaController.php:33
* @route '/settings/media-items'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/settings/media-items',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Settings\MediaController::store
* @see app/Http/Controllers/Settings/MediaController.php:33
* @route '/settings/media-items'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\MediaController::store
* @see app/Http/Controllers/Settings/MediaController.php:33
* @route '/settings/media-items'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Settings\MediaController::show
* @see app/Http/Controllers/Settings/MediaController.php:52
* @route '/settings/media-items/{media_item}'
*/
export const show = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/settings/media-items/{media_item}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\MediaController::show
* @see app/Http/Controllers/Settings/MediaController.php:52
* @route '/settings/media-items/{media_item}'
*/
show.url = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { media_item: args }
    }

    if (Array.isArray(args)) {
        args = {
            media_item: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        media_item: args.media_item,
    }

    return show.definition.url
            .replace('{media_item}', parsedArgs.media_item.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\MediaController::show
* @see app/Http/Controllers/Settings/MediaController.php:52
* @route '/settings/media-items/{media_item}'
*/
show.get = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\MediaController::show
* @see app/Http/Controllers/Settings/MediaController.php:52
* @route '/settings/media-items/{media_item}'
*/
show.head = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\MediaController::edit
* @see app/Http/Controllers/Settings/MediaController.php:0
* @route '/settings/media-items/{media_item}/edit'
*/
export const edit = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/settings/media-items/{media_item}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\MediaController::edit
* @see app/Http/Controllers/Settings/MediaController.php:0
* @route '/settings/media-items/{media_item}/edit'
*/
edit.url = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { media_item: args }
    }

    if (Array.isArray(args)) {
        args = {
            media_item: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        media_item: args.media_item,
    }

    return edit.definition.url
            .replace('{media_item}', parsedArgs.media_item.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\MediaController::edit
* @see app/Http/Controllers/Settings/MediaController.php:0
* @route '/settings/media-items/{media_item}/edit'
*/
edit.get = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\MediaController::edit
* @see app/Http/Controllers/Settings/MediaController.php:0
* @route '/settings/media-items/{media_item}/edit'
*/
edit.head = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\MediaController::update
* @see app/Http/Controllers/Settings/MediaController.php:57
* @route '/settings/media-items/{media_item}'
*/
export const update = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/settings/media-items/{media_item}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Settings\MediaController::update
* @see app/Http/Controllers/Settings/MediaController.php:57
* @route '/settings/media-items/{media_item}'
*/
update.url = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { media_item: args }
    }

    if (Array.isArray(args)) {
        args = {
            media_item: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        media_item: args.media_item,
    }

    return update.definition.url
            .replace('{media_item}', parsedArgs.media_item.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\MediaController::update
* @see app/Http/Controllers/Settings/MediaController.php:57
* @route '/settings/media-items/{media_item}'
*/
update.put = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\Settings\MediaController::update
* @see app/Http/Controllers/Settings/MediaController.php:57
* @route '/settings/media-items/{media_item}'
*/
update.patch = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\Settings\MediaController::destroy
* @see app/Http/Controllers/Settings/MediaController.php:62
* @route '/settings/media-items/{media_item}'
*/
export const destroy = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/settings/media-items/{media_item}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Settings\MediaController::destroy
* @see app/Http/Controllers/Settings/MediaController.php:62
* @route '/settings/media-items/{media_item}'
*/
destroy.url = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { media_item: args }
    }

    if (Array.isArray(args)) {
        args = {
            media_item: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        media_item: args.media_item,
    }

    return destroy.definition.url
            .replace('{media_item}', parsedArgs.media_item.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\MediaController::destroy
* @see app/Http/Controllers/Settings/MediaController.php:62
* @route '/settings/media-items/{media_item}'
*/
destroy.delete = (args: { media_item: string | number } | [media_item: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const MediaController = { index, create, store, show, edit, update, destroy }

export default MediaController