@extends('layouts.admin.app', [
    'title' => 'Kritik & Saran',
])
@section('main')
    <div class="p-0 p-sm-3">
        <section>
            <div class="card card-body border-0 shadow">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="m-0">Kritik & Saran</h4>
                </div>
                <div class=" table-responsive">
                    <table class="table" style="width: 100%" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Topik</th>
                                <th class="aksi" style="min-width: 10px !important">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kritik_sarans as $i => $kritik_saran)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $kritik_saran->nama }}</td>
                                    <td>{{ $kritik_saran->topik }}</td>
                                    <td>
                                        <button class="btn btn-success" onclick="openDetail({{ $kritik_saran->id }})">
                                            More
                                        </button>
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
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Kritik & Saran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item py-2">
                            <div class="d-flex align-items-center">
                                <span style="width: 15rem">Nama Pengirim</span>
                                <span class="font-weight-bolder text-success" id="dNama"></span>
                            </div>
                        </li>
                        <li class="list-group-item py-2">
                            <div class="d-flex align-items-center">
                                <span style="width: 15rem">Email</span>
                                <span class="font-weight-bolder text-success" id="dEmail"></span>
                            </div>
                        </li>
                        <li class="list-group-item py-2">
                            <div class="d-flex align-items-center">
                                <span style="width: 15rem">No. Telepon</span>
                                <span class="font-weight-bolder text-success" id="dNo_tlp"></span>
                            </div>
                        </li>
                        <li class="list-group-item py-2">
                            <div class="d-flex align-items-center">
                                <span style="width: 15rem">Topik</span>
                                <span class="font-weight-bolder text-success" id="dTopik"></span>
                            </div>
                        </li>
                        <li class="list-group-item py-2">
                            <div>Pesan</div>
                            <p class="font-weight-bolder text-success" id="dPesan"></p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/v/bs4/dt-2.0.7/datatables.min.js"></script>
    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        })
        const kritik_sarans = @json($kritik_sarans);

        function openDetail(id) {
            const result = kritik_sarans.filter(item => item.id === id);
            if (result.length > 0) {
                const detail = result[0];
                document.getElementById('dNama').textContent = detail.nama;
                document.getElementById('dEmail').textContent = detail.email;
                document.getElementById('dNo_tlp').textContent = detail.no_tlp;
                document.getElementById('dTopik').textContent = detail.topik;
                document.getElementById('dPesan').textContent = detail.pesan;
                $('#detailModal').modal('show');
            } else {
                console.log(`No entry found with ID: ${id}`);
            }
        }
    </script>
@endpush
