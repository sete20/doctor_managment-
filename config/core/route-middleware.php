<?php

return [
    'client-dashboard' => [
        'web',
        'localizationRedirect' ,
        'localeSessionRedirect',
        'localeViewPath' ,
        'localize',
        'auth:client',
        'last.login',
        'client.valid.status'
    ],
    'admin-dashboard' => [
        'web' ,
        'localizationRedirect' ,
        'localeSessionRedirect',
        'localeViewPath' ,
        'localize',
//        'dashboard.auth',
    ],
    'doctor-auth' => [
        'web' ,
        'localizationRedirect' ,
        'localeSessionRedirect',
        'localeViewPath' ,
        'localize',
        'auth:doctor',
//        'dashboard.auth',
    ],
    'doctor-guest' => [
        'web' ,
        'localizationRedirect' ,
        'localeSessionRedirect',
        'localeViewPath' ,
        'localize',
        'guest:doctor',
//        'dashboard.auth',
    ],
];