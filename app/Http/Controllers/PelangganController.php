<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Tabel Pelanggan';
        session(['active' => 'table_pelanggan']);
        session(['page_title' => 'Tabel Pelanggan']);
        session(['sub_title' => 'Tabel Pelanggan']);
        $Pelanggan = Pelanggan::latest()->paginate(10);
        // if ($request->ajax()) {
        //     $data = user::select('*');
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->make(true);
        // }
        return view('pelanggan.index', compact(['Pelanggan','title']));
    }

    public function create()
    {
        $title = "Pelanggan";
        session(['active' => 'table_pelanggan']);
        session(['page_title' => 'Tabel Pelanggan / Tambah Data']);
        session(['sub_title' => 'Tambah Data']);
        return view('pelanggan.create',compact(['title']));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'KodePelanggan' => 'required|max:10',
            'NamaPelanggan' => 'required',
            'Alamat' => 'required|max:50',
            'NomorTelepon' => 'required|max:15',
        ]);

        // Menghindari duplikat data
        $existingpelanggan = Pelanggan::where('KodePelanggan', $validatedData['KodePelanggan'])->first();
        if ($existingpelanggan) {
            return redirect()->back()->with('failed', 'Kode Pelanggan sudah ada!');
        }

        Pelanggan::create([
            'KodePelanggan' => $validatedData['KodePelanggan'],
            'NamaPelanggan' => $validatedData['NamaPelanggan'],
            'Alamat' => $validatedData['Alamat'],
            'NomorTelepon' => $validatedData['NomorTelepon'],
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Berhasil Menambahkan Pelanggan');
    }


    public function edit($id)
    {
        $title = 'Edit Pelanggan';
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact(['pelanggan','title']));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'NamaPelanggan' => 'required',
            'Alamat' => 'required|max:50',
            'NomorTelepon' => 'required|max:15'
        ]);

        //duplikat data
        $duplikatdata = Pelanggan::where('KodePelanggan', $request['KodePelanggan'])
        ->where('id', '!=', $id) // Mengecualikan ID produk yang sedang diupdate
        ->first();

        //  // Menghindari duplikat data
        //  $existingpelanggan = Pelanggan::where('KodePelanggan', $request['KodePelanggan'])->first();
        //  if ($existingpelanggan) {
        //      return redirect()->back()->with('error', 'Kode Pelanggan sudah ada!');
        //  }

        // Ambil data pelanggan yang ingin diubah
        $pelanggan = Pelanggan::findOrFail($id);

        $data = [
            'NamaPelanggan' => $request->NamaPelanggan,
            'Alamat' => $request->Alamat,
            'NomorTelepon' => $request->NomorTelepon,
        ];

        $pelanggan->update($data);
        return redirect()->route('pelanggan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function destroy($id)
    {
        $user = Pelanggan::findOrFail($id);

        $user->delete();
        return redirect()->route('pelanggan.index')->with(['success' => 'Data Berhasil Dihapus']);
    }}
