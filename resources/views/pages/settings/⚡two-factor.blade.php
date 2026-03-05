<?php

use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

new #[Title('Two-factor authentication')] class extends Component {
    public bool $twoFactorEnabled;

    public bool $requiresConfirmation;

    /**
     * Mount the component.
     */
    public function mount(DisableTwoFactorAuthentication $disableTwoFactorAuthentication): void
    {
        abort_unless(Features::enabled(Features::twoFactorAuthentication()), Response::HTTP_FORBIDDEN);

        if (Fortify::confirmsTwoFactorAuthentication() && is_null(auth()->user()->two_factor_confirmed_at)) {
            $disableTwoFactorAuthentication(auth()->user());
        }

        $this->twoFactorEnabled = auth()->user()->hasEnabledTwoFactorAuthentication();
        $this->requiresConfirmation = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirm');
    }

    /**
     * Handle the two-factor authentication enabled event.
     */
    #[On('two-factor-enabled')]
    public function onTwoFactorEnabled(): void
    {
        $this->twoFactorEnabled = true;
    }

    /**
     * Disable two-factor authentication for the user.
     */
    public function disable(DisableTwoFactorAuthentication $disableTwoFactorAuthentication): void
    {
        $disableTwoFactorAuthentication(auth()->user());

        $this->twoFactorEnabled = false;
    }
} ?>

<section class="w-full">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Two-factor authentication settings') }}</flux:heading>

    <x-pages::settings.layout
        :heading="__('Two-factor authentication')"
        :subheading="__('Manage your two-factor authentication settings')"
    >
        <div class="bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 rounded-2xl p-6 shadow-sm">
            <div class="flex flex-col w-full mx-auto space-y-6 text-sm" wire:cloak>
                @if ($twoFactorEnabled)
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-500/10 dark:text-emerald-400">
                                <flux:icon.check-circle class="w-4 h-4 mr-1.5" /> {{ __('Enabled') }}
                            </span>
                        </div>

                        <flux:text>
                            {{ __('With two-factor authentication enabled, you will be prompted for a secure, random pin during login, which you can retrieve from the TOTP-supported application on your phone.') }}
                        </flux:text>

                        <div class="pt-4 border-t border-slate-200 dark:border-slate-700/50">
                            <livewire:pages::settings.two-factor.recovery-codes :$requiresConfirmation />
                        </div>

                        <div class="flex justify-start pt-4 border-t border-slate-200 dark:border-slate-700/50 mt-4">
                            <flux:button
                                variant="danger"
                                icon="shield-exclamation"
                                icon:variant="outline"
                                wire:click="disable"
                            >
                                {{ __('Disable 2FA') }}
                            </flux:button>
                        </div>
                    </div>
                @else
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-800 dark:bg-rose-500/10 dark:text-rose-400">
                                <flux:icon.x-circle class="w-4 h-4 mr-1.5" /> {{ __('Disabled') }}
                            </span>
                        </div>

                        <flux:text variant="subtle">
                            {{ __('When you enable two-factor authentication, you will be prompted for a secure pin during login. This pin can be retrieved from a TOTP-supported application on your phone.') }}
                        </flux:text>

                        <div class="pt-4 border-t border-slate-200 dark:border-slate-700/50 mt-4">
                            <flux:modal.trigger name="two-factor-setup-modal">
                                <flux:button
                                    variant="primary"
                                    icon="shield-check"
                                    icon:variant="outline"
                                    wire:click="$dispatch('start-two-factor-setup')"
                                >
                                    {{ __('Enable 2FA') }}
                                </flux:button>
                            </flux:modal.trigger>
                        </div>

                        <livewire:pages::settings.two-factor-setup-modal :requires-confirmation="$requiresConfirmation" />
                    </div>
                @endif
            </div>
        </div>
    </x-pages::settings.layout>
</section>
