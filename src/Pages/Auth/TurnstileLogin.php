<?php

namespace Adipradana\FilamentTurnstile\Pages\Auth;

use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Pages\Login;
use Filament\Schemas\Schema;
use Kementerian\FilamentTurnstile\Turnstile;

class TurnstileLogin extends Login
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
                Turnstile::make(),
            ]);
    }

    public function authenticate(): ?LoginResponse
    {
        Turnstile::validate(data_get($this->data, Turnstile::field()));

        return parent::authenticate();
    }
}
