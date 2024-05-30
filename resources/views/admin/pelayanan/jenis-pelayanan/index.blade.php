@extends('layouts.admin.app', [
    'title' => 'Jenis Pelayanan',
])
@section('main')
    <div class="p-0 p-sm-3">
        <section>
            <div class="card card-body border-0 shadow">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="m-0">Jenis Pelayanan</h4>
                    <a href="{{ route('jenis-pelayanan.create') }}" class="btn btn-success">Tambah Data</a>
                </div>
                <div class=" table-responsive">
                    <table class="table" style="width: 100%" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Layanan Medis</th>
                                <th>Deskripsi</th>
                                <th style="text-align: center !important">Icon</th>
                                <th style="min-width: 10px !important;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenis_pelayanans as $i => $jenis_pelayanan)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $jenis_pelayanan->nama_layanan }}</td>
                                    <td>{{ $jenis_pelayanan->deskripsi }}</td>
                                    <td>
                                        <div class="d-flex flex-column align-items-center">

                                            <i class="text-success text-lg {{ $jenis_pelayanan->nama_icon }}"></i>
                                            {{ $jenis_pelayanan->nama_icon }}
                                        </div>
                                    </td>
                                    <td class="aksi">
                                        <div class="d-inline-flex" style="gap: .5rem">
                                            <a href="{{ route('jenis-pelayanan.create', $jenis_pelayanan->id) }}" class="btn btn-dark">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form id="deleteForm{{ $jenis_pelayanan->id }}"
                                                action="{{ route('jenis-pelayanan.delete', $jenis_pelayanan->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $jenis_pelayanan->id }})">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </section>
    </div>
@endsection
@push('js')
    <script src="https://cdn.datatables.net/v/bs4/dt-2.0.7/datatables.min.js"></script>
    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        })
        @if (session()->has('success'))
            Success.fire({
                text: "{{ session()->get('success') }}"
            })
        @endif
        function confirmDelete(id) {
            Question.fire({
                text: "Apakah anda yakin untuk menghapusnya?",
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, kirim formulir untuk menghapus
                    document.getElementById('deleteForm' + id).submit();
                }
            })
        }
    </script>
@endpush
