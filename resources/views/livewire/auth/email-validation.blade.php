<x-card title="{{ __('Enter your pin') }}" subtitle="{{ __('Copy and paste the pin here') }}" shadow separator
        class="flex items-center justify-center min-h-screen bg-neutral text-neutral-content">
    <div class="flex flex-col items-center justify-center mb-2">
        <div class="flex items-center">
            <x-pin
                wire:model.live="code"
                size="6"
                numeric
                @completed="$wire.show = true"
                @incomplete="$wire.show = false"
            />
            <template x-if="$wire.show">
                <x-button tooltip="{{ __('Send Verify Code') }}" icon="o-check-circle"
                          class="w-12 h-12 bg-primary text-white p-2 rounded-full ml-2"
                          wire:click="handle" wire:loading.attr="disabled"
                />
            </template>
        </div>
        @error('code')
        <x-alert icon="o-x-circle" class="alert-danger alert mt-2 text-red-500 text-red-700">
            <span class="text-sm text-red-500">{{ $message }}</span>
        </x-alert>
        @enderror

        @if ($sendNewCodeMessage)
            <span class="text-green-900-500 text-sm text-green-900">{{ $sendNewCodeMessage }}</span>
        @endif
    </div>
    <form wire:submit="sendNewCode">
        <div class="flex justify-center">
            <button class="btn btn-primary btn-sm" type="submit" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="sendNewCode">
                        {{ __('Resend code') }}
                    </span>
                <x-loading
                    wire:loading
                    wire:target="sendNewCode"
                    class="loading-infinity"
                    style="display: none"
                />
            </button>
        </div>
    </form>
</x-card>

