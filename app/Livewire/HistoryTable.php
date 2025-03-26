<?php

namespace App\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Number;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;
use Livewire\Attributes\On;

class HistoryTable extends Component
{
    use WithPagination, Toast;

    #[On('update-income'), On('update-expense')]
    public function refreshData()
    {
        $this->resetPage();
    }

    public function delete(Transaction $id)
    {
        try {
            $event = $id->isIncome ? 'update-income' : 'update-expense';
            $id->delete();
            $this->dispatch($event);
            $this->success('Transaction deleted successfully');
        } catch (\Exception $e) {
            $this->error('Failed to delete transaction');
        }
    }

    public function render()
    {
        return view('livewire.history-table')->with([
            'headers' => [
                ['key' => 'date', 'label' => 'Date'],
                ['key' => 'category', 'label' => 'Category'],
                ['key' => 'amount', 'label' => 'Amount'],
                ['key' => 'isIncome', 'label' => 'Type'],
            ],
            'transactions' => Transaction::with('category')
                ->latest()
                ->paginate(15)
                ->through(function ($transaction) {
                    return [
                        'id' => $transaction->id,
                        'date' => $transaction->date->format('d M Y'),
                        'category' => $transaction->category->name,
                        'amount' => Number::currency($transaction->amount, in: "IDR"),
                        'isIncome' => $transaction->isIncome,
                    ];
                }),
        ]);
    }
}
