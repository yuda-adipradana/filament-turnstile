# Adipradana Filament Turnstile

Cloudflare Turnstile integration for Laravel Filament login and forms.

Reference:
https://developers.cloudflare.com/turnstile/troubleshooting/testing/

## Requirements

- PHP `^8.3`
- Laravel `^13.0`
- Filament `^5.0`

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

## Filament Forms

```php
use Adipradana\FilamentTurnstile\Turnstile;

Turnstile::make('captcha'),
```

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
