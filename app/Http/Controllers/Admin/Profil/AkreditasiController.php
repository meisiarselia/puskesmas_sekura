<?php

namespace App\Http\Controllers\Admin\Profil;

use App\Models\Sertifikat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AkreditasiController extends Controller
{

    public function index()
    {
        $gambar = Sertifikat::first()->gambar;
        return view('admin.profil.akreditasi', compact('gambar'));
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
            $destinationPath = public_path('/images/akreditasi');
            $image->move($destinationPath, $name);

            $so = Sertifikat::first();
            if ($so) {
                // Hapus gambar lama jika ada
                $oldImagePath = public_path($so->gambar);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
                // Simpan path gambar baru
                $so->gambar = '/images/akreditasi/' . $name;
                $so->save();
            }
        }

        return redirect()->back()->with('success', 'Sertifikat akreditasi berhasil diubah!');
    }
}
