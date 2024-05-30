<?php

namespace App\Http\Controllers\Admin;

use Ramsey\Uuid\Uuid;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Mail\PendaftaranMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::select('id', 'pasien_id', 'kode', 'tgl_berobat', 'is_taken','takened_at')
            ->withAggregate('poli', 'nama_poli')
            ->with('pasien:id,nama,nik')
            ->get();
        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }
    public function checkin(Pendaftaran $pendaftaran)
    {
        try {
            $pendaftaran->is_taken = true;
            $pendaftaran->takened_at = now();
            $pendaftaran->save();
            return back()->with('success', 'Pendaftaran berhasil checkin!');
        } catch (\Throwable $th) {
            return back()->with('fails', 'Pendaftaran gagal checkin!');
        }

    }
    public function create(Pendaftaran $pendaftaran = null)
    {
        return view('admin.pendaftaran.create', compact('pendaftaran'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate($this->getRules($request));
        try {
            DB::beginTransaction();
            $pasien = Pasien::where('nik', $request->nik)->first();
            $validated['id'] = Uuid::uuid4();
            $validated['pasien_id'] = $pasien->id;
            $validated['tgl_pendaftaran'] = date('Y-m-d');
            $pendaftaran = Pendaftaran::create($validated);
            Mail::to($pasien->email)->send(new PendaftaranMail($pasien, $pendaftaran));
            DB::commit();
            return redirect(route('pendaftaran.index'))->with('success', 'Pendaftaran berhasil ditambah!');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate($this->getRules($request, true, $pendaftaran->id));
        try {
            $pendaftaran->tgl_berobat = $request->tgl_berobat;
            $pendaftaran->poli_id = $request->poli_id;
            $pendaftaran->no_rekam_medis = $request->no_rekam_medis;
            $pendaftaran->cara_bayar = $request->cara_bayar;
            $pendaftaran->no_bpjs = $request->no_bpjs;
            $pendaftaran->is_taken = $request->is_taken;
            $pendaftaran->save();
            return redirect(route('pendaftaran.index'))
                ->with('success', 'Data pendaftaran berhasil diubah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function delete(Pendaftaran $pendaftaran)
    {
        try {
            $pendaftaran->delete();
            return back()->with('success', 'Data pendaftaran berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }

    protected function getRules(Request $request, $isUpdate = false, $pendaftaran_id = null)
    {

        $rules = [
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
        ];

        if ($isUpdate == false) {
            $rules = array_merge(
                $rules,
                [
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
                    ]
                ]
            );
        } else {
            $rules = array_merge($rules, ['is_taken' => 'required|in:0,1']);
        }
        return $rules;
    }
}
