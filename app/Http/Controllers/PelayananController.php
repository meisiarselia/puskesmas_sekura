<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\KritikSaran;
use App\Models\LayananMedis;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    public function jenisPelayanan()
    {
        $lms = LayananMedis::select('id', 'nama_icon', 'nama_layanan')->get();
        return view("pelayanan.jenis-pelayanan", compact('lms'));
    }
    public function jenisPelayananShow(LayananMedis $layananMedis)
    {
        return view("pelayanan.jenis-pelayanan-show", compact('layananMedis'));

    }
    public function fasilitas()
    {
        $fasilitass = Fasilitas::select('id', 'nama', 'gambar')->get();
        return view("pelayanan.fasilitas", compact('fasilitass'));
    }
    public function fasilitasShow(Fasilitas $fasilitas)
    {
        return view("pelayanan.fasilitas-show", compact('fasilitas'));
    }
    public function kritikSaran()
    {
        return view("pelayanan.kritik-saran");
    }
    public function kritikSaranCreate(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'topik' => 'required|max:255',
            'pesan' => 'required|max:255',
            'email' => 'required|email|max:255',
            'no_tlp' => 'required|max:255',
        ]);
        try {
            KritikSaran::create($validated);
            return back()->with('success', 'Kritik dan saran berhasil dikirim!');
        } catch (\Exception $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
}
