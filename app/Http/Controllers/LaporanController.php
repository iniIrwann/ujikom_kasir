<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
class LaporanController extends Controller
{

    public $produkTerdaftar, $kode;
    public function index(){
        $title = 'Laporan';
        session(['active' => 'laporan']);
        session(['page_title' => 'Laporan']);
        session(['sub_title' => 'Laporan']);
        $semuaTransaksi = Transaksi::where('status', 'selesai')->get();
        return view('laporan', compact('semuaTransaksi','title'));

    }
    public function detail($id){
        $title = 'Laporan Detail';
        $transaksi = DetailTransaksi::where('transaksi_id', $id)->with('product')->get();
        return view('detail_laporan', compact('transaksi','title'));
    }

    public function cetak(){
        $title = 'Laporan';
        $semuaTransaksi = Transaksi::where('status', 'selesai')->with('pelanggan')->get();
        return view('cetak', compact('semuaTransaksi','title'));
    }
    public function cetakdetail($id){
        $title = 'Laporan';
        // $semuaTransaksi = Transaksi::where('status', 'selesai')->with('pelanggan')->get();
        $transaksi = DetailTransaksi::where('transaksi_id', $id)->with('product')->get();
        return view('cetakdetail', compact('transaksi','title'));
    }
}
