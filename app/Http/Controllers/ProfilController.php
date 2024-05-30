<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function visiMisi()
    {
        $visimisi = VisiMisi::first();
        return view('profil.visi-misi')->with([
            'visi' => $visimisi->visi,
            'misi' => $visimisi->misi,
        ]);
    }
    public function akreditasi()
    {
        $gambar = Sertifikat::first()->gambar;
        return view("profil.akreditasi", compact("gambar"));
    }
}
