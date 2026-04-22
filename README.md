# Adipradana Filament Turnstile

Cloudflare Turnstile integration for Laravel Filament login and forms.

Reference:
https://developers.cloudflare.com/turnstile/troubleshooting/testing/

## Requirements

- PHP `^8.1 || ^8.2 || ^8.3`
- Laravel `^13.0`
- Filament `3.0 || ^4.0 || ^5.0`
- illuminate/support `^10.0 || ^11.0 || ^12.0 || ^13.0`

## Install the package via Composer:
```
composer require adipradana/filament-turnstile
```


## Environment

```env
# .env.development
TURNSTILE_SITEKEY=1x00000000000000000000AA
TURNSTILE_SECRET_KEY=1x0000000000000000000000000000000AA

# .env.test
TURNSTILE_SITEKEY=2x00000000000000000000AB
TURNSTILE_SECRET_KEY=2x0000000000000000000000000000000AA

# .env.production
TURNSTILE_SITEKEY=your-real-sitekey
TURNSTILE_SECRET_KEY=your-real-secret-key
```

`TURNSTILE_SITE_KEY` is also supported as an alias for `TURNSTILE_SITEKEY`.

## Filament Login

```php
use Adipradana\FilamentTurnstile\Pages\Auth\TurnstileLogin;

->login(TurnstileLogin::class)
```


Path : app/Providers/Filament/AdminPanelProvider.php

```php
public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->profile()
        ->login(TurnstileLogin::class); <-- (paste here)
}
```



## Filament Forms

```php
use Adipradana\FilamentTurnstile\Turnstile;

Turnstile::make('captcha'),
```

```php
use Adipradana\FilamentTurnstile\Turnstile;use Filament\Forms\Components\TextInput;

TextInput::make('number')
    ->numeric()
    ->step(100)
Turnstile::make('captcha') <---- (paste here)
```



## this for validate Create or Before Save

## Validate Before Create

```php
use Adipradana\FilamentTurnstile\Turnstile;

protected function mutateFormDataBeforeCreate(array $data): array
{
    return Turnstile::validate($data);
}
```

## Validate Before Save

```php
use Adipradana\FilamentTurnstile\Turnstile;

protected function mutateFormDataBeforeSave(array $data): array
{
    return Turnstile::validate($data);
}
```
