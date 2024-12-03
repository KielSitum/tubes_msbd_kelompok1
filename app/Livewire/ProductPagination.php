<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Produk;

class ProductPagination extends Component
{
    use WithPagination;
    public $routeName;

    public function mount($routeName)
    {
        $this->routeName = $routeName;
    }
    
    public function render()
    {
        $all_products = Product::paginate(12);

        return view('livewire.product-pagination',['all_products' => $all_products]);
    }
}
