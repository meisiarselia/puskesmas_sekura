<?php

namespace App\Http\Controllers\Admin;

use App\Models\Poli;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PoliController extends Controller
{
    protected $rules = [
        'nama_poli' => 'required|max:255',
    ];
    public function index()
    {
        $polis = Poli::all();
        return view('admin.poli.index', compact('polis'));
    }
    public function create(Poli $poli = null)
    {
        return view('admin.poli.create', compact('poli'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        try {
            Poli::create($validated);
            return redirect(route('poli.index'))->with('success', 'Data poli berhasil ditambah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function update(Request $request, Poli $poli)
    {
        $request->validate($this->rules);
        try {
            $poli->nama_poli = $request->nama_poli;
            $poli->save();
            return redirect(route('poli.index'))->with('success', 'Data poli berhasil diubah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function delete(Poli $poli)
    {
        try {
            $poli->delete();
            return redirect(route('poli.index'))->with('success', 'Data poli berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
}
