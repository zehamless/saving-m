<x-card title="History" shadow separator>
    <x-table :headers="$headers" :rows="$transactions" with-pagination>
        @scope('cell_isIncome', $transaction)
        @if($transaction['isIncome'])
            <x-badge value="Income" class="badge-primary"/>
        @else
            <x-badge value="Expense" class="badge-warning "/>
        @endif
        @endscope
        @scope('actions', $transaction)
        <x-button icon="o-trash" wire:click="delete({{$transaction['id']}})" spinner class="btn-sm"/>
        @endscope
    </x-table>
</x-card>
