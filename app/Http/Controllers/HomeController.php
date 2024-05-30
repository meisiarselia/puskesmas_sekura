<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use App\Models\Fasilitas;
use App\Models\Sertifikat;
use App\Models\LayananMedis;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $lms = LayananMedis::select('nama_icon', 'nama_layanan', 'deskripsi')->get()->random(6);
        $fasilitas = Fasilitas::select('gambar')->get();
        $visimisi = VisiMisi::first();
        $gambar = Sertifikat::first()->gambar;
        return view('index', compact([
            'lms',
            'fasilitas',
            'gambar'
        ]))->with([
            'visi' => $visimisi->visi,
            'misi' => $visimisi->misi,
        ]);
    }
}
