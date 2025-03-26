<div>
    <x-modal wire:model="categoryModal" title="Sup!" subtitle="Create New Category">
        <x-form no-separator wire:submit="save">
            <x-input required label="Name" icon="o-credit-card" placeholder="Name" wire:model="name" inline/>
            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.categoryModal = false"/>
                <x-button label="Confirm" class="btn-primary" type="submit"/>
            </x-slot:actions>
        </x-form>
    </x-modal>

    <x-button label="Category" class=" btn-soft btn-sm" @click="$wire.categoryModal = true" icon="o-plus-circle"/>
</div>
