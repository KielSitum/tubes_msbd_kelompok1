<?php

namespace App\Livewire;
use App\Models\User;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\InvoiceSelling;
use App\Models\InvoiceSellingDetail;
use App\Models\DetailProduk;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class Cartdisplay extends Component
{
    public $user_id;
    public $product_id;
    public $cartItems;
    public $cart;
    public $totalProducts = 0;
    public $quantity;
    protected $listeners = ['productAddedToCart', 'decrementButton', 'incrementButton'];

    public function mount() {
        $this->cartItems = Keranjang::on('cashier')->where('user_id', auth()->user()->user_id)->get();
    }

    public function productAddedToCart($user, $product)
    {
        $existingCart = Keranjang::on('cashier')->where('user_id', $user)
        ->where('product_id', $product)
        ->first();

        if (!$existingCart) {
            Keranjang::on('cashier')->create([
                "cart_id" => Str::uuid(),
                'user_id' => $this->user,
                'product_id' => $this->product,
                'quantity' => 1
            ]);
        }
        $this->cartItems = Keranjang::on('cashier')->where('user_id', $user)->get();
    }


    public function decrementButton($cart, $detail_product) {
        if($cart['quantity'] > $detail_product['product_stock']) {
            Keranjang::on('cashier')->where('cart_id', $cart['cart_id'])->update([
                'quantity'=> $detail_product['product_stock'],
            ]);
        }else if($cart['quantity'] <= $detail_product['product_stock'] && $cart['quantity'] > 1) {
            Keranjang::on('cashier')->where('cart_id', $cart['cart_id'])->update([
                'quantity'=> $cart['quantity'] - 1,
            ]);
        }else {
            Keranjang::on('cashier')->where('cart_id', $cart['cart_id'])->delete();
        }
        $this->cartItems = Keranjang::on('cashier')->where('user_id', auth()->user()->user_id)->get();
        // $this->quantity = Cart::where('cart_id', $this->cart_id)->first()->quantity;
        // $this->dispatch('quantity', $this->cart_id, $this->quantity);
    }

        public function incrementButton($cart, $detail_product) {
            // $carts = collect($cart);
            // dd($detail_product['product_stock']);
            if($cart['quantity'] > $detail_product) {
                Keranjang::on('cashier')->where('cart_id', $cart['cart_id'])->update([
                    'quantity'=> $detail_product,
                ]);
            }else if($cart['quantity'] <= $detail_product && $cart['quantity'] >= 1) {
                Keranjang::on('cashier')->where('cart_id', $cart['cart_id'])->update([
                    'quantity'=> $cart['quantity'] + 1,
                ]);
            }else{
                Keranjang::on('cashier')->where('cart_id', $cart['cart_id'])->update([
                    'quantity'=> 1,
                ]);
            }
            $this->cartItems = Keranjang::on('cashier')->where('user_id', auth()->user()->user_id)->get();
            // $quantity = Cart::where('cart_id', $this->cart_id)->first()->quantity;
            // $this->dispatch('quantity', $this->cart_id, $this->quantity);
        }
    // private function updateCartItems($user, $product)
    // {
    // }

    public function render()
    {
        return view('livewire.cartdisplay');
    }
}