@extends('layouts.admin.app', [
    'title' => 'Data Pasien',
])
@push('css')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <style>
        .modal td:last-child {
            color: var(--green);
            font-weight: 900;
            font-family: "Exo", sans-serif;
        }
    </style>
@endpush
@section('main')
    <div class="p-0 p-sm-3">
        <section>
            <div class="card card-body border-0 shadow">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="m-0">Data Pasien</h4>
                    <a href="{{ route('pasien.create') }}" class="btn btn-success">Tambah Data</a>
                </div>
                <div class=" table-responsive">
                    <table class="table" style="width: 100%" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>NIK</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th class="aksi" style="min-width: 10px !important">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasiens as $i => $pasien)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $pasien->nama }}</td>
                                    <td>{{ $pasien->nik }}</td>
                                    <td>{{ $pasien->alamat }}</td>
                                    <td>
                                        @if ($pasien->validated_at == null)
                                            <a href="javascript:;" onclick="openDetail({{ $pasien->id }})"
                                                class="btn btn-warning">
                                                Validasi
                                            </a>
                                        @else
                                            @if ($pasien->is_valid)
                                                <a href="javascript:;" onclick="openDetail({{ $pasien->id }})"
                                                    class="btn btn-success">
                                                    Data Valid
                                                </a>
                                            @else
                                                <a href="javascript:;" onclick="openDetail({{ $pasien->id }})"
                                                    class="btn btn-danger">
                                                    Data Tidak Valid
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="aksi">
                                        <div class="d-inline-flex" style="gap: .5rem">
                                            <a href="{{ route('pasien.create', $pasien->id) }}" class="btn btn-dark">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form id="deleteForm{{ $pasien->id }}"
                                                action="{{ route('pasien.delete', $pasien->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $pasien->id }})">
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
    <div class="modal fade" id="validateModal" tabindex="-1">
        <div class="modal-dialog  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="validateModalLabel">Validasi Data Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <table class="table m-0">
                        <tr>
                            <td>NIK</td>
                            <td id="nik"></td>
                        </tr>
                        <tr>
                            <td>No KK</td>
                            <td id="no_kk"></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td id="nama"></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td id="tgl_lahir"></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td id="jenkel"></td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td id="agama"></td>
                        </tr>
                        <tr>
                            <td>No Telepon</td>
                            <td id="no_tlp"></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td id="alamat"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td id="email"></td>
                        </tr>
                        <tr>
                            <td>Dokumen</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="py-0" style="border-top-width: 0">
                                <a href="" id="dokumenA" class="" data-fancybox data-caption="Dokumen Pasien">
                                    <img src="" id="dokumen" style="border-radius: 1rem;width: 100%">
                                </a>
                            </td>
                        </tr>
                    </table>


                </div>
                <div id="modalFooter" class="modal-footer d-block">
                    <form method="POST" id="formValidate">
                        @csrf
                        <div class="d-flex">
                            <button data-toggle="tooltip" data-placement="bottom" title="Data Valid" type="submit"
                                class="btn btn-success  ml-1 p-3" name="is_valid" value="Validate">
                                <i class="fa-regular fa-circle-check fa-lg"></i>
                            </button>
                            <button data-toggle="tooltip" data-placement="bottom" title="Data Tidak Valid" type="submit"
                                class="btn btn-danger ml-1 p-3" name="is_valid" value="Invalidate">
                                <i class="fa-regular fa-circle-xmark fa-lg"></i>
                            </button>
                            <button type="button" class="btn btn-secondary ml-auto" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/v/bs4/dt-2.0.7/datatables.min.js"></script>
    <script>
        const pasiens = @json($pasiens);

        function openDetail(id) {
            const result = pasiens.filter(item => item.id === id);
            if (result.length > 0) {
                const detail = result[0];

                // Mengisi data ke dalam tabel
                document.getElementById('nik').innerText = detail.nik;
                document.getElementById('no_kk').innerText = detail.no_kk;
                document.getElementById('nama').innerText = detail.nama;
                document.getElementById('tgl_lahir').innerText = detail.tgl_lahir;
                document.getElementById('jenkel').innerText = detail.jenkel;
                document.getElementById('agama').innerText = detail.agama;
                document.getElementById('no_tlp').innerText = detail.no_tlp;
                document.getElementById('alamat').innerText = detail.alamat;
                document.getElementById('email').innerText = detail.email;
                document.getElementById('dokumen').src = '/storage/' + detail.dokumen;
                document.getElementById('dokumenA').href = '/storage/' + detail.dokumen;
                document.getElementById('formValidate').action = '/admin/data-pasien/validate/' + detail.id;

                // Menampilkan modal
                $('#validateModal').modal('show');
            } else {
                console.log(`No entry found with ID: ${id}`);
            }
        }


        let table = new DataTable('#myTable', {
            responsive: true
        })
        @if (session()->has('success'))
            Success.fire({
                text: "{{ session()->get('success') }}"
            })
        @endif
        @if (session()->has('fails'))
            Fails.fire({
                text: "{{ session()->get('fails') }}"
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
        document.addEventListener('DOMContentLoaded', function() {
            Fancybox.bind("[data-fancybox]", {
                // Your custom options
            });
        });
    </script>
@endpush
