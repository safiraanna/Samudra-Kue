<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class ShippingAddressController extends Controller
{
    public function create() {
        return view('user.addresses.create');
    }

    public function store(Request $request) {
        $request->validate([
            'province' => 'required',
            'city' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
        ]);

        ShippingAddress::create([
            'province' => $request->province,
            'city' => $request->city,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'userID' => auth()->id(), // Sesuaikan dengan cara Anda menghubungkan alamat dengan user
        ]);

        Alert::success('Berhasil', 'Alamat pengiriman berhasil ditambahkan!');
        return redirect()->route('home');
    }

    public function edit($id) {
        $address = ShippingAddress::findOrFail($id);
        // Sesuaikan dengan view yang Anda inginkan
        return view('user.addresses.edit', compact('address'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'province' => 'required',
            'city' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
        ]);
    
        $userID = auth()->user()->id;
        $address = ShippingAddress::findOrFail($id);
    
        $address->update([
            'userID' => $userID,
            'province' => $request->province,
            'city' => $request->city,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
        ]);
    
        Alert::success('Berhasil', 'Alamat pengiriman berhasil diperbarui!');
        return redirect()->route('addresses.index')->with('success', 'Alamat berhasil diperbarui');
    }    

    public function show(ShippingAddress $shippingAddress) {
        $shippingAddress = ShippingAddress::where('userID', auth()->id())->first();

        return view('user.addresses.index', [
            'active' => 'shipping_address',
            'title' => "Alamat",
            'shippingAddress' => $shippingAddress, // Perhatikan penggunaan 'shippingAddresses' (jamak) bukan 'shippingAddress' (tunggal).
        ]);
    }
}
