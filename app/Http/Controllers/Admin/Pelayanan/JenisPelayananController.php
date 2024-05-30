<?php

namespace App\Http\Controllers\Admin\Pelayanan;

use App\Http\Controllers\Controller;
use App\Models\LayananMedis;
use Illuminate\Http\Request;

class JenisPelayananController extends Controller
{
    protected $rules = [
        'nama_icon' => 'required|string|max:255',
        'nama_layanan' => 'required|string|max:255',
        'deskripsi' => 'required|string'
    ];

    public function index()
    {
        $jenis_pelayanans = LayananMedis::all();
        return view('admin.pelayanan.jenis-pelayanan.index', compact('jenis_pelayanans'));
    }
    public function create(LayananMedis $jenis_pelayanan = null)
    {
        return view('admin.pelayanan.jenis-pelayanan.create', compact('jenis_pelayanan'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        try {
            LayananMedis::create($validated);
            return redirect(route('jenis-pelayanan.index'))->with('success', 'Layanan medis berhasil ditambah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function update(Request $request, LayananMedis $jenis_pelayanan)
    {
        $request->validate($this->rules);
        try {
            $jenis_pelayanan->nama_layanan = $request->nama_layanan;
            $jenis_pelayanan->nama_icon = $request->nama_icon;
            $jenis_pelayanan->deskripsi = $request->deskripsi;
            $jenis_pelayanan->save();
            return redirect(route('jenis-pelayanan.index'))->with('success', 'Layanan medis berhasil diubah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function delete(LayananMedis $jenis_pelayanan)
    {
        try {
            $jenis_pelayanan->delete();
            return redirect(route('jenis-pelayanan.index'))->with('success', 'jenis-pelayanan berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
}
