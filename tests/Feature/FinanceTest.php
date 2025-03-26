<?php

use App\Livewire\CreateFinance;
use App\Livewire\ExpenseChart;
use App\Livewire\IncomeChart;
use App\Models\Category;
use App\Models\Transaction;
use Livewire\Livewire;

it('missing input', function () {
    Livewire::test(CreateFinance::class)
        ->call('save')
        ->assertHasErrors('form.isIncome')
        ->assertHasErrors('form.amount')
        ->assertHasErrors('form.date')
        ->assertHasErrors('form.category_id');
});

it('dispatches update-income event when saving an income entry', function () {
    $id = Category::factory(1)->create()->first()->id;
    $total = Transaction::where('isIncome', true)->sum('amount');
    Livewire::test(CreateFinance::class)
        ->set('form', ['isIncome' => true, 'amount' => 1000, 'date' => now(), 'category_id' => $id])
        ->call('save')
        ->assertNotDispatched('update-expense')
        ->assertDispatched('update-income');
    Livewire::test(IncomeChart::class)
        ->assertSee(Number::currency($total + 1000, 'IDR'))
        ->assertHasNoErrors();
});

it('dispatches update-expense event when saving an expense entry and update expense chart', function () {
    $id = Category::factory(1)->create()->first()->id;
    $total = Transaction::where('isIncome', false)->sum('amount');
    Livewire::test(CreateFinance::class)
        ->set('form', ['isIncome' => false, 'amount' => 1000, 'date' => now(), 'category_id' => $id])
        ->call('save')
        ->assertNotDispatched('update-income')
        ->assertDispatched('update-expense');

    Livewire::test(ExpenseChart::class)
        ->assertSee(Number::currency($total + 1000, 'IDR'))
        ->assertHasNoErrors();
});

it('returns correct options for finance types', function () {
    Livewire::test(CreateFinance::class)
        ->assertSet('options', [
            ['id' => 1, 'name' => 'Income'],
            ['id' => 0, 'name' => 'Expense'],
        ]);
});

it('returns all categories', function () {
    Category::factory()->count(3)->create();
    Livewire::test(CreateFinance::class)
        ->assertSet('categories', Category::all()->map(fn($category) => [
            'id' => $category->id,
            'name' => $category->name
        ])->toArray());
});
