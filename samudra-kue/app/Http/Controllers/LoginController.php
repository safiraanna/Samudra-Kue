<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
    
            if ($user->role === 1) {
                Alert::success('Congrats', 'You\'ve Successfully Logged In as Admin');
                return redirect()->route('dashboard'); // Admin diarahkan ke '/dashboard'
            }
    
            Alert::success('Congrats', 'You\'ve Successfully Logged In');
            return redirect()->route('home');// Pengguna biasa diarahkan ke '/home'
        }
    
        Alert::error('Login Failed', 'Invalid Credentials');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken(); 

        return redirect('/');
    }
}
