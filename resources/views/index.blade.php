@extends('layouts.app')

@section('main')
    <section class="banner ">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-xl-7">
                    <div class="block">
                        <div class="divider mb-3 bg-success"></div>
                        <span class="text-uppercase text-sm letter-spacing">SELAMAT DATANG DI</span>
                        <h1 class="mb-3 mt-3" style="font-size: 4rem !important">Puskesmas Sekura</h1>
                        <p class="mb-4 pr-5">Pendaftaran antrian online menjadi lebih mudah dan nyaman!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature-block d-lg-flex">
                        <div class="feature-item mb-5 mb-lg-0">
                            <div class="feature-icon mb-4">
                                <i class="icofont-surgeon-alt text-success"></i>
                            </div>
                            <span>Pendaftaran</span>
                            <h4 class="mb-3">Antrian Online
                            </h4>
                            <p class="mb-4">
                                Lakukan pendaftaran antrian online untuk mengatur kunjungan dan hindari kerumunan di
                                lokasi.
                            </p>
                            <a href="/pendaftaranonline" class="btn btn-success btn-round-full">Daftar</a>
                        </div>

                        <div class="feature-item mb-5 mb-lg-0">
                            <div class="feature-icon mb-4">
                                <i class="icofont-ui-clock text-success"></i>
                            </div>
                            <span>Jadwal Pelayanan</span>
                            <h4 class="mb-3">Rawat Jalan</h4>
                            <ul class="w-hours list-unstyled">
                                <li class="d-flex justify-content-between">Senin-Kamis:<span>8:00 - 13:00</span></li>
                                <li class="d-flex justify-content-between">Jumat:<span>8:00 - 11:00</span></li>
                            </ul>
                        </div>

                        <div class="feature-item mb-5 mb-lg-0">
                            <div class="feature-icon mb-4">
                                <i class="icofont-support text-success"></i>
                            </div>
                            <span>Kasus Darurat</span>
                            <h4 class="mb-3">0811-566-1880</h4>
                            <p>
                                Dapatkan dukungan sepanjang waktu untuk keadaan darurat. Terhubung dengan kami unuk setiap
                                urgensi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="about-img">
                        <img src="{{ $fasilitas[8]->gambar }}" alt="" class="img-fluid">
                        <img src="{{ $fasilitas[13]->gambar }}" alt="" class="img-fluid mt-4">
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="about-img mt-4 mt-lg-0">
                        <img src="{{ $fasilitas[14]->gambar }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="about-content pl-4 mt-4 mt-lg-0">
                        <h2 class="">Perawatan pribadi <br>& gaya hidup sehat</h2>
                        <p class="mt-4 mb-5">
                            Kami menyediakan layanan medis terdepan terbaik. Tidak ada yang disukai, diberi izin, atau
                            menghilangkan kesenangan, rasa sakit, pujian, atau kesalahan.
                        </p>

                        <a href="/pelayanan/fasilitas" class="btn btn-success btn-round-full btn-icon">
                            Fasilitas
                            <i class="icofont-simple-right ml-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white" style="padding-top: 5rem !important;padding-bottom: 5rem !important">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title">
                        <h2>Visi & Misi</h2>
                        <div class="divider mx-auto my-4"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-lg ">
                        <div class="card-body">
                            <h1 class="card-title text-success">Visi</h1>
                            <p class="card-text">
                                {{ $visi }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-lg ">
                        <div class="card-body">
                            <h1 class="card-title text-success">Misi</h1>
                            <p class="card-text">
                                {!! $misi !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section service gray-bg" style="padding-top: 5rem !important;padding-bottom: 5rem !important">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title">
                        <h2>Penghargaan untuk perawatan pasien</h2>
                        <div class="divider mx-auto my-4"></div>
                        <p>Mari kita ketahui lebih lanjut tentang kebutuhan penting dalam menangani rasa sakit, pencahayaan
                            yang memadai, dan penanganan keluhan pasien kami. Kami berkomitmen untuk memberikan yang terbaik
                            dalam semua aspek perawatan.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($lms as $lm)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="service-item mb-4">
                            <div class="icon d-flex align-items-center">
                                <i class="{{ $lm->nama_icon }} text-lg"></i>
                                <h4 class="mt-3 mb-3">{{ $lm->nama_layanan }}</h4>
                            </div>

                            <div class="content">
                                <p class="mb-4">{{ $lm->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="/pelayanan/jenis-pelayanan" class="btn btn-success btn-round-full btn-icon text-white">
                    Selengkapnya
                    <i class="icofont-simple-right ml-3 text-white"></i>
                </a>
            </div>
        </div>
    </section>
    <section class="gray-bg" style="padding-top: 5rem !important;padding-bottom: 5rem !important">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="section-title">
                    <h2>Sertifikat Akreditasi</h2>
                    <div class="divider mx-auto my-4"></div>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="shadow-lg rounded"
                style="height: 720px;background-position: center center; background-repeat: no-repeat; background-size: contain;background-image: url('{{ asset($gambar) }}')">
            </div>
        </div>
    </section>
    <section>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d2493.465018860042!2d109.22243739797723!3d1.472282889011394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMcKwMjgnMjAuMyJOIDEwOcKwMTMnMTkuMSJF!5e1!3m2!1sen!2sid!4v1716718862502!5m2!1sen!2sid"
            width="100%" height="720" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
@endsection
