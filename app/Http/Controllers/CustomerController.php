<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Customer;
use App\Models\InvoiceSelling;
use App\Models\InvoiceSellingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\Produk;
use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function booking() {
        $carts = DB::table('cart_view')->where('user_id', auth()->user()->user_id)->get();

        return view("user.detail-pesanan",[
            "carts"=> $carts,
        ]);
    }

    public function booking_detail(Request $request){
            $validated_data = $request->validate([
                'nama' => ['required', 'string', 'min:5', 'max:255'],
                'nomor_telepon' => ['required', 'numeric', 'nullable', 'digits_between:10,14', 'starts_with:08'],
            ]);


        return view('user.pembayaran', [
            'nama' => $request->nama,
            'nomor_telepon'=> $request->nomor_telepon,
            'catatan' => $request->catatan ?? NULL,
            'totalHarga' => $request->total,
        ]);
    }
    public function pembayaran(Request $request){
        $status = false;

        $validated_data = $request->validate([
            'paymentMethod'=> ['required'],
            'buktiPembayaran' => ['required', 'file', 'max: 5120','mimes:pdf,png,jpeg,jpg'],
        ]);

        $produk_id = InvoiceSelling::on('user')->orderBy('invoice_code', 'desc')->pluck('invoice_code')->first();
        $number = intval(str_replace("INV-", "", $produk_id)) + 1;
        
        $validated_data['buktiPembayaran'] = $request->buktiPembayaran->store('bukti-pembayaran');

        $produks = User::on('user')->where('user_id', auth()->user()->user_id)->first()->cart->all();

        try {
            DB::beginTransaction();
            $uuid = Str::uuid();

            // membuat invoice
            InvoiceSelling::on('user')->create([
                'selling_invoice_id'=> $uuid,
                'invoice_code' => 'INV-'. str_pad($number, 6, '0', STR_PAD_LEFT),
                'customer_id' => User::on('user')->where('user_id', auth()->user()->user_id)->first()->user_id,
                'recipient_name' => $request->nama,
                'recipient_phone' => $request->nomor_telepon,
                'recipient_request'=> $request->catatan ?? "",
                'recipient_bank' => $request->paymentMethod,
                'recipient_payment'=> str_replace("bukti-pembayaran/", "",$validated_data['buktiPembayaran']),
                'order_date' => NOW(),
                'order_status' => $request->status,
            ]);
            // selesai membuat invoice

            foreach($produks as $produk){
                // memasukan product ke invoice_detail
                InvoiceSellingDetail::on('user')->create([
                    'selling_detail_id' => Str::uuid(),
                    'selling_invoice_id' => $uuid,
                    'product_name' => $produk->product->product_name,
                    'product_sell_price' => $produk->product->product_sell_price,
                    'quantity' => $produk->quantity,
                ]);
                // selesai memasukan product ke invoice_detail

                // $stock = $produk->product->detail()->orderBy('product_expired')->first()->product_stock - $produk->quantity;
                
                // mengurangi stock
                while ($produk->quantity > 0) {
                    if ($produk->quantity >= $produk->product->detail()->where('product_stock' , '>', 0)->orderBy('product_expired')->first()->product_stock) {
                        $produk->quantity = $produk->quantity - $produk->product->detail()->where('product_stock' , '>', 0)->orderBy('product_expired')->first()->product_stock;

                        $produk->product->detail()->where('product_stock' , '>', 0)->orderBy('product_expired')->first()->update([
                            'product_stock' => 0,
                        ]);
                    }else{
                        $produk->product->detail()->where('product_stock' , '>', 0)->orderBy('product_expired')->first()->update([
                            'product_stock' => $produk->product->detail()->where('product_stock' , '>', 0)->orderBy('product_expired')->first()->product_stock - $produk->quantity,
                        ]);

                        $produk->quantity = 0;
                    }
                }
                // akhir mengurangi stock

                // mengubah status jadi tidak aktif
                if ($produk->product->detail()->where('product_stock' , '>', 0)->first() == NULL) {
                    $produk->product->update([
                        'product_status' => 'tidak aktif',
                    ]);
                }
                // akhir mengubah status menjadi tidak aktif

                // if($stock == 0){
                //     if($produk->product->detail()->count() <= 1){
                //         $produk->product->update([
                //             'product_status' => 'tidak aktif',
                //         ]);
                //     }else{
                //         $produk->product->detail()->orderBy('product_expired')->first()->delete();
                //     }
                // }
            }
            
            foreach($produks as $produk){
                // menghapus product dari cart
                $produk->delete();
                // selesai menghapus product dari cart
            }

            $status = true;

            DB::commit();
        } catch (\Exception $e) {
            $status = false;
            DB::rollback();
            throw $e;
        }
        
        if ($status){
            return redirect('/')->with('status', "pembayaran-berhasil")->with('invoice_code', 'INV-'. str_pad($number, 6, '0', STR_PAD_LEFT))->with('customer_name', $request->nama);
        }else{
            return redirect('/')->with('status', "pembayaran-gagal");
        }
    }

    public function informasi_pembayaran(Request $request){
        return view('user.show-image',[
            'title' => 'Bukti Pembayaran',
            'root' => 'bukti-pembayaran',
            'file'=> $request->file,
            'id'=> $request->id,
        ]);
    }

    public function refund(Request $request){
        return view('user.show-image',[
            'title' => 'Refund',
            'root' => 'refund',
            'file'=> $request->file,
            'id'=> $request->id,
        ]);
    }

    public function cetak_struk(Request $request) {
        $invoice = InvoiceSelling::on('user')->where('selling_invoice_id', $request->id)->first();
        // dd($invoice);
        return view('user.invoice', [
            'invoice'=> $invoice,
        ]);
    }
}