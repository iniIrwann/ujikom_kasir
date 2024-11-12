<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailTransaksi;
class Transaksi extends Model
{
    protected $fillable = [
        'KodePelanggan',
        'kode',
        'total_harga',
        'sub_total',
        'bayar',
        'kembalian',
        'biaya_admin',
        'discount',
        'status',
    ];
    public function detailTransaksi(){
        return $this->hasMany(DetailTransaksi::class);
    }
    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'KodePelanggan', 'KodePelanggan' );
    }
}
