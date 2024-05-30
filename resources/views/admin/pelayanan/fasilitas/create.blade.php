@extends('layouts.admin.app', [
    'title' => ($fasilitas ? 'Edit' : 'Tambah') . ' Data Fasilitas',
])

@section('main')
    <div class="p-0 p-sm-3">
        <section class="d-flex justify-content-center">
            <div class="card card-body border-0 shadow col-md-8">
                <form action="{{ $fasilitas ? route('fasilitas.update', $fasilitas->id) : route('fasilitas.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($fasilitas)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="nama">Nama Fasilitas</label>
                        <input type="text" id="nama" name="nama"
                            class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama fasilitas"
                            value="{{ old('nama', $fasilitas->nama ?? '') }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi"
                            class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Masukkan Deskripsi Fasilitas"
                            >{{ old('deskripsi', $fasilitas->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
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
                    <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary">Kembali</a>
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
