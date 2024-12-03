<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceBuying extends Model
{
    use HasFactory;
    protected $table = 'invoice_buying';
    protected $primaryKey = 'buying_invoice_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'buying_invoice_id',
        'order_date',
        'supplier_name',
    ];

    public function invoiceBuyingDetail()
    {
        return $this->hasMany(InvoiceBuyingDetail::class, 'buying_invoice_id');
    }
}
