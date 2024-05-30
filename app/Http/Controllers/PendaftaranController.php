<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Poli;
use Ramsey\Uuid\Uuid;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Support\Str;
use App\Mail\RegistrasiMail;
use Illuminate\Http\Request;
use App\Mail\PendaftaranMail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('pendaftaran.index');
    }
    public function registrasi()
    {
        return view('pendaftaran.registrasi');
    }
    public function registrasiProses(Request $request)
    {
        $validated = $request->validate([
            'nik' => [
                'required',
                'numeric',
                'digits:16',
                Rule::unique('pasiens', 'nik')->where(function ($query) {
                    return $query->where('is_valid', true);
                })
            ],
            'no_kk' => 'required|numeric|digits:16',
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jenkel' => 'required|in:1,2',
            'agama' => 'required|between:1,6', // Validasi untuk Agama
            'no_tlp' => 'required|string|max:20', // Validasi untuk Nomor Telepon
            'alamat' => 'required|string|max:255', // Validasi untuk Alamat
            'email' => 'required|email|max:255',
            'file' => 'required|image|mimes:jpeg,png,jpg,svg,webp,avif',
        ]);
        try {
            if ($request->hasFile('file')) {
                // Tentukan path direktori
                $directory = 'pasien';

                //    // Cek dan buat direktori 'private' jika belum ada
                if (!Storage::disk('private')->exists('/')) {
                    Storage::disk('private')->makeDirectory('/');
                }

                // Cek dan buat direktori 'private/pasien' jika belum ada
                if (!Storage::disk('private')->exists($directory)) {
                    Storage::disk('private')->makeDirectory($directory);
                }

                // Simpan file dengan nama UUID
                $file = $request->file('file');
                $uuid = Str::uuid()->toString();
                $extension = $file->getClientOriginalExtension();
                $filename = $uuid . '.' . $extension;
                $path = $file->storeAs($directory, $filename, 'private');
            }
            $validated['dokumen'] = $path;
            DB::beginTransaction();
            $pasien = Pasien::create($validated);
            Mail::to($pasien->email)->send(new RegistrasiMail($pasien));
            DB::commit();
            return redirect(route('pendaftaranonline.berhasil', [
                'from' => 'registrasi',
                'id' => $pasien->id
            ]));
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function daftar()
    {
        $polis = Poli::select('id', 'nama_poli')->orderBy('nama_poli')->get();
        return view('pendaftaran.daftar', compact('polis'));
    }

    public function daftarProses(Request $request)
    {
        $validated = $request->validate([
            'nik' => [
                'required',
                'numeric',
                'digits:16',
                function ($attribute, $value, $fail) use ($request) {
                    $pasien = Pasien::where('nik', $request->nik)->orderBy('id', 'desc')->first();
                    if (!$pasien)
                        return $fail('NIK belum terdaftar');
                    if ($pasien->validated_at == null)
                        return $fail('Akun ini belum diverifikasi');
                    if (!$pasien->is_valid)
                        return $fail('Akun ini tidak valid');
                },
            ],
            'tgl_berobat' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $exists = Pendaftaran::whereHas('pasien', function ($query) use ($request) {
                        $query->where('nik', $request->nik);
                    })
                        ->whereDate('tgl_berobat', $value)
                        ->exists();
                    if ($exists) {
                        $fail('NIK ini sudah terdaftar pada tanggal yang dipilih.');
                    }
                },
            ],
            'poli_id' => 'required|exists:polis,id',
            'no_rekam_medis' => 'nullable|numeric',
            'cara_bayar' => 'required|in:1,2',
            'no_bpjs' => $request->cara_bayar == 2 ? 'required|numeric|digits:13' : 'nullable',
        ]);
        try {
            DB::beginTransaction();
            $pasien = Pasien::where('nik', $request->nik)->first();
            $validated['id'] = Uuid::uuid4();
            $validated['pasien_id'] = $pasien->id;
            $validated['tgl_pendaftaran'] = date('Y-m-d');

            $kode = strtoupper(Str::random(6));
            while (Pendaftaran::where('kode', $kode)->whereDate('tgl_berobat', $validated['tgl_berobat'])->exists()) {
                $kode = strtoupper(Str::random(6));
            }
            $validated['kode'] = $kode;

            $pendaftaran = Pendaftaran::create($validated);
            Mail::to($pasien->email)->send(new PendaftaranMail($pasien, $pendaftaran));
            DB::commit();
            return redirect(route('pendaftaranonline.berhasil', [
                'from' => 'daftar',
                'id' => $validated['id']
            ]));
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function alurPendaftaran()
    {
        return view('pendaftaran.alur-pendaftaran');
    }
    public function berhasil($from, $id)
    {
        if ($from == 'registrasi') {
            $pasien = Pasien::findOrFail($id);
            $text = "Informasi validasi pendaftaran akan dikirimkan melalui email $pasien->email. Mohon periksa kotak masuk email Anda untuk menerima informasi tersebut.";
        } else {
            $pendaftaran = Pendaftaran::findOrFail($id);
            if ($pendaftaran->is_taken || (date('Y-m-d') > $pendaftaran->tgl_berobat))
                abort(404);
            $text = "Kode pendaftaran telah dikirimkan melalui email {$pendaftaran->pasien->email}. Mohon periksa kotak masuk surel Anda untuk menerima kode tersebut. Kode ini dapat digunakan untuk mengambil nomor antrian.";
        }
        return view('pendaftaran.berhasil', compact('text'));
    }
}
