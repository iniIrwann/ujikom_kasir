<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Transaksi;

class Dashboard extends Controller
{
    public function dashboard()
    {
        $title = "Dashboard";
        $totalProducts = Product::count();
        $totalpelanggan = Pelanggan::count();
        $totalTransaksi = Transaksi::where('status', 'selesai')->count();
        $totalTransaksipe = Transaksi::where('status', 'pending')->count();
        $salesData = Transaksi::selectRaw('MONTH(created_at) as month, SUM(total_harga) as total')
                      ->groupBy('month')
                      ->orderBy('month')
                      ->pluck('total', 'month');
                      if ($salesData->isEmpty()) {
                        $salesData = [];
                    }

        session(['active' => 'dashboard']);
        session(['page_title' => 'Dashboard']);
        session(['sub_title' => 'Dashboard']);
        return view('dashboard', compact(['title', 'totalProducts','totalpelanggan','totalTransaksi','totalTransaksipe','salesData'])); // Ganti dengan nama view Anda
    }
}
