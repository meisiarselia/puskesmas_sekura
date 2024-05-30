@extends('layouts.app')

@section('main')
    @include('layouts.header', [
        'title' => 'Visi & Misi Puskesmas Sekura',
        'breads' => [['Beranda', '/'], ['Visi Misi']],
    ])
    <section class="bg-white">
        <div class="container py-5">
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
@endsection
