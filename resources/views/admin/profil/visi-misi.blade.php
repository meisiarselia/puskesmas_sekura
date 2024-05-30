@extends('layouts.admin.app', [
    'title' => 'Visi Misi',
])
@push('css')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpush
@section('main')
    <div class="p-0 p-sm-3">
        <div class="card card-body border-0 shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="m-0">Visi Misi</h4>
                <button class="btn btn-success">Simpan</button>
            </div>
            <form action="{{ route('visi-misi.update') }}" method="POST" id="contactForm">
                @csrf
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="visi">Visi</label>
                        <input name="visi" id="visi" class="d-none form-control @error('visi') is-invalid @enderror" rows="15" value="{{ $visi_misi->visi }}">
                        <trix-editor input="visi"></trix-editor>
                        @error('visi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="misi">Misi</label>
                        <input name="misi" id="misi" class="d-none form-control @error('misi') is-invalid @enderror" rows="15" value="{{ $visi_misi->misi }}">
                        <trix-editor input="misi"></trix-editor>
                        @error('misi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        @if (session()->has('success'))
            Success.fire({
                text: "{{ session()->get('success') }}"
            })
        @endif
        @if (session()->has('fails'))
            Fails.fire({
                text: "{{ session()->get('fails') }}"
            })
        @endif
    </script>
@endpush
