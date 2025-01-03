<?php

namespace App\Livewire;

use App\Models\Keranjang;
use Illuminate\Support\Str;
use Livewire\Component;

class CartNotif extends Component
{
    protected $listeners = ['count_cart'];
    public $count;

    public function mount($count)
    {
        $this->count = $count;
    }

    public function count_cart($user_id, $product_id, $quantity) {
        if(Keranjang::on('user')->where('user_id', $user_id)->where('product_id', $product_id)->first() == NULL){
            Keranjang::on('user')->create([
                "cart_id"=> Str::uuid(),
                "user_id"=> $user_id,
                "product_id"=> $product_id,
                "quantity" => $quantity,
            ]);
        }

        $this->count = Keranjang::on('user')->where("user_id", $user_id)->count();
    }

    public function render()
    {
        return view('livewire.cart-notif');
    }
}
