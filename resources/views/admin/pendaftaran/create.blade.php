@extends('layouts.admin.app', [
    'title' => ($pendaftaran ? 'Edit' : 'Tambah') . ' Data Pendaftaran',
])

@section('main')
    <div class="p-0 p-sm-3">
        <section class="d-flex justify-content-center">
            <div class="card card-body border-0 shadow col-md-8">
                <form
                    action="{{ $pendaftaran ? route('pendaftaran.update', $pendaftaran->id) : route('pendaftaran.store') }}"
                    method="POST">
                    @csrf
                    @if ($pendaftaran)
                        @method('PUT')
                    @else
                        <div class="form-group">
                            <label for="nik">
                                Nomor Induk Kependudukan
                                <span class="italic text-danger">
                                    *wajib diisi
                                </span>
                            </label>
                            <input type="number" id="nik" name="nik"
                                class="form-control @error('nik') is-invalid @enderror" placeholder="Masukkan NIK"
                                value="{{ old('nik', $pendaftaran->pasien->nik ?? '') }}">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif


                    <div class="form-group">
                        <label for="tgl_berobat">
                            Tanggal Berobat
                            <span class="italic text-danger">
                                *wajib diisi
                            </span>
                        </label>
                        <input type="date" id="tgl_berobat" min="{{ now()->format('Y-m-d') }}"
                            max="{{ now()->addDays(6)->format('Y-m-d') }}" name="tgl_berobat"
                            class="form-control @error('tgl_berobat') is-invalid @enderror"
                            value="{{ old('tgl_berobat', $pendaftaran->tgl_berobat ?? '') }}">
                        @error('tgl_berobat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="poli_id">
                            Pilih Poliklinik
                            <span class="italic text-danger">*wajib diisi</span>
                        </label>
                        <select name="poli_id" id="poli_id" class="form-control">
                            <option value="">-- Pilih Poliklinik --</option>
                            @foreach (App\Models\Poli::all() as $poli)
                                <option value="{{ $poli->id }}"
                                    {{ old('poli_id', $pendaftaran->poli_id ?? '') == $poli->id ? 'selected' : '' }}>
                                    {{ $poli->nama_poli }}
                                </option>
                            @endforeach
                        </select>
                        @error('poli_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_rekam_medis">Nomor Rekam Medis</label>
                        <input type="text" id="no_rekam_medis" name="no_rekam_medis"
                            class="form-control @error('no_rekam_medis') is-invalid @enderror"
                            placeholder="Masukkan Nomor RM"
                            value="{{ old('no_rekam_medis', $pendaftaran->no_rekam_medis ?? '') }}">
                        @error('no_rekam_medis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cara_bayar">Cara Bayar<span class="italic text-danger">*wajib
                                diisi</span></label>
                        <select name="cara_bayar" id="cara_bayar" class="form-control">
                            @foreach (\App\Alice::$cara_bayar as $i => $cb)
                                <option value="{{ $i }}"
                                    {{ old('cara_bayar', $pendaftaran->cara_bayar ?? '') == $i ? 'selected' : '' }}>
                                    {{ $cb }}
                                </option>
                            @endforeach
                        </select>
                        @error('cara_bayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" id="no_bpjs_group">
                        <label for="no_bpjs">
                            Nomor BPJS
                        </label>
                        <input type="text" id="no_bpjs" name="no_bpjs"
                            class="form-control @error('no_bpjs') is-invalid @enderror" placeholder="Masukkan Nomor BPJS"
                            value="{{ old('no_bpjs', $pendaftaran->no_bpjs ?? '') }}">
                        @error('no_bpjs')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($pendaftaran)
                        <div class="form-group" id="no_bpjs_group">
                            <label for="is_taken">
                                Status
                            </label>
                            <select name="is_taken" id="is_taken"
                                class="form-control @error('is_taken') is-invalid @enderror">
                                <option value="">-- Pilih Status --</option>
                                <option value="0"
                                    {{ old('is_taken', $pendaftaran->is_taken ?? '') == 0 ? 'selected' : '' }}>
                                    Tidak Hadir
                                </option>
                                <option value="1"
                                    {{ old('is_taken', $pendaftaran->is_taken ?? '') == 1 ? 'selected' : '' }}>
                                    Hadir
                                </option>
                            </select>
                            @error('is_taken')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-success">Simpan</button>
                </form>
            </div>
        </section>
    </div>
@endsection
@push('js')
    @if (session()->has('fails'))
        <script>
            Fails.fire({
                text: "{{ session()->get('fails') }}"
            })
        </script>
    @endif
@endpush
