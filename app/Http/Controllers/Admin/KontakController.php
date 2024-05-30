<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kontak;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::first();
        return view('admin.kontak', compact('kontak'));
    }
    public function update(Request $request)
    {
        // Validasi file gambar
        $request->validate([
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_tlp' => 'required|string|max:15',
        ]);
        $kontak = Kontak::first(); // Asumsikan hanya ada satu kontak yang akan diedit
        $kontak->alamat = $request->input('alamat');
        $kontak->email = $request->input('email');
        $kontak->no_tlp = $request->input('no_tlp');
        $kontak->save();
        return redirect()->back()->with('success', 'Kontak berhasil diperbarui!');
    }
}
