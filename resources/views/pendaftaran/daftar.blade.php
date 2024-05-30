@extends('layouts.app')


@section('main')
    <section class="gray-bg">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-body ">
                            <div class="text-center">
                                <div class="logo mb-4">
                                    <img src="/images/logo.png" alt="" class="img-fluid" style="height: 100px;">
                                </div>
                                <h5>Registrasi Pasien</h5>
                                <h5>Puskesmas Desa Sekura</h5>
                            </div>

                            <hr>
                            <form action="/pendaftaranonline/daftar" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="nik">Nomor Induk Kependudukan<span class="italic text-danger">*wajib
                                            diisi</span></label>
                                    <input type="number" id="nik" name="nik"
                                        class="form-control @error('nik') is-invalid @enderror"
                                        placeholder="Masukkan NIK"
                                        value="{{ request()->get('nik') ?? (session()->has('nik') ? session()->get('nik') : old('nik')) }}"
                                        >
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tgl_berobat">Tanggal Berobat<span class="italic text-danger">*wajib
                                            diisi</span></label>
                                    <input type="date" id="tgl_berobat" min="{{ now()->addDay()->format('Y-m-d') }}"
                                        max="{{ now()->addDays(7)->format('Y-m-d') }}" name="tgl_berobat"
                                        class="form-control @error('tgl_berobat') is-invalid @enderror"
                                        value="{{ old('tgl_berobat') }}">
                                    @error('tgl_berobat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="poli_id">Pilih Poliklinik<span class="italic text-danger">*wajib
                                            diisi</span></label>
                                    <select name="poli_id" id="poli_id" class="form-control">
                                        <option value="">-- Pilih Poliklinik --</option>
                                        @foreach ($polis as $poli)
                                            <option value="{{ $poli->id }}"
                                                {{ old('poli_id') == $poli->id ? 'selected' : '' }}>{{ $poli->nama_poli }}
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
                                        placeholder="Masukkan Nomor RM" value="{{ old('no_rekam_medis') }}">
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
                                                {{ old('cara_bayar') == $i ? 'selected' : '' }}>{{ $cb }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('cara_bayar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group" id="no_bpjs_group">
                                    <label for="no_bpjs">Nomor BPJS<span class="italic text-danger">*wajib
                                            diisi</span></label>
                                    <input type="text" id="no_bpjs" name="no_bpjs"
                                        class="form-control @error('no_bpjs') is-invalid @enderror"
                                        placeholder="Masukkan Nomor BPJS" value="{{ old('no_bpjs') }}">
                                    @error('no_bpjs')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <button class="btn btn-success">Daftar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    @if (session()->has('success'))
        <script>
            Success.fire({
                text: "{{ session()->get('success') }}"
            })
        </script>
    @endif
    @if (session()->has('fails'))
        <script>
            Fails.fire({
                text: "{{ session()->get('fails') }}"
            })
        </script>
    @endif
    <script>
        $(document).ready(function() {
            @if (old('cara_bayar') != 2)
                $('#no_bpjs_group').hide();
            @endif
            $('#cara_bayar').change(function() {
                if ($(this).val() == 2) {
                    $('#no_bpjs_group').show();
                } else {
                    $('#no_bpjs_group').hide();
                }
            });
        });
    </script>
@endpush
