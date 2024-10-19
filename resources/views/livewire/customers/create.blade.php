<x-drawer wire:model="customerCreate" title="Create Customer" class="w-1/3 p-4" right>
    <x-form wire:submit="save" id="create-customer-form">
        <hr class="my-5" />
        <div class="space-y-2">
            <x-input label="Name" wire:model="form.name" />
            <x-input label="Email" wire:model="form.email" />
            <x-input label="Phone" wire:model="form.phone" />
            <x-input label="Tenant Name" wire:model="form.tenant_name" />
            <x-input label="Tenant Domain" wire:model="form.tenant_domain" />
            <x-input label="Tenant Slug" wire:model="form.tenant_slug" />
            <x-input label="Tenant Tax" wire:model="form.tenant_tax_id" />
            <x-password label="Password" wire:model="form.password" clearable />
        </div>
        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.customerCreate = false" />
            <x-button label="Save" type="submit" form="create-customer-form" />
        </x-slot:actions>
    </x-form>
</x-drawer>
