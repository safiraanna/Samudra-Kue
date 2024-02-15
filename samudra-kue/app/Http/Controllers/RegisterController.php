<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {
    public function index() {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register',
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate(
            [
                'full_name' => 'required|max:255',
                'username' => ['required', 'min:1', 'max:50', 'unique:users'],
                'phone_number' => ['required', 'numeric', 'min:12','unique:users'],
                'password' => ['required', 'min:6', 'max:12']  
            ]
        );

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);
        
        auth()->login($user);
        
        Alert::success('Berhasil', 'Anda akan diarahkan ke halaman alamat. Mohon lengkapi alamat anda');
        return redirect('/addresses/create');
    }
}
