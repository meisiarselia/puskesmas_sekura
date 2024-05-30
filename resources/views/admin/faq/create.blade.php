@extends('layouts.admin.app', [
    'title' => ($faq ? 'Edit' : 'Tambah') . ' Data FAQ',
])

@section('main')
    <div class="p-0 p-sm-3">
        <section class="d-flex justify-content-center">
            <div class="card card-body border-0 shadow col-md-8">
                <form action="{{ $faq ? route('faq.update', $faq->id) : route('faq.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($faq)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="pertanyaan">Pertanyaan</label>
                        <textarea type="text" id="pertanyaan" name="pertanyaan" rows="4"
                            class="form-control @error('pertanyaan') is-invalid @enderror" placeholder="Masukkan Pertanyaan">{{ old('pertanyaan', $faq->pertanyaan ?? '') }}</textarea>
                        @error('pertanyaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jawaban">Jawaban</label>
                        <textarea type="text" id="jawaban" name="jawaban" rows="7"
                            class="form-control @error('jawaban') is-invalid @enderror" placeholder="Masukkan jawaban">{{ old('jawaban', $faq->jawaban ?? '') }}</textarea>
                        @error('jawaban')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <a href="{{ route('faq.index') }}" class="btn btn-secondary">Kembali</a>
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
