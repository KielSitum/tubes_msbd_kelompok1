<?php

namespace App\Livewire;
use App\Models\Keranjang;
use Livewire\Component;
use Illuminate\Support\Str;

class CartButton extends Component
{
    public $user_id;
    public $product_id;
    protected $listeners = ['addToCart'];

    public function mount($user, $product){
        $this->user_id = $user;
        $this->product_id = $product;
    }

    public function addToCart($user_id,$product_id)
    {
        $existingCart = Keranjang::on('user')->where('user_id', $this->user_id)
        ->where('product_id', $this->product_id)
        ->first();

    if (!$existingCart) {
        Keranjang::on('user')->create([
            "cart_id" => Str::uuid(),
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'quantity' => 1
        ]);
        $this->dispatch('productAddedToCart');
    }
    }

    public function render()
    {
        return view('livewire.cartdisplay');
    }
}
