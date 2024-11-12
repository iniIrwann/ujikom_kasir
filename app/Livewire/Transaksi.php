<?php

namespace App\Livewire;

use App\Models\DetailTransaksi;
use App\Models\Product;
use App\Models\Pelanggan;
use App\Models\Transaksi as ModelsTransaksi;
use Livewire\Component;

class Transaksi extends Component
{
    public $kode, $total_harga, $kembalian, $subtotalbelanja, $biaya_admin, $discount, $totalbelanja;
    public $bayar = 0;
    public $transaksiAktif;
    public $nama_produk;
    public $sub_total_per_item = 0;
    public $NamaPelanggan = '';
    public $kodepelanggan;
    public $produkTerdaftar = [];
    public $pelangganTerdaftar = [];

    public function transaksiBaru()
    {
        // Logika untuk membuat transaksi baru
        $this->reset();
        $this->transaksiAktif = new ModelsTransaksi();
        $this->transaksiAktif->kode = 'INV/' . date('YmdHis');
        $this->transaksiAktif->total_harga = 0;
        $this->transaksiAktif->sub_total = 0;
        $this->transaksiAktif->status = 'pending';
        $this->transaksiAktif->save();
    }

    public function hapusProduk($id)
    {
        $detail = DetailTransaksi::find($id); // Seleksi produk
        if ($detail) {
            $produk = Product::find($detail->product->id); // Mencari produk berdasarkan ID
            $produk->stok += $detail->jumlah; // Menambah kembali stok produk
            $produk->save();
        }
        $detail->delete();
    }

    public function selesaiTransaksi()
    {
        $this->validate([
            'kodepelanggan' => 'required',
        ]);


        if (!$this->NamaPelanggan) {
            session()->flash('error', 'Pilih pelanggan sebelum melanjutkan pembelian.');
            return;
        }
        $this->transaksiAktif->KodePelanggan = $this->kodepelanggan; // kode pembeli dari input
        $this->transaksiAktif->kembalian = $this->kembalian; // Mengambil nilai kembalian
        $this->transaksiAktif->bayar = $this->bayar; // Menyimpan nilai bayar
        $this->transaksiAktif->total_harga = $this->totalbelanja; // Total harga
        $this->transaksiAktif->sub_total = $this->subtotalbelanja; // Total harga
        $this->transaksiAktif->biaya_admin = $this->biaya_admin; // Biaya admin
        $this->transaksiAktif->discount = $this->discount; // Diskon
        $this->transaksiAktif->status = 'selesai'; // Status transaksi
        $this->transaksiAktif->save();
        $this->reset(); // Reset semua data
    }

    public function updatedBayar()
    {
        if ($this->bayar > 0) {
            $this->kembalian = $this->bayar - $this->totalbelanja;
        }
    }

    public function batalTransaksi()
    {
        if ($this->transaksiAktif) {
            $detailTransaksi = DetailTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            foreach ($detailTransaksi as $detail) {
                $produk = Product::find($detail->product->id); // Mencari produk berdasarkan ID
                $produk->stok += $detail->jumlah; // Menambah kembali stok produk
                $produk->save();
                $detail->delete();
            }
            $this->transaksiAktif->delete();
        }
        $this->reset(); // Reset semua data
    }

    public function updatedNamaPelanggan()
    {
        // Mencari pelanggan berdasarkan nama yang diinput
        $this->pelangganTerdaftar = Pelanggan::where('NamaPelanggan', 'like', '%' . $this->NamaPelanggan . '%')->get();
    }

    public function selectPelanggan($id)
    {
        $pelanggan = Pelanggan::find($id);
        if ($pelanggan) {
            $this->NamaPelanggan = $pelanggan->NamaPelanggan; //jika ingin mengambil nama pelanggan
            $this->kodepelanggan = $pelanggan->KodePelanggan; //mengambil kode pelanggan
            $this->pelangganTerdaftar = []; // Kosongkan daftar pelanggan setelah memilih
        }
    }

    public function updatedNamaProduk()
    {
        // Mencari produk berdasarkan nama yang diinput
        $this->produkTerdaftar = Product::where('nama_produk', 'like', '%' . $this->nama_produk . '%')->get();
    }

    public function selectProduct($productId)
    {
        $produk = Product::find($productId);
        if (!$produk || $produk->stok <= 0) {
            session()->flash('error', 'Produk tidak tersedia atau stok habis.');
            return; // Menyudahi eksekusi jika produk tidak tersedia
        }
        if ($produk && $produk->stok > 0) {
            // Menambahkan produk ke detail transaksi
            $detail = DetailTransaksi::firstOrNew([
                'transaksi_id' => $this->transaksiAktif->id,
                'product_id' => $produk->id,
            ], [
                'jumlah' => 0
            ]);

            $hargaproduk = $produk->harga;
            $detail->jumlah += 1; // Menambah jumlah produk
            $detail->sub_total_per_item = $hargaproduk * $detail->jumlah; // Menambah jumlah produk
            $detail->save(); // Simpan detail transaksi
            $produk->stok -= 1; // Mengurangi stok yang ada di tabel produk
            $produk->save();
            $this->produkTerdaftar = []; // Kosongkan daftar product setelah memilih
        }
    }

    public function render()
    {
        session(['active' => 'transaksi']);
        session(['page_title' => 'Transaksi']);
        session(['sub_title' => 'Transaksi']);

        if ($this->transaksiAktif) {
            $semuaProduk = DetailTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();

            $this->subtotalbelanja = $semuaProduk->sum(function ($detail) {
                return $detail->product->harga * $detail->jumlah;
            });
            $this->biaya_admin = max(0, $this->subtotalbelanja * 0.005); // 0.5% dari subtotalbelanja
            $this->discount = max(0, $this->subtotalbelanja * 0.01); // 1% dari subtotalbelanja
            $this->totalbelanja = max(0, $this->subtotalbelanja + $this->biaya_admin - $this->discount); // Total belanja
        } else {
            $semuaProduk = [];
            $this->subtotalbelanja = 0;
            $this->biaya_admin = 0;
            $this->discount = 0;
            $this->totalbelanja = 0;
        }

        return view('livewire.transaksi', compact('semuaProduk'));
    }
}
