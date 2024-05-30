@extends('layouts.admin.app', [
    'title' => ($jenis_pelayanan ? 'Edit' : 'Tambah') . ' Data Layanan Medis',
])

@section('main')
    <div class="p-0 p-sm-3">
        <section class="d-flex justify-content-center">
            <div class="card card-body border-0 shadow col-md-8">
                <form
                    action="{{ $jenis_pelayanan ? route('jenis-pelayanan.update', $jenis_pelayanan->id) : route('jenis-pelayanan.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($jenis_pelayanan)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="nama_layanan">Nama Layanan Medis</label>
                        <input type="text" id="nama_layanan" name="nama_layanan"
                            class="form-control @error('nama_layanan') is-invalid @enderror"
                            placeholder="Masukkan Nama Layanan Medis"
                            value="{{ old('nama_layanan', $jenis_pelayanan->nama_layanan ?? '') }}">
                        @error('nama_layanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                            placeholder="Masukkan Deskripsi Fasilitas">{{ old('deskripsi', $jenis_pelayanan->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="nama_layanan">Icon</label>
                        <div class="d-flex align-items-end" style="gap: 1rem">
                            <div class="shadow rounded flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 5rem; height: 5rem;">
                                <i id="previewIcon"
                                    class="text-success text-lg {{ old('nama_icon', $jenis_pelayanan->nama_icon ?? '') }}"></i>
                            </div>
                            <div class="w-100">
                                <input type="text" id="nama_icon" name="nama_icon"
                                    class="form-control @error('nama_icon') is-invalid @enderror"
                                    placeholder="Masukkan Nama Icon"
                                    value="{{ old('nama_icon', $jenis_pelayanan->nama_icon ?? '') }}"
                                    oninput="checkIcon(this)">
                                @error('nama_icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('jenis-pelayanan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-success">Simpan</button>
                </form>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script>
        function checkIcon(el) {
            document.getElementById('previewIcon').className = 'text-success text-lg ' + el.value;
        }
    </script>
    @if (session()->has('fails'))
        <script>
            Fails.fire({
                text: "{{ session()->get('fails') }}"
            })
        </script>
    @endif
@endpush
