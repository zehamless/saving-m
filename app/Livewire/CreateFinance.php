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
        $this->validate();
        Transaction::create(
            $this->form->all()
        );
        $this->modal = false;
        $this->success('Transaction created successfully');
    }

    public function render()
    {
        return view('livewire.create-finance')->with([
            'options' => [
                ['id' => 0, 'name' => 'Income'],
                ['id' => 1, 'name' => 'Expense'],
            ],
            'categories' => Category::all()->map(function ($category) {
                return ['id' => $category->id, 'name' => $category->name];
            }),
        ]);
    }
}
