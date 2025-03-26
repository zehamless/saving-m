<?php

namespace App\Livewire;

use App\Livewire\Forms\FinanceForm;
use App\Models\Category;
use App\Models\Transaction;
use Livewire\Component;
use Mary\Traits\Toast;

class CreateFinance extends Component
{
    use Toast;

    public bool $modal = false;
    public FinanceForm $form;

    public function save()
    {
        try {
            $this->validate();
            Transaction::create(
                $this->form->all()
            );
            $this->modal = false;
            $event = $this->form->isIncome ? 'update-income' : 'update-expense';
            $this->dispatch($event);
            $this->success('Transaction created successfully');
            $this->reset();
        } catch (\Exception $e) {
            $this->error('Failed to create transaction');
        }
    }

    public function render()
    {
        return view('livewire.create-finance')->with([
            'options' => [
                ['id' => 1, 'name' => 'Income'],
                ['id' => 0, 'name' => 'Expense'],
            ],
            'categories' => Category::all()->map(function ($category) {
                return ['id' => $category->id, 'name' => $category->name];
            }),
        ]);
    }
}
