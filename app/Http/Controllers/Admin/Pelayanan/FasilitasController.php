<?php

namespace App\Http\Controllers\Admin\Pelayanan;

use App\Models\Fasilitas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class FasilitasController extends Controller
{

    public function index()
    {
        $fasilitass = Fasilitas::all();
        return view('admin.pelayanan.fasilitas.index', compact('fasilitass'));
    }
    public function create(Fasilitas $fasilitas = null)
    {
        return view('admin.pelayanan.fasilitas.create', compact('fasilitas'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate($this->getRules());
        try {
            if ($request->hasFile('file'))
                $validated['gambar'] = $this->saveImage($request->file('file'));
            Fasilitas::create($validated);
            return redirect(route('fasilitas.index'))->with('success', 'Fasilitas berhasil ditambah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function update(Request $request, fasilitas $fasilitas)
    {
        $request->validate($this->getRules(true));
        try {
            if ($request->hasFile('file')) {
                $old = public_path($fasilitas->gambar);
                if (File::exists($old))
                    File::delete($old);
                $fasilitas->gambar = $this->saveImage($request->file('file'));
            }
            $fasilitas->nama = $request->nama;
            $fasilitas->deskripsi = $request->deskripsi;
            $fasilitas->save();
            return redirect(route('fasilitas.index'))->with('success', 'fasilitas berhasil diubah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function delete(fasilitas $fasilitas)
    {
        try {
            $old = public_path($fasilitas->gambar);
            if (File::exists($old))
                File::delete($old);
            $fasilitas->delete();
            return redirect(route('fasilitas.index'))->with('success', 'fasilitas berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    protected function getRules($isUpdate = false)
    {
        return [
            'nama' => 'required|max:255',
            'file' => ($isUpdate ? 'nullable' : 'required') . '|image|mimes:jpeg,png,jpg,gif,svg,webp,avif',
            'deskripsi' => 'required',
        ];
    }
    protected function saveImage($file)
    {
        $name = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('/images/fasilitas');
        $file->move($destinationPath, $name);
        return '/images/fasilitas/' . $name;
    }
}
