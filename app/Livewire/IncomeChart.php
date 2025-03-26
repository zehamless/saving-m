<?php

namespace App\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Arr;
use Illuminate\Support\Number;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class IncomeChart extends Component
{
    use Toast;

    public array $chartData = [
        'type' => 'pie',
        'options' => [
            'responsive' => true,
            'maintainAspectRatio' => false,
        ],
        'data' => [
            'labels' => [],
            'datasets' => [
                [
                    'label' => [],
                    'data' => [],
                ]
            ]
        ]
    ];
    public string $title = "Title";

    public function mount()
    {
        $this->loadData();
    }

    #[On('update-income')]
    public function loadData()
    {
        try {
            $transactions = Transaction::with('category')
                ->where('isIncome', true)
                ->get();

            $total = $transactions->sum('amount');
            $this->title = Number::currency($total, 'IDR');

            $labels = $transactions->pluck('category.name')->unique()->values()->toArray();
            $data = $transactions->groupBy('category.name')
                ->map(fn($group) => $group->sum('amount'))
                ->values()
                ->toArray();

            Arr::set($this->chartData, 'data.labels', $labels);
            Arr::set($this->chartData, 'data.datasets.0.data', $data);

        } catch (\Exception $e) {
            $this->error('Failed to load data');
            $this->title = 'N/A';
        }
    }

    public function render(): View
    {
        return view('livewire.chart-component')->with([
            'subtitle' => 'Income'
        ]);
    }
}
