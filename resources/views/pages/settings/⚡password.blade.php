<?php

use App\Concerns\PasswordValidationRules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Password settings')] class extends Component {
    use PasswordValidationRules;

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => $this->currentPasswordRules(),
                'password' => $this->passwordRules(),
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => $validated['password'],
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Password settings') }}</flux:heading>

    <x-pages::settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
        <div class="bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 rounded-2xl p-6 shadow-sm">
            <form method="POST" wire:submit="updatePassword" class="space-y-6">
                <flux:input
                    wire:model="current_password"
                    :label="__('Current password')"
                    type="password"
                    required
                    autocomplete="current-password"
                />
                
                <flux:separator variant="subtle" />

                <flux:input
                    wire:model="password"
                    :label="__('New password')"
                    type="password"
                    required
                    autocomplete="new-password"
                />
                <flux:input
                    wire:model="password_confirmation"
                    :label="__('Confirm password')"
                    type="password"
                    required
                    autocomplete="new-password"
                />

                <div class="flex items-center gap-4 pt-4 border-t border-slate-200 dark:border-slate-700/50">
                    <div class="flex items-center justify-end w-full sm:w-auto">
                        <flux:button variant="primary" type="submit" class="w-full sm:w-auto px-6" data-test="update-password-button">
                            {{ __('Save Password') }}
                        </flux:button>
                    </div>

                    <x-action-message class="me-3" on="password-updated">
                        {{ __('Saved successfully.') }}
                    </x-action-message>
                </div>
            </form>
        </div>
    </x-pages::settings.layout>
</section>
