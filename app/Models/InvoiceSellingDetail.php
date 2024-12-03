<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSellingDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'selling_detail_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'selling_detail_id',
        'selling_invoice_id',
        'product_name',
        'product_sell_price',
        'quantity',
    ];

    public function invoiceSelling()
    {
        return $this->belongsTo(InvoiceSelling::class, 'selling_invoice_id');
    }
}
