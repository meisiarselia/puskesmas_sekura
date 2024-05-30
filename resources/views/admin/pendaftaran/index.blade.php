 @extends('layouts.admin.app', [
    'title' => 'Pendaftaran Online',
])
@section('main')
    <div class="p-0 p-sm-3">
        <section>
            <div class="card card-body border-0 shadow">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="m-0 mr-auto">Pendaftaran Online</h4>
                    <a href="#kedatanganModal" data-toggle="modal" class="btn btn-dark mr-1">Check In</a>
                    <a href="{{ route('pendaftaran.create') }}" class="btn btn-success">Tambah Data</a>
                </div>
                <div class=" table-responsive">
                    <table class="table" style="width: 100%" id="myTable">
                        <thead>
                            <tr>
                                <th>Kode Pendaftaran</th>
                                <th>Nama Pasien</th>
                                <th>NIK</th>
                                <th>Tanggal Berobat</th>
                                <th>Waktu Check in</th>
                                <th>Poli</th>
                                <th style="text-align: center !important">Status</th>
                                <th class="aksi" style="min-width: 10px !important">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendaftarans as $i => $pendaftaran)
                                <tr>
                                    <td>{{ $pendaftaran->kode }}</td>
                                    <td>{{ $pendaftaran->pasien->nama }}</td>
                                    <td>{{ $pendaftaran->pasien->nik }}</td>
                                    <td>{{ $pendaftaran->tgl_berobat }}</td>
                                    <td>{{ $pendaftaran->takened_at ? Carbon\Carbon::parse($pendaftaran->takened_at)->format('H:i') : '' }}
                                    <td>{{ $pendaftaran->poli_nama_poli }}</td>
                                    </td>
                                    <td>
                                        <span
                                            class="badge p-2 {{ $pendaftaran->is_taken ? 'badge-success' : 'badge-danger' }}">
                                            {{ $pendaftaran->is_taken ? 'Hadir' : 'Tidak Hadir' }}
                                        </span>
                                    </td>
                                    <td class="aksi">
                                        <div class="d-inline-flex" style="gap: .5rem">
                                            <a href="{{ route('pendaftaran.create', $pendaftaran->id) }}"
                                                class="btn btn-dark">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form id="deleteForm{{ $pendaftaran->id }}"
                                                action="{{ route('pendaftaran.delete', $pendaftaran->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete('{{ $pendaftaran->id }}')">
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
    <div class="modal fade" id="kedatanganModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Check In Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="search" oninput="cariPendaftaran(this)"
                        class="form-control form-control-lg" placeholder="Masukkan Kode Pendaftaran">
                    <div id="resultC"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/v/bs4/dt-2.0.7/datatables.min.js"></script>
    <script>
        function getCurdate() {
            // Buat objek Date sekarang
            const now = new Date();

            // Dapatkan offset timezone dalam menit untuk Asia/Jakarta (WIB)
            const jakartaOffset = 7 * 60;

            // Dapatkan offset timezone lokal dalam menit
            const localOffset = now.getTimezoneOffset();

            // Hitung selisih offset timezone
            const offset = jakartaOffset - localOffset;

            // Buat objek Date baru dengan menyesuaikan offset
            const jakartaTime = new Date(now.getTime() + offset * 60000);

            // Dapatkan komponen tanggal (tahun, bulan, hari)
            const year = jakartaTime.getFullYear();
            const month = String(jakartaTime.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
            const day = String(jakartaTime.getDate()).padStart(2, '0');

            // Gabungkan komponen tanggal dengan format Y-m-d
            const formattedDate = `${year}-${month}-${day}`;

            return formattedDate;
        }
        const pendaftarans = @json($pendaftarans);
        const resC = document.getElementById('resultC')
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

        const card = (id, kode, name, poli) => {
            return `<div class="card card-body p-0 mt-2 overflow-hidden">
                <div class="d-flex align-items-stretch">
                    <div class="flex-grow-1 p-2">
                        <div style="font-size: .75rem; line-height: .7rem">Kode: ${kode}</div>
                        <h3 class="my-1"> ${name}</h3>
                        <div style="font-size: .75rem; line-height: .7rem"> ${poli}</div>
                    </div>
                    <button class="btn btn-success flex-shrink-0 rounded-right " style="border-radius: 0 !important" onclick="confirmCheckIn('${id}')">
                        Check-In
                    </button>
                </div>
            </div>`
        }

        function confirmCheckIn(id) {
            Question.fire({
                text: "Apakah anda yakin melakukan check-in pendaftaran ini?",
                customClass: {
                    confirmButton: "btn btn-success mx-1",
                    cancelButton: "btn btn-light mx-1",
                },
                confirmButtonText: 'Ya, lanjutkan!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mendapatkan token CSRF dari meta tag
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Submit form dengan menyertakan token CSRF
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/pendaftaran/checkin/${id}`;
                    document.body.appendChild(form);

                    // Menambahkan input tersembunyi untuk menyimpan token CSRF
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    form.submit();
                }
            })
        }

        function cariPendaftaran(el) {
            let kode = el.value.toUpperCase();
            const result = pendaftarans.filter(item => item.kode.includes(kode) && item.tgl_berobat === getCurdate() && item
                .is_taken == false);
            let cards = '';
            if (result.length > 0) {
                result.forEach(item => {
                    cards += card(item.id, item.kode, item.pasien.nama, item.poli_nama_poli);
                });
            } else {
                cards = `<div class="card card-body p-2 mt-2 overflow-hidden">
                    Tidak ada data yang dapat checkin
                </div>`
            }
            resC.innerHTML = cards;
        }
    </script>
@endpush
