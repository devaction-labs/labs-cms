<div>
    <x-simple-modal wire:model="showRegister" box-class="backdrop-blur">
        <div class="modal-box max-w-xs md:max-w-sm">
            <div class="text-center">
                <h3 class="text-xl font-semibold">{{ __('Register') }}</h3>
            </div>

            <form wire:submit="submit">
                <div>
                    <div class="form-control mt-6">
                        <label class="label" for="register_username">
                            <span class="label-text font-medium">{{ __('Username') }}</span>
                        </label>
                        <input
                            wire:model="name"
                            autocomplete="name"
                            id="register_username"
                            class="input input-sm join-item input-bordered w-full"
                            placeholder="{{ __('Name') }}"
                            type="text"
                            required
                        />
                    </div>
                    <div class="form-control mt-2">
                        <label class="label" for="register_email">
                            <span class="label-text font-medium">{{ __('Email') }}</span>
                        </label>
                        <input
                            wire:model="email"
                            autocomplete="email"
                            id="register_email"
                            class="input input-sm join-item input-bordered w-full"
                            placeholder="name@daisyui.com"
                            type="email"
                            required
                        />
                    </div>
                    <div class="form-control mt-2">
                        <label class="label" for="confirm_email">
                            <span class="label-text font-medium">{{ __('Confirm email') }}</span>
                        </label>
                        <input
                            wire:model="email_confirmation"
                            autocomplete="Confirm email"
                            id="confirm_email"
                            class="input input-sm join-item input-bordered w-full"
                            placeholder="name@daisyui.com"
                            type="email"
                            required
                        />
                    </div>
                    <div class="form-control mt-2">
                        <label class="label" for="register_password">
                            <span class="label-text font-medium">{{ __('Password') }}</span>
                        </label>
                        <input
                            wire:model="password"
                            autocomplete="password"
                            id="register_password"
                            class="input input-sm join-item input-bordered w-full"
                            placeholder="It's secret"
                            type="password"
                            required
                        />
                        <div class="label">
                            <span class="label-text-alt text-xs text-base-content/70">
                                {{ __('Min 8 letters required') }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center justify-end gap-3">
                        <button class="btn btn-error btn-sm relative" type="button"
                                wire:click="closeRegister"
                        >
                            {{ __('Cancel') }}

                        </button>
                        <button class="btn btn-primary btn-sm relative" type="submit">
                            {{ __('Register') }}
                            <div
                                wire:loading
                                wire:target="submit"
                                class="absolute inset-0 flex items-center justify-center"
                            >
                                <x-loading class="loading-infinity" />
                            </div>
                        </button>
                    </div>
                    <div class="mt-6 flex items-center gap-3">
                        <hr class="grow border-base-content/5" />
                        <span class="text-base-content/70">{{ __('Continue with') }}</span>
                        <hr class="grow border-base-content/5" />
                    </div>

                    <div class="mt-6 flex gap-4">
                        <button class="btn btn-sm block grow">Google</button>
                        <button class="btn btn-neutral btn-sm block grow">Github</button>
                    </div>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>{{ __('close') }}</button>
        </form>
    </x-simple-modal>
</div>
