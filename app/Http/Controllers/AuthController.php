<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{   
    use AuthenticatesUsers;
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
    public function index(){
        return view('Auth.login');
    }

    public function registrasi(){
        return view('Auth.registrasi');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Email belum terdaftar, silahkan registrasi');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/home')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function store(Request $request)
    {   
        // dd($request);
        $request->validate([
            'username' => 'required|max:100|min:3',
            'name' => 'required|max:100|min:3',
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        $response = Http::post('http://test-horus.test:8080/api/users', [
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

       
        if ($response->successful()) {
            return redirect('/login')->with('success', 'Akun berhasil ditambahkan, Silahkan login!');
        } else {
            $errors = $response->json()['error'] ?? [];
            return redirect()->back()->with('error', $errors['message'] ?? 'Gagal menambahkan akun. Silakan coba lagi.')->withErrors($errors)->withInput();
        }
        
    }
}
