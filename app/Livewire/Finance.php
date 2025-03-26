<?php

namespace App\Livewire;

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
        $this->expense = [
            'labels' => ['Rent', 'Utilities', 'Food', 'Transportation', 'Entertainment'],
            'data' => [1000, 200, 300, 150, 50],
        ];

        $this->income = [
            'labels' => ['Salary', 'Investments', 'Savings', 'Gifts'],
            'data' => [3000, 500, 200, 100],
        ];
    }

    public function render()
    {
        return view('livewire.finance');
    }
}
