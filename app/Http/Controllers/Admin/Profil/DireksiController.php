<?php

namespace App\Http\Controllers\Admin\Profil;

use App\Http\Controllers\Controller;
use App\Models\Direksi;
use Illuminate\Http\Request;

class DireksiController extends Controller
{
    protected $rules = [
        'jabatan' => 'required|string|max:255',
        'nama' => 'required|string|max:255',
        'jabatan_type' => 'required|in:TU,UKM'
    ];

    public function index()
    {
        $direksis = Direksi::all();
        return view('admin.profil.direksi.index', compact('direksis'));
    }
    public function create(Direksi $direksi = null)
    {
        return view('admin.profil.direksi.create', compact('direksi'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        try {
            Direksi::create($validated);
            return redirect(route('direksi.index'))->with('success', 'Direksi berhasil ditambah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function update(Request $request, Direksi $direksi)
    {
        $request->validate($this->rules);
        try {
            $direksi->jabatan = $request->jabatan;
            $direksi->nama = $request->nama;
            $direksi->jabatan_type = $request->jabatan_type;
            $direksi->save();
            return redirect(route('direksi.index'))->with('success', 'Direksi berhasil diubah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function delete(Direksi $direksi)
    {
        try {
            $direksi->delete();
            return redirect(route('direksi.index'))->with('success', 'Direksi berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
}
