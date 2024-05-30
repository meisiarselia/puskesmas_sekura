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
                            <form action="/pendaftaranonline/registrasi" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="no_kk">Nomor Kartu Keluarga<span class="italic text-danger">*wajib
                                            diisi</span></label>
                                    <input type="text" id="no_kk" name="no_kk"
                                        class="form-control @error('no_kk') is-invalid @enderror"
                                        placeholder="Masukkan Nomor KK" value="{{ old('no_kk') }}">
                                    @error('no_kk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nik">Nomor Induk Kependudukan<span class="italic text-danger">*wajib
                                            diisi</span></label>
                                    <input type="text" id="nik" name="nik"
                                        class="form-control @error('nik') is-invalid @enderror" placeholder="Masukkan NIK"
                                        value="{{ request()->get('nik') ?? old('nik') }}">
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama">Nama Lengkap<span class="italic text-danger">*wajib
                                            diisi</span></label>
                                    <input type="text" id="nama" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tgl_lahir">
                                        Tanggal Lahir
                                        <span class="italic text-danger">*wajib diisi</span>
                                    </label>
                                    <input type="date" id="tgl_lahir" name="tgl_lahir"
                                        class="form-control @error('tgl_lahir') is-invalid @enderror"
                                        value="{{ old('tgl_lahir', '2000-01-01') }}">
                                    @error('tgl_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jenkel">Jenis Kelamin<span class="italic text-danger">*wajib
                                            diisi</span></label>
                                    <select id="jenkel" name="jenkel"
                                        class="form-control @error('jenkel') is-invalid @enderror">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="1" {{ old('jenkel') == '1' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="2" {{ old('jenkel') == '2' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                    @error('jenkel')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Tambahkan Input untuk Agama -->
                                <div class="form-group">
                                    <label for="agama">Agama<span class="italic text-danger">*wajib diisi</span></label>
                                    <select id="agama" name="agama"
                                        class="form-control @error('agama') is-invalid @enderror">
                                        <option value="">Pilih Agama</option>
                                        <option value="1" {{ old('agama') == '1' ? 'selected' : '' }}>Budha</option>
                                        <option value="2" {{ old('agama') == '2' ? 'selected' : '' }}>Hindu</option>
                                        <option value="3" {{ old('agama') == '3' ? 'selected' : '' }}>Islam</option>
                                        <option value="4" {{ old('agama') == '4' ? 'selected' : '' }}>Katholik
                                        </option>
                                        <option value="5" {{ old('agama') == '5' ? 'selected' : '' }}>Kristen</option>
                                        <option value="6" {{ old('agama') == '6' ? 'selected' : '' }}>Konghuchu
                                        </option>
                                    </select>
                                    @error('agama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Tambahkan Input untuk Nomor Telepon -->
                                <div class="form-group">
                                    <label for="no_tlp">Nomor Telepon<span class="italic text-danger">*wajib
                                            diisi</span></label>
                                    <input type="text" id="no_tlp" name="no_tlp"
                                        class="form-control @error('no_tlp') is-invalid @enderror"
                                        placeholder="Masukkan Nomor Telepon" value="{{ old('no_tlp') }}">
                                    @error('no_tlp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Tambahkan Input untuk Alamat -->
                                <div class="form-group">
                                    <label for="alamat">Alamat<span class="italic text-danger">*wajib diisi</span></label>
                                    <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                        placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Tambahkan Input untuk Email -->
                                <div class="form-group">
                                    <label for="email">Email<span class="italic text-danger">*wajib diisi</span></label>
                                    <input type="text" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Masukkan Email" value="{{ old('email', $pasien->email ?? '') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Tambahkan Input untuk Dokumen -->
                                <div class="form-group">
                                    <label for="file">Dokumen<span class="italic text-danger">*wajib
                                            diisi</span></label>
                                    <input type="file" id="file" name="file"
                                        class="form-control @error('file') is-invalid @enderror">
                                    @error('file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="mt-2" style="font-size: .8rem">
                                        Upload Foto KTP / KK / Rekam Medis dalam bentuk .jpeg/.jpg/.png/.svg/.webp/.avif
                                    </div>
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
            Success.fire({
                text: "{{ session()->get('fails') }}"
            })
        </script>
    @endif
@endpush
