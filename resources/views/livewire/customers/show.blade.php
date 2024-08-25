<div>
    <x-header separator>
        <x-slot:title>
            <livewire:component.breadcrumb :items="[
                ['label' => 'Home', 'url' => route('dashboard')],
                ['label' => 'Customers', 'url' => route('customers')],
                ['label' => $customer->name, 'url' => '']
             ]"
            />

        </x-slot:title>
    </x-header>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-base-200 rounded-md p-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-info.title>Personal Info</x-info.title>
                    <x-info.data title="Name">{{ $customer->name }}</x-info.data>
                    <x-info.data title="Gender">{{ $customer->gender }}</x-info.data>
                    <x-info.data title="Age">{{ $customer->age }}</x-info.data>
                </div>

                <div>
                    <x-info.title>Contact Info</x-info.title>
                    <x-info.data title="Email">{{ $customer->email }}</x-info.data>
                    <x-info.data title="Phone">{{ $customer->phone }}</x-info.data>
                    <x-info.data title="Linkedin">{{ extractUsername($customer->linkedin) }}</x-info.data>
                    <x-info.data title="Facebook">{{ extractUsername($customer->facebook) }}</x-info.data>
                    <x-info.data title="Twitter">{{ extractUsername($customer->twitter) }}</x-info.data>
                    <x-info.data title="Instagram">{{ extractUsername($customer->instagram) }}</x-info.data>
                </div>

                <div>
                    <x-info.title>Company Info</x-info.title>
                    <x-info.data title="Company">{{ $customer->company }}</x-info.data>
                    <x-info.data title="Position">{{ $customer->position }}</x-info.data>
                </div>

                <div>
                    <x-info.title>Address Info</x-info.title>
                    <x-info.data title="Address">{{ $customer->address }}</x-info.data>
                    <x-info.data title="City">{{ $customer->city }}</x-info.data>
                    <x-info.data title="State">{{ $customer->state }}</x-info.data>
                    <x-info.data title="Country">{{ $customer->country }}</x-info.data>
                    <x-info.data title="Zip">{{ $customer->zip }}</x-info.data>
                </div>

                <div class="col-span-2">
                    <x-info.title>Record Info</x-info.title>
                    <x-info.data title="Created At">{{ $customer->created_at->diffForHumans() }}</x-info.data>
                    <x-info.data title="Updated At">{{ $customer->updated_at->diffForHumans() }}</x-info.data>
                </div>
            </div>
        </div>


        <div class="bg-base-200 rounded-md text-base col-span-2">
            <div class="py-2 bg-base-100 rounded-t-md w-full space-x-4 px-4">
                <x-ui.tab :href="route('customers.show', [$customer, 'opportunities'])">
                    {{ __('Opportunities') }}
                </x-ui.tab>
                <x-ui.tab :href="route('customers.show', [$customer, 'tasks'])">
                    Tasks
                </x-ui.tab>
                <x-ui.tab :href="route('customers.show', [$customer, 'notes'])">
                    Notes
                </x-ui.tab>
            </div>

            <div class="">
                @livewire("customers.$tab.index", ["customer" => $customer])
            </div>
        </div>
    </div>
</div>
