## About Bullentine Board Project

Bullentine Board  is a simple CRUD Laravel and Laravel+Vue.User can CRUD posts and admin user can CRUD both users and posts.Guest user can see only post.You can clone project  <a href="https://github.com/aungthuramoe/laravelTest.git" target="_blank">here</a>

## Installtion
- git clone https://github.com/aungthuramoe/laravelTest.git
- composer install
- npm install
- rename .env.example file to env and update your env file for database

## Content
- Users
- Posts

## Note 

> If you want to run laravel project,change config/auth.php 
```shell
'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],
```
> If you want to run Vue project, change config/auth.php
```shell
'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
