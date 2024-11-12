<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TabelBarang extends Controller
{
    public function index(Request $request)
    {
        $title = 'Tabel Barang';
        session(['active' => 'table_barang']);
        session(['page_title' => 'Tabel Barang']);
        session(['sub_title' => 'Tabel Barang']);
        $products = Product::latest()->paginate(10);
        // if ($request->ajax()) {
        //     $data = Product::select('*');
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->make(true);
        // }
        return view('product.index', compact(['products','title']));
    }

    public function create()
    {
        $title = 'Tambah Data';
        session(['active' => 'table_barang']);
        session(['page_title' => 'Tabel Barang / Tambah Data']);
        session(['sub_title' =>  'Tambah Data']);
        return view('product.create',compact(['title']));
    }

    public function store(Request $request): RedirectResponse
    {

        $validatedData = $request->validate([
            'nama_produk' => 'required',
            'merk' => 'required',
            'kategori' => 'required',
            'harga' => 'required|integer|min:0|max:100000000',
            'stok' => 'required|integer|min:0',
        ]);
        //menghindari duplikat data
        $duplikatdata = Product::where('nama_produk', $validatedData['nama_produk'])
        ->where('merk', $validatedData['merk'])
        ->first();
        if ($duplikatdata) {
            return redirect()->back()->with('failed', 'Produk sudah ada!');
        }

        Product::create([
            'nama_produk' => $request->nama_produk,
            'merk' => $request->merk,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
        return redirect()->route('product.index')->with(['success' => 'Berhasil Membuat Product!']);    }

    public function edit($id)
    {
        $title = "Edit Barang";
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'merk' => 'required',
            'kategori' => 'required',
            'harga' => 'required|integer|min:0|max:100000000',
            'stok' => 'required|integer|min:0'
        ]);

        //duplikat data
        $duplikatdata = Product::where('nama_produk', $request['nama_produk'])
        ->where('merk', $request['merk'])
        ->where('id', '!=', $id) // Mengecualikan ID produk yang sedang diupdate
        ->first();

        if ($duplikatdata) {
            return redirect()->back()->with('failed', 'Produk sudah ada!');
        }
        $product = Product::findOrFail($id);

        $product->update([
            'nama_produk' => $request->nama_produk,
            'merk' => $request->merk,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
        return redirect()->route('product.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
        return redirect()->route('product.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
