@extends('layouts.app')

@section('main')
    @include('layouts.header', [
        'title' => 'Sertifikat Akreditasi',
        'breads' => [['Beranda', '/'], ['Sertifikat Akreditasi']],
    ])
    <section class="bg-white">
        <div class="container py-5">
            <div class="shadow-lg w-100 rounded overflow-hidden text-center" style="height: 720px">
                <img src="{{ asset($gambar) }}" alt="" class="h-100">
            </div>
        </div>
    </section>
@endsection
