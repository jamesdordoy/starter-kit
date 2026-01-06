import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Settings\ProfileAvatarController::update
* @see app/Http/Controllers/Settings/ProfileAvatarController.php:11
* @route '/settings/profile/avatar'
*/
export const update = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: update.url(options),
    method: 'post',
})

update.definition = {
    methods: ["post"],
    url: '/settings/profile/avatar',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Settings\ProfileAvatarController::update
* @see app/Http/Controllers/Settings/ProfileAvatarController.php:11
* @route '/settings/profile/avatar'
*/
update.url = (options?: RouteQueryOptions) => {
    return update.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\ProfileAvatarController::update
* @see app/Http/Controllers/Settings/ProfileAvatarController.php:11
* @route '/settings/profile/avatar'
*/
update.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: update.url(options),
    method: 'post',
})

const ProfileAvatarController = { update }

export default ProfileAvatarController