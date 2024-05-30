@extends('layouts.app')

@section('main')
    @include('layouts.header', [
        'title' => 'Struktur Organisasi',
        'breads' => [['Beranda', '/'], ['Struktur Organisasi']],
    ])
    <section class="bg-white">
        <div class="container py-5">
            <div class="shadow-lg w-100 py-3 rounded">
                <img src="{{ asset($nama_gambar) }}" alt="" class="w-100">
            </div>
        </div>
    </section>
    <section class="gray-bg py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="section-title">
                    <h2>Struktur Manajemen Tata Usaha Puskesmas Sekura</h2>
                    <div class="divider mx-auto my-4"></div>
                </div>
            </div>
        </div>
        <div class="container">
            <table class="table table-bordered table-sm w-100">
                <thead>
                    <tr>
                        <th>Jabatan</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tus as $tu)
                        <tr>
                            <td>
                                {{ $tu->jabatan }}
                            </td>
                            <td>
                                {{ $tu->nama }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <section class="bg-white py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="section-title">
                    <h2>Struktur Upaya Kesehatan Masyarakat Puskesmas Sekura</h2>
                    <div class="divider mx-auto my-4"></div>
                </div>
            </div>
        </div>
        <div class="container">
            <table class="table table-bordered table-sm w-100">
                <thead>
                    <tr>
                        <th>Jabatan</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ukms as $ukm)
                        <tr>
                            <td>
                                {{ $ukm->jabatan }}
                            </td>
                            <td>
                                {{ $ukm->nama }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>
@endsection
