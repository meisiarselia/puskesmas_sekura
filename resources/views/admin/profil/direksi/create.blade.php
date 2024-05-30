@extends('layouts.admin.app', [
    'title' => ($direksi ? 'Edit' : 'Tambah') . ' Data Layanan Medis',
])

@section('main')
    <div class="p-0 p-sm-3">
        <section class="d-flex justify-content-center">
            <div class="card card-body border-0 shadow col-md-8">
                <form action="{{ $direksi ? route('direksi.update', $direksi->id) : route('direksi.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($direksi)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="jabatan">Nama Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan"
                            class="form-control @error('jabatan') is-invalid @enderror" placeholder="Masukkan Nama Jabatan"
                            value="{{ old('jabatan', $direksi->jabatan ?? '') }}">
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <textarea id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Masukkan Nama">{{ old('nama', $direksi->nama ?? '') }}</textarea>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jabatan_type">Jabatan Pada</label>
                        <select id="jabatan_type" name="jabatan_type"
                            class="form-control @error('jabatan_type') is-invalid @enderror">
                            <option value="">--- Pilih Tipe Jabatan ---</option>
                            <option value="TU"
                                {{ old('jabatan_type', $direksi->jabatan_type ?? '') == 'TU' ? 'selected' : '' }}>Tata
                                Usaha</option>
                            <option value="UKM"
                                {{ old('jabatan_type', $direksi->jabatan_type ?? '') == 'UKM' ? 'selected' : '' }}>Unit
                                Kesehatan Masyarakat</option>
                        </select>
                        @error('jabatan_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <a href="{{ route('direksi.index') }}" class="btn btn-secondary">Kembali</a>
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
