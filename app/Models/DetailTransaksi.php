<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;
use App\Models\Product;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaksi_id',
        'product_id',
        'jumlah',
        'sub_total_per_item',
    ];
    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }

}
