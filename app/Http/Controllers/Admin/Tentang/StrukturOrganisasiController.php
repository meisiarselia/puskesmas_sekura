<?php

namespace App\Http\Controllers\Admin\Tentang;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $so = StrukturOrganisasi::first();
        return view('admin.tentang.struktur-organisasi', compact('so'));
    }
    public function update(Request $request)
    {
        // Validasi file gambar
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,avif',
        ]);

        // Cek apakah ada file yang diupload
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/struktur-organisasi');
            $image->move($destinationPath, $name);

            $so = StrukturOrganisasi::first();
            if ($so) {
                // Hapus gambar lama jika ada
                $oldImagePath = public_path($so->nama_gambar);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
                // Simpan path gambar baru
                $so->nama_gambar = '/images/struktur-organisasi/' . $name;
                $so->save();
            }
        }

        return redirect()->back()->with('success', 'Struktur organisasi berhasil diubah!');
    }
}
