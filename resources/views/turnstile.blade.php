@props([
    'statePath' => 'data.captcha',
    'siteKey' => config('filament-turnstile.site_key'),
])

@once
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit" async defer></script>
@endonce

<div
    wire:ignore
    x-data="{
        widgetId: null,
        renderTurnstile() {
            if (! window.turnstile) {
                window.setTimeout(() => this.renderTurnstile(), 100)

                return
            }

            this.widgetId = window.turnstile.render(this.$refs.widget, {
                sitekey: @js($siteKey),
                callback: (token) => $wire.set(@js($statePath), token),
                'expired-callback': () => $wire.set(@js($statePath), null),
                'error-callback': () => $wire.set(@js($statePath), null),
            })
        },
        resetTurnstile() {
            if (this.widgetId !== null && window.turnstile) {
                window.turnstile.reset(this.widgetId)
                $wire.set(@js($statePath), null)
            }
        },
    }"
    x-init="renderTurnstile()"
    x-on:turnstile-reset.window="resetTurnstile()"
>
    <div x-ref="widget"></div>
</div>
