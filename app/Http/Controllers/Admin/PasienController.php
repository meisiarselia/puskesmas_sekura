<?php

namespace App\Http\Controllers\Admin;

use App\Alice;
use App\Models\Pasien;
use App\Mail\ValidasiMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PasienController extends Controller
{
    public function index()
    {
        $data = collect(
            array_merge(
                Pasien::whereNull('validated_at')
                    ->orderBy('nama', 'asc')
                    ->get()
                    ->toArray(),
                Pasien::whereNotNull('validated_at')
                    ->orderBy('is_valid', 'desc')
                    ->orderBy('nama', 'asc')
                    ->get()->toArray()
            )
        );
        $pasiens = $data->map(function ($item) {
            $item['agama'] = Alice::$agama[$item['agama']];
            $item['jenkel'] = Alice::$jenkel[$item['jenkel']];
            return (object) $item;
        });
        // dd($data);
        return view('admin.pasien.index', compact('pasiens'));
    }
    public function validatePasien(Request $request, Pasien $pasien)
    {
        try {
            DB::beginTransaction();
            $is_valid = $request->is_valid == 'Validate';
            $pasien->is_valid = $is_valid;
            $pasien->validated_at = now();
            $pasien->save();
            Mail::to($pasien->email)->send(new ValidasiMail($pasien, $is_valid));
            DB::commit();
            return back()->with('success', 'Data pasien berhasil divalidasi!');
        } catch (\Throwable $th) {
            return back()->with('fails', $th->getMessage());
        }

    }
    public function create(Pasien $pasien = null)
    {
        return view('admin.pasien.create', compact('pasien'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate($this->getRules($request->email));
        try {
            $validated['dokumen'] = $this->saveImage($request->file('file'));
            $validated['is_valid'] = true;
            $validated['validated_at'] = now();
            Pasien::create($validated);
            return redirect(route('pasien.index'))
                ->with('success', 'Data pasien berhasil ditambah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function update(Request $request, Pasien $pasien)
    {
        $request->validate($this->getRules($request->email, true, $pasien->id));
        try {
            if ($request->hasFile('file')) {
                $this->deleteImage($pasien->dokumen);
                $pasien->dokumen = $this->saveImage($request->file('file'));
            }
            if ($request->filled('is_valid')) {
                $pasien->is_valid = $request->is_valid;
                $pasien->validated_at = now();
            }
            $pasien->nik = $request->nik;
            $pasien->no_kk = $request->no_kk;
            $pasien->nama = $request->nama;
            $pasien->tgl_lahir = $request->tgl_lahir;
            $pasien->jenkel = $request->jenkel;
            $pasien->agama = $request->agama;
            $pasien->no_tlp = $request->no_tlp;
            $pasien->alamat = $request->alamat;
            $pasien->email = $request->email;
            $pasien->save();
            return redirect(route('pasien.index'))
                ->with('success', 'Data pasien berhasil diubah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function delete(Pasien $pasien)
    {
        try {
            $gambar = $pasien->dokumen;
            if ($pasien->delete())
                $this->deleteImage($gambar);
            return back()->with('success', 'Data pasien berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }

    protected function getRules($email, $isUpdate = false, $pasien_id = null)
    {
        $unique = Rule::unique('pasiens', 'nik')->where(function ($query) {
            return $query->where('is_valid', true);
        });

        if ($isUpdate)
            $unique->ignore($pasien_id);

        $rules = [
            'nik' => [
                'required',
                'numeric',
                'digits:16',
                $unique
            ],
            'no_kk' => 'required|numeric|digits:16',
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jenkel' => 'required|in:1,2',
            'agama' => 'required|numeric|between:1,6', // Validasi untuk Agama
            'no_tlp' => 'required|string|max:20', // Validasi untuk Nomor Telepon
            'alamat' => 'required|string|max:255', // Validasi untuk Alamat
            'email' => 'required|max:255|email', // Validasi untuk Email
            'file' => ($isUpdate ? 'nullable' : 'required') . '|image|mimes:jpeg,png,jpg,gif,svg,webp,avif',
        ];
        return $rules;
    }
    protected function saveImage($file)
    {
        $directory = 'pasien';
        if (!Storage::disk('private')->exists('/')) {
            Storage::disk('private')->makeDirectory('/');
        }
        if (!Storage::disk('private')->exists($directory)) {
            Storage::disk('private')->makeDirectory($directory);
        }

        $uuid = Str::uuid()->toString();
        $extension = $file->getClientOriginalExtension();
        $filename = $uuid . '.' . $extension;
        return $file->storeAs($directory, $filename, 'private');
    }
    protected function deleteImage($filename)
    {
        if (Storage::disk('private')->exists($filename))
            Storage::disk('private')->delete($filename);
    }
}
