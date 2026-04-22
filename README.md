# 🚀 Filament Turnstile

Cloudflare Turnstile integration for Laravel Filament (Login & Forms).

Lightweight, clean, and production-ready captcha alternative with better UX.

---

## ✨ Features

* 🔐 Cloudflare Turnstile integration (no annoying captcha)
* ⚡ Support Filament v3, v4, v5
* 🧩 Works on Login & Custom Forms
* 🧼 Clean validation pipeline
* 🚀 Easy setup (1–2 lines)

---

## 📦 Requirements

* PHP `^8.1 || ^8.2 || ^8.3`
* Laravel `^10 || ^11 || ^12 || ^13`
* Filament `^3 || ^4 || ^5`

---

# 🛠 Installation

```bash
composer require adipradana/filament-turnstile
```

---

# ⚙️ Configuration

## 1. Environment Setup

Setup `.env`:

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

Alternative:

```env
TURNSTILE_SITEKEY=your_site_key
```

---

## 2. Publish Config (Optional)

```bash
php artisan vendor:publish --tag=filament-turnstile-config
```

File:

```
config/filament-turnstile.php
```

---

# 🔐 Usage

## 🔹 Filament Login

Override login Filament:

```php
use Adipradana\FilamentTurnstile\Pages\Auth\TurnstileLogin;

->login(TurnstileLogin::class)
```

📍 Example:
// app/Providers/Filament/AdminPanelProvider.php
```php
use Adipradana\FilamentTurnstile\Pages\Auth\TurnstileLogin;

public function panel(Panel $panel): Panel
{
    return $panel
        //...
        
        ->login(TurnstileLogin::class);
}
```

---

## 🔹 Filament Forms

```php
use Adipradana\FilamentTurnstile\Turnstile;

Turnstile::make('captcha')
```

📍 Example:

```php
use Filament\Forms\Components\TextInput;
use Adipradana\FilamentTurnstile\Turnstile;

TextInput::make('name'),

Turnstile::make('captcha'),
```

---

## 🔹 Validation (Advanced)

### Before Create

```php
protected function mutateFormDataBeforeCreate(array $data): array
{
    return \Adipradana\FilamentTurnstile\Turnstile::validate($data);
}
```

### Before Save

```php
protected function mutateFormDataBeforeSave(array $data): array
{
    return \Adipradana\FilamentTurnstile\Turnstile::validate($data);
}
```

---

# 🎨 Publish Assets

## Publish All

```bash
php artisan vendor:publish --provider="Adipradana\FilamentTurnstile\FilamentTurnstileServiceProvider"
```

---

## Publish Views (Optional)

```bash
php artisan vendor:publish --tag=filament-turnstile-views
```

Output:

```
resources/views/vendor/filament-turnstile/turnstile.blade.php
```

---

# 🧪 Testing

Cloudflare Reference:

https://developers.cloudflare.com/turnstile/troubleshooting/testing/

---

# 🧹 Clear Cache

```bash
php artisan optimize:clear
```

---

# ❌ Uninstall

## 1. Remove package

```bash
composer remove adipradana/filament-turnstile
```

---

## 2. Remove published files

```bash
rm config/filament-turnstile.php
rm -rf resources/views/vendor/filament-turnstile
```

---

## 3. Remove ENV

```env
TURNSTILE_SITE_KEY=
TURNSTILE_SECRET_KEY=
```

---

# ⚠️ Common Issues

### ❌ Turnstile tidak muncul

* Check `TURNSTILE_SITE_KEY`
* run `optimize:clear`

---

### ❌ Validasi selalu gagal

* Check `TURNSTILE_SECRET_KEY`
* Make request Cloudflare valid

---

### ❌ View not found

* Make sure package is updated
* run:

```bash
composer update adipradana/filament-turnstile
php artisan optimize:clear
```

---

# 📄 License

MIT License
