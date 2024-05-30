@extends('layouts.app')

@section('main')
    <section class="gray-bg">
        <div class="container py-5">
            <div class="card mt-5 shadow-lg">
                <div class="card-body text-center">
                    <div class="logo mb-4">
                        <img src="/images/logo.png" alt="" class="img-fluid" style="height: 100px;">
                    </div>
                    <h5 class="card-title">Selamat Datang</h5>
                    <h5>Pendaftaran Online</h5>
                    <h5>Puskesmas Desa Sekura</h5>
                    <p class="card-text">
                        Pendaftaran Online ini hanya tersedia untuk pasien yang telah menjadi anggota atau telah berobat
                        sebelumnya. Pendaftaran dapat dilakukan maksimal satu hari sebelum tanggal pelayanan. Poliklinik
                        hanya beroperasi dari hari Senin hingga Jumat, sedangkan pada hari libur nasional, Poliklinik tutup.
                        Apabila arda pasien baru, Anda dapat 
                        <a href="/pendaftaranonline/registrasi" class="text-danger font-weight-bold">Klik Disini</a> 
                        untuk melakukan regiatrasi.
                    </p>
                    <hr>
                    <a href="/pendaftaranonline/daftar" class="btn btn-success">Daftar</a>
                </div>
            </div>
        </div>
    </section>
@endsection
