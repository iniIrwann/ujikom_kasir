<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'Login';
        return view('auth.login', compact('title'));
    }

    // public function login_proses(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);
    //     $user = User::where('email', $request->email)->first();
    //     if ($user && $user->password === $request->password) {
    //         Auth::attempt($user);
    //         return redirect()->route('dashboard')->with('success', 'Login Success.');
    //     } else {
    //         return redirect()->back()->with('failed', 'Email atau password salah.');
    //     }
    // }

    public function login_proses(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->passes()){
            if(Auth::attempt(
                ['email' => $request->email, 'password' => $request->password]
            )) {
                return redirect()->route('dashboard')->with('success','Login Berhasil !');
            } else {
                return redirect()->route('login')->with('error', 'Email Dan Password Salah');
            }
        } else {
            return redirect()->route('login')
            ->withInput()
            ->withErrors($validator);
        }
    }

    public function logout()
    {
        // dd('oke');
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu berhasil Logout');
    }

    public function register(){
        $title = 'Register';
        return view('auth.register', compact('title'));
    }

    public function register_proses(Request $request){
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

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
    }

}
