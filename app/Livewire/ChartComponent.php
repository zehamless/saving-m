<?php

namespace App\Livewire;

use Livewire\Component;

class ChartComponent extends Component
{
    public string $title;
    public string $subtitle;
    public array $chartData = [];

    public function mount(string $title, string $subtitle, array $label, array $data): void
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->chartData = [
            'type' => 'pie',
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false,
            ],
            'data' => [
                'labels' => $label,
                'datasets' => [
                    [
                        'label' => $title,
                        'data' => $data,
                    ]
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.chart-component');
    }
}
