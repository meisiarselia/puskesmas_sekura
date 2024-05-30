@extends('layouts.app')

@section('main')
    @include('layouts.header', [
        'title' => 'Detail Fasilitas',
        'breads' => [
            ['Beranda', '/'],
            ['Fasilitas','/pelayanan/fasilitas'],
            [$fasilitas->nama]
        ],
    ])

    <section class="gray-bg">
        <div class="container">
            <div style="height: 500px; border-radius: 1rem; box-shadow: 0 0 30px #0003; background-image: url('{{$fasilitas->gambar}}'); background-size: cover; background-position: center">
            </div>
            <div class="py-3">
                <h2>{{$fasilitas->nama}}</h2>
                <div class="divider mb-3"></div>
                <p>{{$fasilitas->deskripsi}}</p>
            </div>
        </div>
    </section>
@endsection
