import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Settings\LogoController::update
* @see app/Http/Controllers/Settings/LogoController.php:15
* @route '/settings/logo'
*/
export const update = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: update.url(options),
    method: 'post',
})

update.definition = {
    methods: ["post"],
    url: '/settings/logo',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Settings\LogoController::update
* @see app/Http/Controllers/Settings/LogoController.php:15
* @route '/settings/logo'
*/
update.url = (options?: RouteQueryOptions) => {
    return update.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\LogoController::update
* @see app/Http/Controllers/Settings/LogoController.php:15
* @route '/settings/logo'
*/
update.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: update.url(options),
    method: 'post',
})

const logo = {
    update: Object.assign(update, update),
}

export default logo