## About Bullentine Board Project

Bullentine Board  is a simple CRUD Laravel and Laravel+Vue.User can CRUD posts and admin user can CRUD both users and posts.Guest user can see only post.You can clone project  <a href="https://github.com/aungthuramoe/laravelTest.git" target="_blank">here</a>

## Installtion
- git clone https://github.com/aungthuramoe/laravelTest.git
- composer install
- npm install
- rename .env.example file to env and update your env file to connect database 
```shill
php artisan migrate
php artisan db:seed --class=AdminSeeder
php artisan serve or php -S localhost:8000 -t public/ (you can change port)
```
- goto your running project url and login with username=>Admin and password is 123456 
- If you want to generate posts,type folowing command or create post from UI
```shill
php artisan db:seed --class=PostsSeeder
```
## Content
- Users
- Posts

## Note 

> If you want to run Laravel Project, change config/auth.php 
```shell
'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],
```
- Read <a href=" https://jwt-auth.readthedocs.io/en/develop/laravel-installation/">here</a> to add jwt-auth token
- Read Documentation <a href="https://jwt-auth.readthedocs.io/en/develop/quick-start/" target="_blank">here</a> to generate jwt token
> If you want to run Vue Project, change config/auth.php
```shell
'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
        'hash' => false,
    ],
],
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
