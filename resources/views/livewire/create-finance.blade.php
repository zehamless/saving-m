<div>

    <x-modal wire:model="modal" title="Hello" subtitle="Livewire example" persistent>
        <x-form no-separator wire:submit="save">
            <x-input required label="Amount" icon="o-user" placeholder="Amount" wire:model="form.amount" inline/>
            <x-radio required label="Select one inline" wire:model="form.isIncome" :options="$options" inline/>

            <x-datetime label="My date" wire:model="form.date" inline/>
            <x-select label="Inline label" wire:model="form.category_id" icon="o-user" :options="$categories" inline/>
            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.modal = false"/>
                <x-button label="Confirm" class="btn-primary" type="submit"/>
            </x-slot:actions>
        </x-form>
    </x-modal>

    <x-button label="Open" @click="$wire.modal = true"/>
</div>
