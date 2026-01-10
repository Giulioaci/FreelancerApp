<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | Il mailer di default sarà Yahoo. Puoi comunque inviare mail con mailer
    | specifici nel codice usando Mail::mailer('nome_mailer').
    |
    */

    'default' => env('MAIL_MAILER', 'yahoo'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Configurazione dei mailer: Yahoo, Gmail, Outlook, SMTP generico, log, array.
    |
    */

    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL'), PHP_URL_HOST)),
        ],

        'gmail' => [
            'transport' => 'smtp',
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => env('GMAIL_USERNAME'),
            'password' => env('GMAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL'), PHP_URL_HOST)),
        ],

        'yahoo' => [
            'transport' => 'smtp',
            'host' => 'smtp.mail.yahoo.com',
            'port' => 465,
            'encryption' => 'ssl',
            'username' => env('YAHOO_USERNAME'),
            'password' => env('YAHOO_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL'), PHP_URL_HOST)),
        ],

        'outlook' => [
            'transport' => 'smtp',
            'host' => 'smtp.office365.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => env('OUTLOOK_USERNAME'),
            'password' => env('OUTLOOK_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL'), PHP_URL_HOST)),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'yahoo',
                'smtp',
                'log',
            ],
            'retry_after' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | Indirizzo e nome globale da usare come mittente. Per Yahoo possiamo
    | mettere direttamente l'account Yahoo.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'giulioacitorio@yahoo.it'),
        'name' => env('Giulio Acitorio'),
    ],

];

