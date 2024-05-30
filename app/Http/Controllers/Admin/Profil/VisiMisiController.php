<?php

namespace App\Http\Controllers\Admin\Profil;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visi_misi = VisiMisi::first();
        return view('admin.profil.visi-misi', compact('visi_misi'));
    }
    public function update(Request $request)
    {
        // Validasi file gambar
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);
        $visi_misi = VisiMisi::first();
        $visi_misi->visi = $request->visi;
        $visi_misi->misi = $request->misi;
        $visi_misi->save();
        return redirect()->back()->with('success', 'Visi Misi berhasil diperbarui!');
    }
}
