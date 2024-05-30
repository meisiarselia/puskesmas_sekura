@extends('layouts.app')

@section('main')
    <section class="gray-bg">
        <div class="container py-5">
            <div class="d-flex flex-wrap align-items-center justify-content-center" style="gap: 2rem">
                <a href="#modalLama" data-toggle="modal"
                    class="d-inline-flex flex-column align-items-center bg-white rounded shadow p-4" style="gap: 1rem">
                    <span style="font-size: 3rem">
                        <i class="fa-solid fa-hospital-user fa-xl text-success"></i>
                    </span>
                    <h4 class="m-0 text-center">
                        Alur Pendaftaran Pasien Lama
                    </h4>
                </a>
                <a href="#modalBaru" data-toggle="modal"
                    class="d-inline-flex flex-column align-items-center bg-white rounded shadow p-4" style="gap: 1rem">
                    <span style="font-size: 3rem">
                        <i class="fa-solid fa-file-medical fa-xl text-success"></i>
                    </span>
                    <h4 class="m-0 text-center">
                        Alur Pendaftaran Pasien Baru
                    </h4>
                </a>

            </div>
        </div>
    </section>
@endsection
@push('js')
    <div class="modal fade" tabindex="-1" id="modalLama">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alur Pendaftaran Pasien Lama</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modalBaru">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alur Pendaftaran Pasien Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endpush
