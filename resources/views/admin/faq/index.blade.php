@extends('layouts.admin.app', [
    'title' => 'FAQ',
])
@push('css')
    <link href="https://cdn.datatables.net/v/bs4/dt-2.0.7/datatables.min.css" rel="stylesheet">
    <style>
        thead tr th,
        tbody tr td {
            text-align: left !important;
        }

        thead tr th:last-child,
        tbody tr td:last-child {
            text-align: center !important;
        }

        td .btn {
            padding: .5rem .75rem !important;
            font-size: .75rem !important;
        }
    </style>
@endpush
@section('main')
    <div class="p-0 p-sm-3">
        <section>
            <div class="card card-body border-0 shadow">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="m-0">FAQ</h4>
                    <a href="{{ route('faq.create') }}" class="btn btn-success">Tambah Data</a>
                </div>
                <div class=" table-responsive">
                    <table class="table" style="width: 100%" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                                <th class="aksi" style="min-width: 10px !important">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $i => $faq)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $faq->pertanyaan }}</td>
                                    <td>{{ $faq->jawaban }}</td>
                                    <td class="aksi">
                                        <div class="d-inline-flex" style="gap: .5rem">
                                            <a href="{{ route('faq.create', $faq->id) }}" class="btn btn-dark">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form id="deleteForm{{ $faq->id }}"
                                                action="{{ route('faq.delete', $faq->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $faq->id }})">
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
