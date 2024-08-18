<div>
    <x-simple-modal wire:model="showRecovery">
        <div class="modal-box md:max-w-sm max-w-xs">
            <x-icon name="o-x-circle" class="text-red-600 absolute right-0 mr-8 cursor-pointer"
                    @click="$wire.showRecovery = false" />
            <div class="text-center">
                <h3 class="font-semibold text-xl">{{ __('Login') }}</h3>
            </div>

            @if($message)
                <x-alert icon="o-exclamation-triangle" class="alert-success mb-4">
                    <span>{{ __('You will receive an email with the password recovery link.') }}</span>
                </x-alert>
            @endif
            <div>
                <form wire:submit.prevent="startPasswordRecovery"
                      x-on:keydown.enter.prevent="$wire.startPasswordRecovery()">
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
                    <div class="flex items-center justify-end mt-3 gap-3">
                        <button class="btn btn-primary btn-sm" type="submit" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="startPasswordRecovery">
                                {{ __('Submit') }}
                            </span>
                            <x-loading
                                wire:loading
                                wire:target="startPasswordRecovery"
                                class="loading-infinity"
                                style="display: none"
                            />
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button @click="isOpen = false">{{ __('close') }}</button>
        </form>
    </x-simple-modal>
</div>
