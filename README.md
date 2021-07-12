<p align="center"><a href="https://web.facebook.com/devgeek.dev" target="_blank"><img src="https://raw.githubusercontent.com/Kimsoeurn/laravel-adminlte/master/public/img/logo_no_bg.png" width="200"></a></p>

## Laravel AdminLTE Starter Kit

Laravel AdminLTE is a starter kit for web application with users roles and permissions
- Laravel AdminLTE come with two Languages default language is khmer (Khmer, English) language base on current user login.

!["Laravel AdminLTE"](https://raw.githubusercontent.com/Kimsoeurn/laravel-adminlte/master/public/img/screenshot.png "Laravel AdminLTE Presentation")

## Requirements

This packages use (no need to install):
* [Composer](https://getcomposer.org/)
* [Laravel 8](http://laravel.com/)
* [Livewire](https://laravel-livewire.com/)
* [Spatie Laravel Permission](https://github.com/spatie/laravel-permission)
* [Laravolt Avatar](https://github.com/laravolt/avatar)
* [AdminLTE 3](https://github.com/ColorlibHQ/AdminLTE)

The current package requirements are:
- NodeJs >= 14.x
- Laravel >= 8.x
- PHP >= 7.4

## Installation
- Clone repository

``
git clone git@github.com:Kimsoeurn/laravel-adminlte.git
``
- Composer 

``
  composer install
``

- Node Package

``
    npm install && npm run dev
``

- Config Database and migrate. (Copy ``env.example and rename .env and config your database connection``)

``
    php artisan migrate --seed
``
- Run your local web server

``
    php artisan serve
``
## License

The MIT License (MIT). Please see check for more information. [MIT license](https://opensource.org/licenses/MIT).
