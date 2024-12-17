<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kasir;
use App\Models\Kategori;
use App\Models\Customer;
use App\Models\Group;
use App\Models\Unit;
use App\Models\InvoiceSelling;
use App\Models\InvoiceBuying;
use App\Models\LastTransaction;
use App\Models\DeskripsiProduk;
use App\Models\DetailProduk;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Log;
use App\Models\PromoDiskon;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCashierRequest;
use App\Http\Requests\UpdateCashierRequest;
use App\Policies\SellingInvoiceDetailPolicy;
use Exception;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Echo_;

class OwnerController extends Controller
{
    public function display()
    {
        $count_product = Produk::on('owner')->count();
        $count_supplier = Supplier::on('owner')->count();
        $count_user = User::on('owner')->where('role', 'user')->count();
        $count_pending = InvoiceSelling::on('owner')->where('order_status','Menunggu Pengembalian')->count();

        $result = DB::connection('owner')->table('invoice_selling')
            ->selectRaw('YEAR(MIN(order_complete)) as minYear, YEAR(MAX(order_complete)) as maxYear')
            ->whereNotNull('order_complete')
            ->first();

        $minYear = $result->minYear;
        $maxYear = $result->maxYear;

        $results = DB::connection('owner')->table('invoice_selling')
        ->selectRaw('DISTINCT YEAR(order_complete) as year')
        ->selectRaw('total_keuntungan(CONCAT(YEAR(order_complete), "-01-01"), CONCAT(YEAR(order_complete), "-12-31")) as total_profit')
        ->whereYear('order_complete', '>=', $minYear)
        ->whereYear('order_complete', '<=', $maxYear)
        ->whereNotNull('order_complete')
        ->groupBy(DB::raw('YEAR(order_complete), invoice_selling.order_complete'))
        ->get();
        
        $resultsArray = $results->toArray();

        return view ('pemilik.index', [
            'product' => $count_product,
            'supplier' => $count_supplier,
            'pending' => $count_pending,
            'user' => $count_user,
            'results' => $resultsArray
        ]);
    }

    public function total_pesanan_online()
    {
        $total_pesanan_online = InvoiceSelling::on('owner')->where('order_status','Berhasil')->count();
        return $total_pesanan_online;
    }
    
    public function display_user()
    {
        $user = Customer::on('owner')->get();
        return view('pemilik.list-user', [
            'user' => $user,
            'total' => $this->total_pesanan_online()
        ]);
    }

    public function delete_user(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $user = Customer::on('owner')->find($id);

            User::on('owner')->where('user_id',$user->user_id)->delete();
            Customer::on('owner')->where('customer_id', $request->id)->delete();

            DB::commit();
            return redirect('/owner/user')->with('add_status','User berhasil dihapus');
        }catch(Exception $e){
            // throw $e;
            DB::rollBack();
            return redirect('/owner/user')->with('error_status','User gagal dihapus');
        }
    }

    public function display_product()
    {
        $products = Produk::on('owner')->get();
        
        return view('pemilik.list-produk',[
            'product' => $products,
            'total' => $this->total_pesanan_online()
        ]);
    }
    public function detail_product($id)
    {
        $products = Produk::on('owner')->find($id);

        return view('pemilik.detail-produk',[
            'product' => $products,
            'total' => $this->total_pesanan_online()
        ]);
    }

    public function add_product()
    {
        $category = Kategori::on('owner')->orderBy('category')->get();
        $group = Group::on('owner')->orderBy('group')->get();
        $unit = Unit::on('owner')->orderBy('unit')->get();
        $supplier = Supplier::on('owner')->orderBy('supplier')->get();

        return view('pemilik.tambah-produk',[
            "categories"=> $category ?? [],
            "units"=> $unit ?? [],
            "groups"=> $group ?? [],
            "suppliers"=> $supplier ?? [],
            // "status" => $state ?? [],
        ]);
    }

    public function add_product_process(Request $request)
    {
        $validated_data = $request->validate([
            'nama_obat' => ['required', 'min:5', 'max:255', 'unique:produk,product_name'],
            'gambar_obat' => ['required', 'file', 'max:5120', 'mimes:png,jpeg,jpg'],
            'kategori' => ['required'],
            'golongan' => ['required'],
            'satuan_obat' => ['required'],
            'NIE' => ['required', 'size:15'],
            'tipe' => ['required'],
            'pemasok' => ['required'],
            'produksi' => ['required', 'min:5', 'max:255'],
            'deskripsi' => ['required'],
            'efek_samping' => ['required'],
            'dosis' => ['required'],
            'harga_beli' => ['required', 'numeric', 'min:3'],
            'harga_jual' => ['required', 'numeric', 'min:3'],
            'stock' => ['required', 'numeric', 'min:0'],
            'expired_date' => 'required|date|after_or_equal:3 months',
            ], 
            [
            'expired_date.after_or_equal' => 'Tanggal harus lebih dari 3 bulan dari sekarang.',
            ]);

            try{
                $carbonDate = Carbon::parse($request->expired_date);
                $formatted = $carbonDate->format('Y-m-d H:i:s');
                $GambarObat = $validated_data['gambar_obat']->store('gambar-obat');

                DB::connection('owner')->statement('CALL add_product_procedure(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                    $request->id,
                    $request->nama_obat,
                    $request->status,
                    str_replace("gambar-obat/","",$GambarObat),
                    $request->desc_id,
                    $request->kategori,
                    $request->golongan,
                    $request->satuan_obat,
                    $request->NIE,
                    $request->tipe,
                    $request->pemasok,
                    $request->produksi,
                    $request->deskripsi,
                    $request->efek_samping,
                    $request->dosis,
                    $request->indikasi,
                    $request->peringatan,
                    $request->harga_beli,
                    $formatted,
                    $request->harga_jual,
                    $request->stock,
                    $request->detail_id
                ]);

                return redirect('/owner/produk')->with('add_status','Produk berhasil ditambah');
            }catch(Exception $e){
                throw $e;

                // return redirect('/owner/produk')->with('error_status','Produk gagal ditambah');
            }
        }

    public function edit_product($id)
    {
        $products = Produk::on('owner')->findOrFail($id);
        $category = Kategori::on('owner')->orderBy('category')->get();
        $group = Group::on('owner')->orderBy('group')->get();
        $unit = Unit::on('owner')->orderBy('unit')->get();
        $supplier = Supplier::on('owner')->orderBy('supplier')->get();
        $state = ['aktif', 'tidak aktif'];

        return view('pemilik.edit-produk',[
            "product"=> $products ?? NULL,
            "categories"=> $category ?? [],
            "units"=> $unit ?? [],
            "groups"=> $group ?? [],
            "suppliers"=> $supplier ?? [],
            "status" => $state ?? [],
        ]);
    }

    public function edit_product_process(Request $request,$id)
    {
        $products = Produk::on('owner')->find($id);

        if($products->product_name == $request->nama_obat){
            $validated_data = $request->validate([
                'nama_obat' => ['required', 'min:5', 'max:255'],
                'gambar_obat' => ['file', 'max:5120', 'mimes:png,jpeg,jpg'],
                'kategori' => ['required'],
                'golongan' => ['required'],
                'satuan_obat' => ['required'],
                'NIE' => ['required', 'size:15'],
                'tipe' => ['required'],
                'pemasok' => ['required'],
                'produksi' => ['required', 'min:5', 'max:255'],
                'deskripsi' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
                'efek_samping' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
                'dosis' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
                'harga_jual' => ['required', 'numeric', 'min:3'],
            ]);
        }else{
            $validated_data = $request->validate([
                'nama_obat' => ['required', 'min:5', 'max:255', 'unique:produk,product_name'],
                'gambar_obat' => ['file', 'max:5120', 'mimes:png,jpeg,jpg'],
                'kategori' => ['required'],
                'golongan' => ['required'],
                'satuan_obat' => ['required'],
                'NIE' => ['required', 'size:15'],
                'tipe' => ['required'],
                'pemasok' => ['required'],
                'produksi' => ['required', 'min:5', 'max:255'],
                'deskripsi' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
                'efek_samping' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
                'dosis' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
                'harga_jual' => ['required', 'numeric', 'min:3'],
            ]);
        }
        
        $validated_data = $request->validate([
            'gambar_obat' => ['file', 'max:5120', 'mimes:png,jpeg,jpg'],
        ]);

        try{
           
            $products -> product_status = $request->status;
            $products -> product_name = $request->nama_obat;
            $products -> description -> category_id = $request->kategori;
            $products -> description -> group_id = $request->golongan;
            $products -> product_sell_price = $request->harga_jual;
            $products -> description -> unit_id = $request->satuan_obat;
            $products -> description -> product_DPN = $request->NIE;
            $products -> description -> supplier_id = $request->pemasok;
            $products -> description -> product_manufacture = $request->produksi;
            $products -> description -> product_description = $request->deskripsi;
            $products -> description -> product_sideEffect = $request->efek_samping;
            $products -> description -> product_dosage = $request->dosis;
            $products -> description -> product_indication = $request->indikasi;
            $products -> description -> product_notice = $request->peringatan;
    
            if ($request->hasFile('gambar_obat')) {
                $GambarObat = $validated_data['gambar_obat']->store('gambar-obat');
                $products -> description -> product_photo = str_replace("gambar-obat/","",$GambarObat);
            }
    
            $products->save();
            $products->description->save();
            $products->detail()->orderBy('product_expired')->first()->save();
            
            return redirect('/owner/produk')->with('add_status','Produk berhasil diperbaharui');
        }catch(Exception $e){
            DB::rollBack();

            return redirect('/owner/produk')->with('error_status','Produk gagal diperbaharui');
        }
    }

    public function delete_product_expired(Request $request){
        DB::beginTransaction();

        try{

            DetailProduk::where('detail_id', $request->detail_id)->first()->product->update([
                'product_status' => 'aktif',
            ]);
            DetailProduk::where('detail_id', $request->detail_id)->delete();

            DB::commit();
            return redirect()->back()->with('add_status', "Status Kembali Aktif");
        }catch (Exception $e) {
            DB::rollback();
            // throw $e;
            return redirect()->back()->with('error_status', "Terjadi Kesalahan");
        }
    }

    public function add_batch($id)
    {
        $products = Produk::on('owner')->find($id);

        return view('pemilik.tambah-batch',[
            'product' => $products
        ]);
    }

    public function add_batch_process(Request $request)
    {
        try{
            $carbonDate = Carbon::parse($request->expired_date);
            $formatted = $carbonDate->format('Y-m-d H:i:s');

            $product_id = $request->id;
            $products = Produk::findOrFail($product_id);
            $detail_id = $request->detail_id;
            $product_buy_price = $request->harga_beli;
            $product_expired = $formatted;
            $product_stock = $request->stock;

            $pemasok = $products->description->supplier_id;

            DB::statement('CALL add_batch_procedure(?, ?, ?, ?, ?, ?)', [
                $pemasok,
                $product_id,
                $detail_id,
                $product_buy_price,
                $product_expired,
                $product_stock,
            ]);

    
            return redirect('/owner/produk')->with('add_status','Batch produk berhasil ditambah');
        }catch(Exception $e){

            return redirect('/owner/produk')->with('error_status','Batch produk gagal ditambah');
        }
    }

    public function display_supplier()
    {
        $supplier = Supplier::on('owner')->orderBy('supplier')->get();

        return view('pemilik.list-supplier',[
            'suppliers' => $supplier,
            'total' => $this->total_pesanan_online()
        ]);
    }

    public function add_supplier(Request $request)
    {
        $request->validate([
            'nama_supplier' => ['required', 'string', 'min:5', 'max:255', 'unique:suppliers,supplier'],
            'no_telp' => ['required','numeric', 'nullable', 'digits_between:10,14', 'starts_with:08'],
            'alamat' => ['required', 'min:10', 'max:255']
        ]);
        
        DB::beginTransaction();
        try{            
            $new_supplier = new Supplier;
            $new_supplier -> supplier_id = Str::uuid();
            $new_supplier -> supplier = $request->nama_supplier;
            $new_supplier -> supplier_address = $request->alamat;
            $new_supplier -> supplier_phone = $request->no_telp;
            
            $new_supplier->save();

            DB::commit();
            return redirect('owner/supplier')->with('add_status','Supplier Berhasil Ditambah');
        }catch(Exception $e){
            DB::rollBack();

            return redirect('/owner/supplier')->with('error_status','Terjadi Kesalahan');
        }
    }

    public function edit_supplier(Request $request,$id)
    {
        $request->validate([
            'no_telp' => ['required','numeric', 'nullable', 'digits_between:10,14', 'starts_with:08'],
            'alamat' => ['required', 'min:10', 'max:255']
        ]);

        DB::beginTransaction();
        try{
            $suppliers = Supplier::on('owner')->find($id);

            $suppliers -> supplier_address = $request->alamat;
            $suppliers -> supplier_phone = $request->no_telp;

            $suppliers ->save();

            DB::commit();
            return redirect('owner/supplier')->with('add_status','Supplier Berhasil Diedit');
        }catch(Exception $e){
            DB::rollBack();

            return redirect('/owner/supplier')->with('error_status','Terjadi Kesalahan');
        }
    }

    public function delete_supplier(Request $request,$id)
    {
        DB::beginTransaction();
        try{
            Supplier::where('supplier_id', $request->id)->first()->delete();

            DB::commit();
            return redirect('/owner/supplier')->with('add_status','Supplier berhasil dihapus');
        }catch(Exception $e){
            DB::rollBack();

            return redirect('/owner/supplier')->with('error_status','Tidak Dapat menghapus Supplier, Sedang Digunakan Oleh Produk');
        }
    }

    public function log_penjualanan()
    {
        $selling = InvoiceSelling::on('owner')->get();

        return view('pemilik.log-transaksi-penjualan',[
            'sellings' => $selling,
            'total' => $this->total_pesanan_online()
        ]);

    }

    public function log_pembelian()
    {
        $buying = InvoiceBuying::on('owner')->get();
        $supplierNames = $buying->pluck('supplier_name')->all();
        $supplier = Supplier::on('owner')->whereIn('supplier', $supplierNames)->first();

        return view('pemilik.log-transaksi-pembelian',[
            'buying' => $buying,
            'supplier' => $supplier,
            'total' => $this->total_pesanan_online()
        ]);

    }

    public function lihatKasir(){

        $cashiers = User::on('owner')->where('role', 'cashier')
        ->get();

        return view ('pemilik.list-kasir', [
            'cashiers' => $cashiers,
            'total' => $this->total_pesanan_online()
        ]);
    }

    public function tambahKasir(Request $request){
        $request->validate([
            'username' => ['required', 'string', 'min:5', 'max:255', 'regex:/^[^\s]+$/', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:8', 'regex:/^[^\s]+$/'],
            'nohp' => ['required','numeric', 'nullable', 'digits_between:10,14', 'starts_with:08'],
            'address' => ['required', 'min:10']
        ]);

        DB::beginTransaction();
        try{
            $new_user = new User;
            $uuid = Str::uuid();
    
            $new_user->user_id = $uuid;
            $new_user->username = $request->username;
            $new_user->email = $request->email;
            $new_user->role = 'cashier';
            $new_user->password = $request->password;
            $new_user->save();
    
            $new_cashier = new Kasir;
            $new_cashier -> cashier_id = Str::uuid();
            $new_cashier -> user_id = $uuid;
            $new_cashier -> cashier_phone = $request->nohp;
            $new_cashier -> cashier_gender = $request->gender;
            $new_cashier -> cashier_address = $request->address;
            $new_cashier -> save();
    
            DB::commit();
            return redirect('/owner/kasir')->with('add_status','Kasir Berhasil Ditambah');
        }catch(Exception $e){
            DB::rollBack();

            return redirect('/owner/kasir')->with('error_status','Terjadi Kesalahan');
        }
    }   
    
    public function editKasir(Request $request,$id)
    {
        $request->validate([
            'nohp' => ['required','numeric', 'nullable', 'digits_between:10,14', 'starts_with:08'],
            'address' => ['required', 'min:10']
        ]);

        DB::beginTransaction();
        try{
            $cashiers= Kasir::find($id);

            $cashiers -> cashier_phone = $request->nohp;
            $cashiers -> cashier_gender = $request->gender;
            $cashiers -> cashier_address = $request->address;
            
            $cashiers -> save();

            DB::commit();
            return redirect('/owner/kasir')->with('add_status','Kasir Berhasil Diedit');
        }catch(Exception $e){
            DB::rollBack();

            return redirect('/owner/kasir')->with('error_status','Terjadi Kesalahan');
        }
    }

    public function deleteKasir(Request $request)
    {
        DB::beginTransaction();

        try{

            User::on('owner')->where('user_id', $request->id)->delete();

            DB::commit();
            return redirect('/owner/kasir')->with('add_status','Kasir berhasil dihapus');
        }catch(Exception $e){
            DB::rollBack();
            
            return redirect('/owner/kasir')->with('error_status','Kasir gagal dihapus');
        }
    }

    public function pendingOrder()
    {
        $pendingOrders = InvoiceSelling::on('owner')->where('order_status', 'Menunggu Pengembalian')
            ->orderBy('order_date', 'desc')
            ->get(); // get() sudah otomatis mengembalikan koleksi kosong jika tidak ada data
    
        // Jika koleksi kosong, set sebagai koleksi kosong secara eksplisit (optional)
        if ($pendingOrders->isEmpty()) {
            $pendingOrders = collect(); 
        }
    
        return view('pemilik.pesanan-pending', [
            'pendingOrders' => $pendingOrders,
            'total' => $this->total_pesanan_online()
        ]);
    }

    public function bukti_pembayaran(Request $request){
        return view('pemilik.show-image',[
            'title' => 'Bukti Pembayaran',
            'root' => 'bukti-pembayaran',
            'file'=> $request->img,
        ]);
    }

    public function refund(Request $request, $id){
        $validated_data = $request->validate([
            'buktiRefund' => ['required', 'file', 'max:5120', 'mimes:pdf,png,jpeg,jpg'],
        ], [
            'buktiRefund.required' => 'Lampirkan bukti pengembalian uang terlebih dahulu.',
            'buktiRefund.file' => 'Dokumen pengembalian harus berupa file.',
            'buktiRefund.max' => 'Dokumen yang dilampirkan tidak boleh lebih dari 5 mb',
            'buktiRefund.mimes' => 'Format dokumen yang diterima adalah PDF, PNG, JPEG, or JPG file.',
        ]);

        DB::beginTransaction();
        try{
        $order = InvoiceSelling::on('owner')->findOrFail($id);

        
        $refund_file = basename($validated_data['buktiRefund']->store('refund'));
        
        $order->update([
            'refund_file' =>$refund_file,
            'order_status' => 'Refund',
        ]);

        DB::commit();
        return redirect()->back()->with('add_status', 'Berhasil melakukan refund.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
        DB::rollBack();
        return redirect()->back()->with('error_status', 'Pesanan tidak ditemukan.');
        }
    }

    public function display_log()
    {
        $logs = Log::on('owner')->get();
        return view('pemilik.log',[
            'logs' => $logs,
            'total' => $this->total_pesanan_online()
        ]);
    }

    public function promo_diskon()
    {
        $promoDiskon = PromoDiskon::all();

        return view('pemilik.promo', compact('promoDiskon'));
    }

    public function hapus_promo($id_promo)
    {
        PromoDiskon::find($id_promo)->delete();
        return redirect()->back()->with('success', 'Promo berhasil dihapus.');
    }

    public function tambah_promo(Request $request)
    {
        $data = new PromoDiskon;
        $data->nama_promo = $request->nama_promo;
        $data->nilai_diskon = $request->nilai_diskon;
        $data->tanggal_mulai = $request->tanggal_mulai;
        $data->tanggal_selesai = $request->tanggal_selesai;
        $data->status = $request->status;
        $data->save();
        return redirect()->back();
    }

    public function report(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date_format:Y-m',
        ]);

        $date = $request->input('tanggal');
        
        // Mengekstrak bulan dan tahun dari tanggal yang dipilih
        list($selectedYear, $selectedMonth) = explode('-', $date . '-01');

        // Menggabungkan hasil dari kedua tabel
        $report = LastTransaction::whereMonth('Tanggal_Transaksi', $selectedMonth)
        ->whereYear('Tanggal_Transaksi', $selectedYear)
        ->orderBy('Tanggal_Transaksi')
        ->get();

        $expenses = LastTransaction::whereMonth('Tanggal_Transaksi', $selectedMonth)
        ->whereYear('Tanggal_Transaksi', $selectedYear)
        ->where('tipe_transaksi', 'pembelian')
        ->get();
        
        $sales = LastTransaction::whereMonth('Tanggal_Transaksi', $selectedMonth)
        ->whereYear('Tanggal_Transaksi', $selectedYear)
        ->where('tipe_transaksi', 'penjualan')
        ->get();

        if ($report->isEmpty()) {
            // Array kosong, atur sesuai kebutuhan
            $reportData = [];
            return redirect()->back()->with('error', 'Tidak ada transaksi di bulan ini.');

        } else {
            // Array tidak kosong, dapat diakses dengan aman
            $reportData = $report;
            // ... operasi lainnya
        }
        // dd($report);
            return view('pemilik.laporan-keuangan', ['reports'=>$report,
        'month'=>$selectedMonth,
        'year'=>$selectedYear,
        'expenses'=>$expenses,
        'sales'=>$sales
        ]);
    }

    public function display_invoice($id)
    {
        $faktur = InvoiceBuying::find($id);
        $uuid = $faktur->buying_invoice_id;
        $supplier = Supplier::where('supplier',$faktur->supplier_name)->first();
        $numericValue = hexdec(substr($uuid, -5));
        $formatted = 'FR-' . str_pad($numericValue, 6, '0', STR_PAD_LEFT);

        return view('pemilik.invoice-pembelian',[
            'invoice' => $faktur,
            'invoice_number' => $formatted,
            'supplier' => $supplier
        ]);
    }
}