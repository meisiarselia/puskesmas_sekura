@extends('layouts.app')

@section('main')
    <section class="gray-bg py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title text-center">
                        <h2>Kritik & Saran</h2>
                        <div class="divider mx-auto my-4"></div>
                        <p>
                            Terima kasih atas partisipasi dan kontribusi anda dalam meningkatkan kualitas pelayanan
                            kesehatan kami
                        </p>
                    </div>
                </div>
            </div>
            <form action="/pelayanan/kritik-saran/create" method="POST">
                @csrf
                <div class="row">
                    <div class="col-6 mb-4">
                        <input name="nama" id="nama" type="text"
                            class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama Lengkap"
                            value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 mb-4">
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Masukkan Email Anda" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 mb-4">
                        <input name="topik" type="text" class="form-control @error('topik') is-invalid @enderror"
                            placeholder="Masukkan Judul/Topik Pembahasan" value="{{ old('topik') }}">
                        @error('topik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 mb-4">
                        <input name="no_tlp" type="tel" class="form-control @error('no_tlp') is-invalid @enderror"
                            placeholder="Masukkan Nomor Telepon" value="{{ old('no_tlp') }}">
                        @error('no_tlp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 mb-4">
                        <textarea name="pesan" rows="10" class="form-control @error('pesan') is-invalid @enderror"
                            placeholder="Masukkan Pesan Anda">{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-success btn-round-full">Kirim</button>
            </form>
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
            Fails.fire({
                text: "{{ session()->get('fails') }}"
            })
        </script>
    @endif
@endpush
