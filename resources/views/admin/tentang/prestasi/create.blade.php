@extends('layouts.admin.app', [
    'title' => ($prestasi ? 'Edit' : 'Tambah') . ' Data Prestasi',
])

@section('main')
    <div class="p-0 p-sm-3">
        <section class="d-flex justify-content-center">
            <div class="card card-body border-0 shadow col-md-8">
                <form action="{{ $prestasi ? route('prestasi.update', $prestasi->id) : route('prestasi.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($prestasi)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="nama_prestasi">Nama Prestasi</label>
                        <input type="text" id="nama_prestasi" name="nama_prestasi"
                            class="form-control @error('nama_prestasi') is-invalid @enderror"
                            placeholder="Masukkan Nama Prestasi"
                            value="{{ old('nama_prestasi', $prestasi->nama_prestasi ?? '') }}">
                        @error('nama_prestasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Piagam Penghargaan</label>
                        <input type="file" id="file" name="file"
                            class="form-control @error('file') is-invalid @enderror" value="{{ old('file') }}">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">Kembali</a>
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
