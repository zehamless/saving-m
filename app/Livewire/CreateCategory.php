<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class CreateCategory extends Component
{
    use Toast;

    #[Validate('required|string')]
    public string $name;
    public bool $categoryModal = false;

    public function save()
    {
        try {
            $this->validate();
            Category::create([
                'name' => $this->name,
            ]);
            $this->categoryModal = false;
            $this->dispatch('category-update');
            $this->success('Category created successfully');
            $this->reset();
        } catch (\Exception $e) {
            $this->error('Failed to create category');
        }
    }

    public function render()
    {
        return view('livewire.create-category');
    }
}
