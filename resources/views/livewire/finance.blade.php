<div>
    <x-header title="Hello" separator progress-indicator>
        {{--        <x-slot:middle class="!justify-end">--}}
        {{--            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />--}}
        {{--        </x-slot:middle>--}}
        {{--        <x-slot:actions>--}}
        {{--            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" class="btn-primary" />--}}
        {{--        </x-slot:actions>--}}
        <x-slot:actions>
            <x-theme-toggle class="btn btn-circle"/>
        </x-slot:actions>
    </x-header>

    <div class="grid grid-cols-2 grid-rows-2 gap-4">
        <div class="col-start-1 border-2">
            <livewire:chart-component title="Income" subtitle="Income" :label="$income['labels']" :data="$income['data']"/>
        </div>
        <div class="col-start-1 border-2 row-start-2">
            <livewire:chart-component title="Expense" subtitle="Expense" :label="$expense['labels']" :data="$expense['data']"/>
        </div>
        <div class="row-span-2 col-start-2 border-2">3</div>
    </div>
</div>
