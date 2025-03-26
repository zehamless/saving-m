<div>

    <x-modal wire:model="modal" title="Hello" subtitle="Livewire example" persistent>
        <x-form no-separator wire:submit="save">
            <x-input required label="Amount" icon="o-currency-dollar" placeholder="Amount" wire:model="form.amount" inline/>
            <x-radio required label="Select type" wire:model="form.isIncome" :options="$options" inline/>

            <x-datetime label="Date" wire:model="form.date" inline/>
            <x-select label="Category" wire:model="form.category_id" icon="o-banknotes" :options="$categories" inline/>
            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.modal = false"/>
                <x-button label="Confirm" class="btn-primary" type="submit"/>
            </x-slot:actions>
        </x-form>
    </x-modal>

    <x-button label="Create" class="btn-primary" @click="$wire.modal = true" icon="o-plus-circle"/>
</div>
