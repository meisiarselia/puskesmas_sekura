@extends('layouts.admin.app', [
    'title' => ($poli ? 'Edit' : 'Tambah') . ' Data Poliklinik',
])

@section('main')
    <div class="p-0 p-sm-3">
        <section class="d-flex justify-content-center">
            <div class="card card-body border-0 shadow col-md-8">
                <form action="{{ $poli ? route('poli.update', $poli->id) : route('poli.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($poli)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="nama_poli">Nama Poliklinik</label>
                        <input type="text" id="nama_poli" name="nama_poli" rows="4"
                            class="form-control @error('nama_poli') is-invalid @enderror"
                            placeholder="Masukkan Nama Poliklinik" value="{{ old('nama_poli', $poli->nama_poli ?? '') }}">
                        @error('nama_poli')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <a href="{{ route('poli.index') }}" class="btn btn-secondary">Kembali</a>
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
