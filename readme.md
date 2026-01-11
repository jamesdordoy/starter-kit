[![linter](https://github.com/jamesdordoy/starter-kit/actions/workflows/lint.yml/badge.svg)](https://github.com/jamesdordoy/starter-kit/actions/workflows/lint.yml)
[![pint](https://github.com/jamesdordoy/starter-kit/actions/workflows/tests.yml/badge.svg)](https://github.com/jamesdordoy/starter-kit/actions/workflows/tests.yml)
[![codecov](https://codecov.io/gh/jamesdordoy/starter-kit/graph/badge.svg?token=66JIRMPM8T)](https://codecov.io/gh/jamesdordoy/starter-kit)

# My Starter Kit

My personal implementation of a starter kit using best in class packages.

## Whats included?
This has been built on top of the laravel [vue-starter-kit](https://github.com/laravel/vue-starter-kit) with addtional vue components included such as file pond, a date picker etc. Addtional sections of the authenticated dashboard have been expanded upon such as the new setting section that allows you to manage your users, their activity, Permissions and Roles and site wide global assets with filters. Laravel data has also been used so that typescript interfaces can be generated for the frontend.

## Built around
* [PHP](https://www.php.net/releases/8.2/en.php) 8.3+
* [Vue.js](https://vuejs.org/) 3.x
* [TypeScript](https://www.typescriptlang.org/) 5.x
* [Laravel](http://laravel.com/docs/) 12.x
* [Inertiajs](https://inertiajs.com/) 2.x
* [Tailwind](https://tailwindcss.com/) 4.x
* [Redis](https://redis.io/)
* [Vite](https://vitejs.dev/)

## Packages
* [Laravel Fortify](https://laravel.com/docs/master/fortify)
* [Laravel Precognition](https://laravel.com/docs/master/precognition)
* [Spatie Permissions](https://spatie.be/docs/laravel-permission/)
* [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary/)
* [Spatie Laravel Data](https://spatie.be/docs/laravel-data/)
* [Spatie Typescript Transformer](https://spatie.be/docs/typescript-transformer/)
* [Spatie Laravel Query Builder](https://spatie.be/docs/laravel-query-builder/)
* [Spatie Laravel Activity Log](https://spatie.be/docs/laravel-activitylog/)

## Frontend vue packages
* [Reka-UI](https://reka-ui.com/)
* [Vue Multiselect](https://vue-multiselect.js.org/)
* [Vue Filepond](https://github.com/pqina/vue-filepond)
* [Vue 3 Datatable](https://vue3-datatable-document.vercel.app/)
* [Font Awesome](https://docs.fontawesome.com/web/use-with/vue)

## SSL/HTTPS
You can turn off required SSL in the essentails config via the env: `ESSENTIALS_FORCE_HTTPS_SCHEME=`

## Backend

### Generating typescript models

```bash
php artisan typescript:transform
```

### Generating routes to store in the DB

```bash
php artisan sync:routes
```

### Generating permissions to store in the DB

```bash
php artisan generate:permissions --assign-routes
```

### Testing
Tests have been included for Controllers and Actions using Pest

```bash
php artisan test -p
```

## Frontend

### Generating Reka UI ui components:
```bash
npx shadcn-vue@latest add
```

### Playwright

### Fresh install
You may need to run the following commands after installing your npm deps to install the browsers playwright will use: npx playwright install 

Use `npm run test-ui` to run the playwright tests and `npm run test-generate` to generate them.


