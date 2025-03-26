<div>
    <x-header title="Hello" separator progress-indicator>
        <x-slot:actions>
            <x-theme-toggle class="btn btn-circle"/>
            <livewire:create-category/>
            <livewire:create-finance lazy=""/>
        </x-slot:actions>
    </x-header>

    <div class="grid grid-cols-2 grid-rows-2 gap-4">
        <div class="col-start-1">
            <livewire:income-chart wire:key="income"/>
        </div>
        <div class="col-start-1 row-start-2">
            <livewire:expense-chart wire:key="expense"/>
        </div>
        <div class="row-span-2 col-start-2 ">
            <livewire:history-table/>
        </div>
    </div>
</div>
