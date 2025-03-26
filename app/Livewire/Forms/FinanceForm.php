<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class FinanceForm extends Form
{
    #[Validate('required|numeric')]
    public $amount;

    #[Validate('required|boolean')]
    public $isIncome;

    #[Validate('required|date')]
    public $date;

    #[Validate('required|exists:categories,id')]
    public $category_id;
}
