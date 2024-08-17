<x-modal wire:model="opportunitiesRestore"
         title="Restore Confirmation"
         subtitle="You are restoring the opportunity {{ $opportunity?->name }}"
         separator>

    <x-slot:actions>
        <x-button label="Hum... no" @click="$wire.opportunitiesRestore = false" />
        <x-button label="Yes, I am" class="btn-primary" wire:click="restore" />
    </x-slot:actions>
</x-modal>
