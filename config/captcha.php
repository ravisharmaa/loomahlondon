<?php

/*return [
    'secret' => env('NOCAPTCHA_SECRET'),
    'sitekey' => env('NOCAPTCHA_SITEKEY'),
];*/


/* BotDetect PHP Captcha configuration options
as installed from https://captcha.com/doc/php/laravel-5.1-captcha-quickstart.html */
return [
    'ExampleCaptcha' => [
        'UserInputID' => 'CaptchaCode',
        'ImageWidth' => 150,
        'ImageHeight' => 50,
    ],

];