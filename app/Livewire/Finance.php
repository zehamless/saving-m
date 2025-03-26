<?php

namespace App\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Number;
use Livewire\Component;

class Finance extends Component
{
    public array $expense = [];
    public array $income = [];

    public function mount(): void
    {
        $this->loadChartData();
    }

    private function loadChartData(): void
    {
        $expense = Transaction::with('category')
            ->where('isIncome', false)
            ->get();
        $this->expense = [
            'labels' => $expense->pluck('category.name')->toArray(),
            'data' => $expense->pluck('amount')->toArray(),
            'total' => Number::currency($expense->sum('amount')),
        ];
        $income = Transaction::with('category')
            ->where('isIncome', true)
            ->get();
        $this->income = [
            'labels' => $income->pluck('category.name')->toArray(),
            'data' => $income->pluck('amount')->toArray(),
            'total' => Number::currency($income->sum('amount')),
        ];
    }

    public function render()
    {
        return view('livewire.finance');
    }
}
