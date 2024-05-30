@extends('layouts.admin.app', [
    'title' => ($pasien ? 'Edit' : 'Tambah') . ' Data Pasien',
])

@section('main')
    <div class="p-0 p-sm-3">
        <section class="d-flex justify-content-center">
            <div class="card card-body border-0 shadow col-md-8">
                <form action="{{ $pasien ? route('pasien.update', $pasien->id) : route('pasien.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($pasien)
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label for="no_kk">Nomor Kartu Keluarga<span class="italic text-danger">*wajib diisi</span></label>
                        <input type="text" id="no_kk" name="no_kk"
                            class="form-control @error('no_kk') is-invalid @enderror" placeholder="Masukkan Nomor KK"
                            value="{{ old('no_kk', $pasien->no_kk ?? '') }}">
                        @error('no_kk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nik">Nomor Induk Kependudukan<span class="italic text-danger">*wajib
                                diisi</span></label>
                        <input type="text" id="nik" name="nik"
                            class="form-control @error('nik') is-invalid @enderror" placeholder="Masukkan NIK"
                            value="{{ old('nik', $pasien->nik ?? '') }}">
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap<span class="italic text-danger">*wajib diisi</span></label>
                        <input type="text" id="nama" name="nama"
                            class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama Lengkap"
                            value="{{ old('nama', $pasien->nama ?? '') }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir<span class="italic text-danger">*wajib diisi</span></label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir"
                            class="form-control @error('tgl_lahir') is-invalid @enderror"
                            value="{{ old('tgl_lahir', $pasien->tgl_lahir ?? '2000-01-01') }}">
                        @error('tgl_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenkel">Jenis Kelamin<span class="italic text-danger">*wajib diisi</span></label>
                        <select id="jenkel" name="jenkel" class="form-control @error('jenkel') is-invalid @enderror">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="1" {{ old('jenkel', $pasien->jenkel ?? '') == '1' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="2" {{ old('jenkel', $pasien->jenkel ?? '') == '2' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                        @error('jenkel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="agama">Agama<span class="italic text-danger">*wajib diisi</span></label>
                        <select id="agama" name="agama" class="form-control @error('agama') is-invalid @enderror">
                            @foreach (App\Alice::$agama as $i => $agama)
                                <option value="{{ $i == 0 ? '' : $i }}"
                                    {{ old('agama', $pasien->agama ?? '') == $i ? 'selected' : '' }}>
                                    {{ $agama }}
                                </option>
                            @endforeach
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_tlp">Nomor Telepon<span class="italic text-danger">*wajib diisi</span></label>
                        <input type="text" id="no_tlp" name="no_tlp"
                            class="form-control @error('no_tlp') is-invalid @enderror" placeholder="Masukkan Nomor Telepon"
                            value="{{ old('no_tlp', $pasien->no_tlp ?? '') }}">
                        @error('no_tlp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat<span class="italic text-danger">*wajib diisi</span></label>
                        <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                            placeholder="Masukkan Alamat">{{ old('alamat', $pasien->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email<span class="italic text-danger">*wajib diisi</span></label>
                        <input type="text" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email"
                            value="{{ old('email', $pasien->email ?? '') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="file">
                            Dokumen
                            @if (!$pasien)
                                <span class="italic text-danger">*wajib diisi</span>
                            @endif
                        </label>
                        <input type="file" id="file" name="file"
                            class="form-control @error('file') is-invalid @enderror"
                            value="{{ old('file', $pasien->dokumen ?? '') }}">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-2" style="font-size: .8rem">
                            Upload Foto KTP / KK / Rekam Medis dalam bentuk .jpeg/.jpg/.png/.svg/.webp/.avif
                        </div>
                    </div>
                    <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
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
