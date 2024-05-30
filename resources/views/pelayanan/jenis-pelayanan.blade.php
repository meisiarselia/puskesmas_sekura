@extends('layouts.app')

@section('main')
    @push('css')
        <style>
            ._flex-basis {
                flex-basis: 100%;
                box-shadow: 0 0 30px -5px #ddd;
                border-radius: 1rem;
                cursor: pointer;
                transition: box-shadow 300ms;
            }

            ._flex-basis:hover {
                box-shadow: 0 0 50px 10px #eeef;
            }

            .gap {
                gap: 2rem;
            }

            @media (min-width: 768px) {
                ._flex-basis {
                    flex-basis: calc(100% / 3 - 2rem);
                }

                .gap {
                    gap: 2rem;
                }
            }

            @media (min-width: 992px) {
                ._flex-basis {
                    flex-basis: calc(25% - 3rem);
                }

                .gap {
                    gap: 3rem;
                }
            }
        </style>
    @endpush
    <section class="section service py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title">
                        <h2>Layanan Medis Kami</h2>
                        <div class="divider mx-auto my-4"></div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-center gap">
                @foreach ($lms as $lm)
                    <a href="/pelayanan/jenis-pelayanan/{{ $lm->id }}" class="d-inline-block p-4 _flex-basis">
                        <div class="content d-flex flex-column justify-content-center align-items-center text-center">
                            <i class="{{ $lm->nama_icon }} text-lg"></i>
                            <h4 class="mt-3 mb-0 p-0">{{ $lm->nama_layanan }}</h4>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
