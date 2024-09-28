<x-modal wire:model="archiveModal"
         title="Archive Confirmation"
         subtitle="You are archiving the customer {{ $customer?->name }}"
         separator>

    <x-slot:actions>
        <x-button label="Hum... no" @click="$wire.archiveModal = false" />
        <x-button label="Yes, I am" class="btn-primary" wire:click="archive" />
    </x-slot:actions>
</x-modal>
