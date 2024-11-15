<?php

use Laravel\Fortify\Features;

return [



    'guard' => 'web',

    'passwords' => 'users',

    'username' => 'username',

    'email' => 'email',

    'lowercase_usernames' => true,

    'home' => '/',

    'prefix' => '',

    'domain' => null,

    'middleware' => ['web'],


    'limiters' => [
        'login' => 'login',
        'two-factor' => 'two-factor',
    ],

    'views' => true,

    'features' => [
        Features::registration(),
        Features::emailVerification(),
        Features::updatePasswords(),
    ],
    'redirects' => [
        'register' => '/login',
        'login' => '/',
        'logout' => '/login',
    ],
];
