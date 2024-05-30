@extends('layouts.app')

@section('main')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="doctor-img-block d-flex align-items-center justify-content-center w-100 flex-column">
                        <div class="text-success" style="font-size: 5rem; line-height: 1">
                            <i class="{{ $layananMedis->nama_icon }} " ></i>
                        </div>
                        <div class="info-block mt-4 text-center">
                            <h4 class="mb-0">{{$layananMedis->nama_layanan}}</h4>
                            <p>Layanan Medis</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-6">
                    <div class="doctor-details mt-4 mt-lg-0">
                        <h2 class="text-md">Deskripsi</h2>
                        <div class="divider my-4"></div>
                        <p>
                            {{$layananMedis->deskripsi}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
