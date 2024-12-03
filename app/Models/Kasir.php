<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;

    protected $table = 'kasir';
    protected $primaryKey = 'cashier_id';
    public $incrementing = false;
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class ,'user_id');
    }
    protected $fillable = [
        'cashier_id',
        'user_id',
        'cashier_phone',
        'cashier_genre',
        'cashier_address',
    ];
}