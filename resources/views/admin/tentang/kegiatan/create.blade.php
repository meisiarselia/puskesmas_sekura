@extends('layouts.admin.app', [
    'title' => ($kegiatan ? 'Edit' : 'Tambah') . ' Data Kegiatan',
])

@section('main')
    <div class="p-0 p-sm-3">
        <section class="d-flex justify-content-center">
            <div class="card card-body border-0 shadow col-md-8">
                <form action="{{ $kegiatan ? route('kegiatan.update', $kegiatan->id) : route('kegiatan.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($kegiatan)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="judul">Judul kegiatan</label>
                        <input type="text" id="judul" name="judul"
                            class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan Nama kegiatan"
                            value="{{ old('judul', $kegiatan->judul ?? '') }}">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Gambar</label>
                        <input type="file" id="file" name="file"
                            class="form-control @error('file') is-invalid @enderror" value="{{ old('file') }}">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
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
