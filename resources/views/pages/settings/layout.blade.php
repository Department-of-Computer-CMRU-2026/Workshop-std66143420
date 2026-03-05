<div class="flex items-start max-md:flex-col gap-6 md:gap-8 max-w-6xl mx-auto">
    <div class="w-full md:w-[260px] shrink-0">
        <div class="bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 rounded-2xl p-3 shadow-sm">
            <h3 class="px-3 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2 mt-2">Personal Settings</h3>
            <flux:navlist aria-label="{{ __('Settings') }}" class="gap-1">
                <flux:navlist.item icon="user" :href="route('profile.edit')" wire:navigate class="rounded-xl">{{ __('Profile') }}</flux:navlist.item>
                <flux:navlist.item icon="key" :href="route('user-password.edit')" wire:navigate class="rounded-xl">{{ __('Password') }}</flux:navlist.item>
                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <flux:navlist.item icon="shield-check" :href="route('two-factor.show')" wire:navigate class="rounded-xl">{{ __('Two-factor auth') }}</flux:navlist.item>
                @endif
                <flux:navlist.item icon="paint-brush" :href="route('appearance.edit')" wire:navigate class="rounded-xl">{{ __('Appearance') }}</flux:navlist.item>
            </flux:navlist>
        </div>
    </div>

    <div class="flex-1 w-full relative">
        <!-- Decorative blob -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-500/10 blur-3xl rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-500/10 blur-3xl rounded-full pointer-events-none"></div>

        <div class="relative z-10 bg-white dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700/50 rounded-2xl p-6 md:p-8 shadow-sm">
            <div class="mb-8 pb-6 border-b border-slate-100 dark:border-slate-700/50">
                <flux:heading size="xl" class="text-slate-900 dark:text-white font-bold tracking-tight">{{ $heading ?? '' }}</flux:heading>
                <flux:subheading class="text-slate-500 dark:text-slate-400 mt-2 text-sm">{{ $subheading ?? '' }}</flux:subheading>
            </div>

            <div class="w-full max-w-2xl">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
