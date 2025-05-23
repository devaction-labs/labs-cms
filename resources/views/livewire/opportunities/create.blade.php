<x-drawer wire:model="opportunitiesCreate" title="Create Opportunity" class="w-1/3 p-4" right>

    <x-form wire:submit="save" id="create-opportunity-form">
        <hr class="my-5" />
        <div class="space-y-2">
            <x-choices label="Customer" wire:model="form.customer_id" :options="$form->customers" single searchable />
            <x-input label="Title" wire:model="form.title" />
            <x-select
                label="Status"
                :options="[
                    ['id' => 'open', 'name' =>'open'],
                    ['id' => 'won', 'name' =>'won'],
                    ['id' => 'lost', 'name' =>'lost'],
                ]"
                wire:model="form.status"
            />
            <x-input label="Amount" wire:model="form.amount"
                     prefix="R$" locale="pt-BR" money />
        </div>
        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.opportunitiesCreate = false" />
            <x-button label="Save" type="submit" form="create-opportunity-form" />
        </x-slot:actions>
    </x-form>


</x-drawer>
