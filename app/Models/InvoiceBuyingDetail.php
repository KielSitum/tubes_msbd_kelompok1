<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceBuyingDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'buying_detail_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'buying_detail_id',
        'buying_invoice_id',
        'product_name',
        'product_buy_price',
        'exp_date',
        'quantity',
    ];

    public function invoiceBuying()
    {
        return $this->belongsTo(InvoiceBuying::class, 'buying_invoice_id');
    }
}
