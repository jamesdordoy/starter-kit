[![linter](https://github.com/jamesdordoy/starter-kit/actions/workflows/lint.yml/badge.svg)](https://github.com/jamesdordoy/starter-kit/actions/workflows/lint.yml)
[![tests](https://github.com/jamesdordoy/starter-kit/actions/workflows/tests.yml/badge.svg)](https://github.com/jamesdordoy/starter-kit/actions/workflows/tests.yml)

# My Starter Kit

My personal implementation of a starter kit using best in class packages.

## Whats included?
This has been built on top of the laravel [vue-starter-kit](https://github.com/laravel/vue-starter-kit) with addtional vue components included such as file pond, a date picker etc. Addtional sections of the authenticated dashboard have been expanded upon such as the new setting section that allows you to manage your users, their activity and site wide global assets with filters. Laravel data has also been used so that typescript interfaces can be generated for the frontend.

## Built around
* [PHP](https://www.php.net/releases/8.2/en.php) 8.2+
* [Vue.js](https://vuejs.org/) 3.x
* [TypeScript](https://www.typescriptlang.org/) 5.x
* [Laravel](http://laravel.com/docs/) 12.x
* [Inertiajs](https://inertiajs.com/) 2.x
* [Tailwind](https://tailwindcss.com/) 4.x
* [Redis](https://redis.io/)
* [Vite](https://vitejs.dev/)

## Packages
* [Spatie Permissions](https://spatie.be/docs/laravel-permission/)
* [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary/)
* [Spatie Laravel Data](https://spatie.be/docs/laravel-data/)
* [Spatie Typescript Transformer](https://spatie.be/docs/typescript-transformer/)
* [Spatie Laravel Query Builder](https://spatie.be/docs/laravel-query-builder/)
* [Spatie Laravel Activity Log](https://spatie.be/docs/laravel-activitylog/)

## Frontend vue packages
* [Vue Multiselect](https://vue-multiselect.js.org/)

## Testing
Tests have been included for the backend controllers

### Playwright
Use `npm run test-ui` to run the playwright tests and `npm run test-generate` to gernerate them.

## Alpha
Finished by the end of the month.
