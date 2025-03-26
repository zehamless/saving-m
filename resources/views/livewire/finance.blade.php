<div>
    <x-header title="Hello" separator progress-indicator>
        <x-slot:actions>
            <div class="flex gap-2 items-center">
                <x-theme-toggle class="btn btn-circle btn-sm md:btn-md"/>
                <livewire:create-category/>
                <livewire:create-finance lazy=""/>
            </div>
        </x-slot:actions>
    </x-header>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2 lg:grid-rows-2">
        <div class="lg:col-start-1 lg:row-start-1">
            <livewire:income-chart wire:key="income"/>
        </div>

        <div class="lg:col-start-1 lg:row-start-2">
            <livewire:expense-chart wire:key="expense"/>
        </div>

        <div class="md:col-span-2 lg:col-start-2 lg:row-start-1 lg:row-span-2">
            <livewire:history-table/>
        </div>
    </div>


</div>
