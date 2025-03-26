<x-card :title="$title" :subtitle="$subtitle" shadow separator wire:key="$title">
    <x-chart wire:model="chartData" wire:key="$title"/>
</x-card>
