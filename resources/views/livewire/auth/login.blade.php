<div>
    <x-simple-modal wire:model="showLogin">
        <div class="modal-box md:max-w-sm max-w-xs">
            <x-icon name="o-x-circle" class="text-red-600 absolute right-0 mr-8 cursor-pointer"
                    @click="$wire.showLogin = false" />
            <div class="text-center">
                <h3 class="font-semibold text-xl">{{ __('Login') }}</h3>
            </div>

            @if (session('status'))
                <x-alert icon="o-exclamation-triangle" class="alert-warning">
                    {{ session('status') }}
                </x-alert>
            @endif

            @if ($errors->hasAny('invalidCredentials', 'rateLimitExceeded'))
                <x-alert class="alert-info">
                    <x-icon name="o-exclamation-triangle" class="text-warning" />
                    @error('invalidCredentials')
                    {{ $errors->first('invalidCredentials') }}
                    @enderror

                    @error('rateLimitExceeded')
                    {{ $errors->first('rateLimitExceeded') }}
                    @enderror
                </x-alert>
            @endif
            <div>
                <form wire:submit.prevent="tryToLogin" x-on:keydown.enter.prevent="$wire.tryToLogin()">
                    <div class="form-control mt-6">
                        <label class="label" for="login_email">
                            <span class="label-text font-medium">{{ __('Email') }}</span>
                        </label>
                        <input
                            autocomplete="email"
                            id="login_email"
                            class="input join-item input-bordered w-full input-sm"
                            placeholder="name@daisyui.com"
                            type="email"
                            wire:model="email"
                            required />
                    </div>
                    <div class="form-control mt-2">
                        <label class="label" for="login_password">
                            <span class="label-text font-medium">{{ __('Password') }}</span>
                        </label>
                        <input
                            autocomplete="password"
                            id="login_password"
                            class="input join-item input-bordered w-full input-sm"
                            placeholder="It's top secret"
                            type="password"
                            wire:model="password"
                            required />
                        <div class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt"><a href="#"
                                                            class="text-base-content/80">{{ __('Forgot password?') }}</a></span>
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-3 gap-3">
                        <button class="btn btn-sm">
                            Register
                        </button>
                        <button class="btn btn-primary btn-sm" type="submit" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="tryToLogin">
                                {{ __('Login') }}
                            </span>
                            <x-loading
                                wire:loading
                                wire:target="tryToLogin"
                                class="loading-infinity"
                                style="display: none"
                            />
                        </button>
                    </div>
                </form>
                <div class="flex items-center gap-3 mt-6">
                    <hr class="border-base-content/5 grow" />
                    <span class="text-base-content/70">{{ __('Continue with') }}</span>
                    <hr class="border-base-content/5 grow" />
                </div>

                <div class="flex mt-6 gap-4">
                    <button class="btn block btn-sm grow">
                        Google
                    </button>
                    <button class="btn block btn-sm grow btn-neutral">
                        Github
                    </button>
                </div>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button @click="isOpen = false">{{ __('close') }}</button>
        </form>
    </x-simple-modal>
</div>
