@extends('layouts.app')

@section('main')
    @include('layouts.header', [
        'title' => 'Fasilitas Puskesmas Sekura',
        'breads' => [['Beranda', '/'], ['Fasilitas']],
    ])
    @push('css')
        <style>
            ._flex-basis {
                box-shadow: 0 0 30px -5px #aaa;
                border-radius: 1rem;
                cursor: pointer;
                transition: box-shadow 300ms;
            }

            ._flex-basis:hover {
                box-shadow: 0 0 50px 10px #aaa;
            }

            ._flex-basis > div {
                background-image: linear-gradient(to bottom, #000a, transparent,transparent, transparent ,#000a);
            }

        </style>
    @endpush
    <section class="gray-bg">
        <div class="container">
            <div class="row ">
                @foreach ($fasilitass as $lm)
                    <a href="/pelayanan/fasilitas/{{ $lm->id }}" class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="_flex-basis overflow-hidden"
                            style="background-image: url('{{ asset($lm->gambar) }}');height: 10rem; background-size: cover; background-position: center">
                            <div class="w-100 h-100 p-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <h5 class="text-white">{{ $lm->nama }}</h5>
                                    <p class="text-right text-white m-0" style="line-height: 12px">Baca Selengkapnya</p>
                                </div>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
