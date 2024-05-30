<?php

namespace App\Http\Controllers\Admin\Tentang;

use App\Models\Kegiatan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class KegiatanController extends Controller
{

    public function index()
    {
        $kegiatans = Kegiatan::all();
        return view('admin.tentang.kegiatan.index', compact('kegiatans'));
    }
    public function create(kegiatan $kegiatan = null)
    {
        return view('admin.tentang.kegiatan.create', compact('kegiatan'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate($this->getRules());
        try {
            if ($request->hasFile('file'))
                $validated['gambar'] = $this->saveImage($request->file('file'));
            Kegiatan::create($validated);
            return redirect(route('kegiatan.index'))->with('success', 'Kegiatan berhasil ditambah');
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function update(Request $request, kegiatan $kegiatan)
    {
        $request->validate($this->getRules(true));
        try {
            if ($request->hasFile('file')) {
                $old = public_path($kegiatan->gambar);
                if (File::exists($old))
                    File::delete($old);
                $kegiatan->gambar = $this->saveImage($request->file('file'));
            }
            $kegiatan->judul = $request->judul;
            $kegiatan->save();
            return redirect(route('kegiatan.index'))->with('success', 'kegiatan berhasil diubah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function delete(kegiatan $kegiatan)
    {
        try {
            $old = public_path($kegiatan->gambar);
            if (File::exists($old)) File::delete($old);
            $kegiatan->delete();
            return redirect(route('kegiatan.index'))->with('success', 'kegiatan berhasil dihapus');
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
        $destinationPath = public_path('/images/kegiatan');
        $file->move($destinationPath, $name);
        return '/images/kegiatan/' . $name;
    }
}
