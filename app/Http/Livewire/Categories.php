<?php

namespace App\Http\Livewire;

use App\Models\category;
use App\Models\SubCategory;
use Livewire\Component;

class Categories extends Component
{
    public $categories=null;
    public $selectedCategory = null;
    public $selectedSubCategory = null;
    public $sub_categories=null;

    public function mount()
    {
        $this->categories = category::select('id', 'name')
            ->where('staff_id', auth()->user()->id)
            ->get();
        if($this->selectedCategory)
        {
            $this->updatedselectedCategory();
        }
    }

    public function render()
    {
        return view('livewire.categories');
    }

    public function updatedselectedCategory()
    {
        $this->sub_categories = SubCategory::select('id','name')
            ->where('category_id',$this->selectedCategory)->get();
    }
}
