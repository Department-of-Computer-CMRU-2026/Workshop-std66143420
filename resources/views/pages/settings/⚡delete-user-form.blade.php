<?php

use Livewire\Component;

new class extends Component {}; ?>

<section class="mt-10">
    <div class="bg-rose-50/50 dark:bg-rose-950/20 border border-rose-200 dark:border-rose-900/50 rounded-2xl p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 p-4 opacity-5 pointer-events-none">
            <flux:icon.trash class="w-32 h-32 text-rose-500" />
        </div>
        
        <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <div>
                <flux:heading class="text-rose-600 dark:text-rose-400 font-bold mb-1">{{ __('Delete account') }}</flux:heading>
                <flux:subheading class="text-rose-600/80 dark:text-rose-400/80">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}</flux:subheading>
            </div>

            <flux:modal.trigger name="confirm-user-deletion">
                <flux:button variant="danger" data-test="delete-user-button" class="whitespace-nowrap shadow-sm shadow-rose-500/20">
                    {{ __('Delete account') }}
                </flux:button>
            </flux:modal.trigger>
        </div>

        <livewire:pages::settings.delete-user-modal />
    </div>
</section>
