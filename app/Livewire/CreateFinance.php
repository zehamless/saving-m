<?php

namespace App\Livewire;

use App\Livewire\Forms\FinanceForm;
use App\Models\Category;
use App\Models\Transaction;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class CreateFinance extends Component
{
    use Toast;

    public bool $modal = false;
    public bool $categoryModal = false;
    public FinanceForm $form;

    #[Computed]
    public function options()
    {
        return
            [
                ['id' => 1, 'name' => 'Income'],
                ['id' => 0, 'name' => 'Expense'],

            ];
    }

    #[Computed]
    #[On('category-update')]
    public function categories()
    {
        return Category::all()
            ->map(fn($category) => [
                'id' => $category->id,
                'name' => $category->name
            ])
            ->toArray();
    }

    public function save()
    {
        $this->validate();
        try {

            Transaction::create($this->form->all());

            $this->modal = false;
            $event = $this->form->isIncome ? 'update-income' : 'update-expense';
            $this->dispatch($event);
            $this->success('Transaction created successfully');

            $this->reset('form');
        } catch (\Exception $e) {
            $this->error('Failed to create transaction');
        }
    }

    public function render()
    {
        return view('livewire.create-finance');
    }
}
