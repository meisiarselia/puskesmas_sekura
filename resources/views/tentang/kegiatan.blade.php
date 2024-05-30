@extends('layouts.app')

@section('main')
    @push('css')
        <style>
            a.custom-tab-item {
                line-height: 1.25rem;
                display: block;
                padding: .5rem 0;
            }

            a.custom-tab-item:focus,
            a.custom-tab-item:hover {
                color: white !important;
            }
        </style>
    @endpush
    @include('layouts.header', [
        'title' => 'Galeri Kegiatan',
        'breads' => [['Beranda', '/'], ['Kegiatan']],
    ])
    <section class="bg-white">
        <div class="container py-5">
            <div class="shadow-lg w-100 p-3 rounded">
                <div class="row">
                    <div class="col-md-4">
                        <div class="bg-success p-3 rounded-lg">
                            <h4>Galeri</h4>
                            <hr>
                            <div class="list-group" id="list-tab" role="tablist">
                                @foreach ($kegiatans as $kegiatan)
                                    <a class="custom-tab-item" id="list-{{ $kegiatan->id }}-list" data-toggle="list"
                                        href="#list-{{ $kegiatan->id }}" role="tab" aria-controls="asd{{ $kegiatan->id }}">
                                        {{ $kegiatan->judul }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content" id="nav-tabContent">
                            @foreach ($kegiatans as $kegiatan)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="list-{{ $kegiatan->id }}" role="tabpanel"
                                    aria-labelledby="list-asd{{ $kegiatan->id }}-list">
                                    <h2 class="text-success">{{$kegiatan->judul}}</h2>
                                    <img src="{{ $kegiatan->gambar }}" style="border-radius: 1rem; width: 100%">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
