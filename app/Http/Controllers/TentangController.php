<?php

namespace App\Http\Controllers;

use App\Models\Direksi;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;

class TentangController extends Controller
{
    public function index()
    {
        return view("tentang.index");
    }
    public function strukturOrganisasi()
    {
        $nama_gambar = '';
        if ($so = StrukturOrganisasi::first())
            $nama_gambar = $so->nama_gambar;
        $tus = Direksi::where('jabatan_type', 'TU')->get();
        $ukms = Direksi::where('jabatan_type', 'UKM')->get();
        return view("tentang.struktur-organisasi", compact(["nama_gambar", "tus", "ukms"]));
    }
    public function kegiatan()
    {
        $kegiatans = Kegiatan::all();
        return view("tentang.kegiatan")->with(compact('kegiatans'));
    }
    public function prestasi()
    {
        $prestasis = Prestasi::all();
        return view("tentang.prestasi", compact('prestasis'));
    }
}
