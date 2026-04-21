<?php

namespace Adipradana\FilamentTurnstile;

use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class Turnstile
{
    public const LEGACY_TOKEN_FIELD = 'turnstile_token';

    public static function field(): string
    {
        return config('filament-turnstile.field', 'captcha');
    }

    public static function make(?string $name = null, ?string $statePath = null): Component
    {
        $name ??= self::field();

        return Group::make(self::components($name, $statePath))
            ->columnSpanFull();
    }

    /**
     * @return array<Component>
     */
    public static function components(?string $name = null, ?string $statePath = null): array
    {
        $name ??= self::field();
        $statePath ??= "data.{$name}";

        return [
            Hidden::make($name)
                ->required(),

            View::make('filament-turnstile::turnstile')
                ->viewData([
                    'statePath' => $statePath,
                    'siteKey' => config('filament-turnstile.site_key'),
                ]),
        ];
    }

    /**
     * @param  array<string, mixed> | string | null  $data
     * @return ($data is array ? array<string, mixed> : void)
     */
    public static function validate(array|string|null $data, ?string $field = null, ?string $errorKey = null): mixed
    {
        $field ??= self::field();

        if (is_array($data)) {
            self::validateToken(self::getTokenFromData($data, $field), $errorKey ?? "data.{$field}");

            unset($data[$field], $data[self::LEGACY_TOKEN_FIELD]);

            return $data;
        }

        self::validateToken($data, $errorKey ?? "data.{$field}");

        return null;
    }

    protected static function validateToken(?string $token, string $errorKey): void
    {
        $secretKey = config('filament-turnstile.secret_key');

        if (blank($token) || blank($secretKey)) {
            self::throwValidationException($errorKey);
        }

        $response = Http::asForm()
            ->timeout(config('filament-turnstile.timeout', 5))
            ->post(config('filament-turnstile.endpoint'), [
                'secret' => $secretKey,
                'response' => $token,
                'remoteip' => request()->ip(),
            ]);

        if (! $response->ok() || $response->json('success') !== true) {
            self::throwValidationException($errorKey);
        }
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected static function getTokenFromData(array $data, string $field): ?string
    {
        return $data[$field] ?? $data[self::LEGACY_TOKEN_FIELD] ?? null;
    }

    protected static function throwValidationException(string $errorKey): never
    {
        throw ValidationException::withMessages([
            $errorKey => config('filament-turnstile.error_message'),
        ]);
    }
}
