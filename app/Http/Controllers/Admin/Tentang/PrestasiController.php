<?php

namespace App\Http\Controllers\Admin\Tentang;

use App\Models\Prestasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = Prestasi::all();
        return view('admin.tentang.prestasi.index', compact('prestasis'));
    }
    public function create(Prestasi $prestasi = null)
    {
        return view('admin.tentang.prestasi.create', compact('prestasi'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate($this->getRules());
        try {
            if ($request->hasFile('file'))
                $validated['nama_gambar'] = $this->saveImage($request->file('file'));

            Prestasi::create($validated);
            return redirect(route('prestasi.index'))->with('success', 'Prestasi berhasil ditambah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function update(Request $request, Prestasi $prestasi)
    {
        $request->validate($this->getRules(true));
        try {
            if ($request->hasFile('file')) {
                $old = public_path($prestasi->nama_gambar);
                if (File::exists($old))
                    File::delete($old);
                $prestasi->nama_gambar = $this->saveImage($request->file('file'));
            }
            $prestasi->nama_prestasi = $request->nama_prestasi;
            $prestasi->save();
            return redirect(route('prestasi.index'))->with('success', 'Prestasi berhasil diubah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function delete(Prestasi $prestasi)
    {
        try {
            $prestasi->delete();
            return redirect(route('prestasi.index'))->with('success', 'Prestasi berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    protected function getRules($isUpdate = false)
    {
        return [
            'judul' => 'required|max:255',
            'file' => ($isUpdate ? 'nullable' : 'required') . '|image|mimes:jpeg,png,jpg,gif,svg,webp,avif',
        ];
    }
    protected function saveImage($file)
    {
        $name = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('/images/prestasi');
        $file->move($destinationPath, $name);
        return '/images/prestasi/' . $name;
    }
}
