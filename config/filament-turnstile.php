<?php

return [
    'site_key' => env('TURNSTILE_SITE_KEY', env('TURNSTILE_SITEKEY')),

    'secret_key' => env('TURNSTILE_SECRET_KEY'),

    'endpoint' => env('TURNSTILE_ENDPOINT', 'https://challenges.cloudflare.com/turnstile/v0/siteverify'),

    'timeout' => (int) env('TURNSTILE_TIMEOUT', 5),

    'field' => env('TURNSTILE_FIELD', 'captcha'),

    'error_message' => env('TURNSTILE_ERROR_MESSAGE', 'Verifikasi keamanan gagal. Silakan coba lagi.'),
];