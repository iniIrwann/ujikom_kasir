<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TabelUser extends Controller
{
    public function index(Request $request)
    {
        $title = 'Tabel User';
        session(['active' => 'table_user']);
        session(['page_title' => 'Tabel User']);
        session(['sub_title' => 'Tabel User']);
        $users = User::latest()->paginate(10);
        if (Auth::user()->role != 'administator'){
            abort(403);
        }
        return view('user.index', compact(['users','title']));
    }

    public function create()
    {
        $title = "Create User";
        session(['active' => 'table_user']);
        session(['page_title' => 'Tabel User / Tambah Data']);
        session(['sub_title' => 'Tambah Data']);
        return view('user.create', compact('title'));
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:3'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['role'] = $request->role;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('user.index')->with(['success' => 'Berhasil membuat akun !']);
    }

    public function edit($id)
    {
        $title = 'Edit User';
        $user = User::findOrFail($id);
        return view('user.edit', compact(['user','title']));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'password' => 'nullable|min:3'
        ]);

        // Ambil data user yang ingin diubah
        $user = User::findOrFail($id);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
