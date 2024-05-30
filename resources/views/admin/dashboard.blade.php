@extends('layouts.admin.app', [
    'title' => 'Dashboard',
])
@push('css')
    <style>
        td {
            padding: .5rem 0;

        }

        tr td:not(tr:last-child td) {
            border-bottom: 1px solid #ccc
        }

        .table.calendar td {
            height: 7rem;
            pad
        }
    </style>
@endpush
@section('main')
    <div class="">

        <section class="pt-4 px-4">
            <h2>Halo {{ auth()->user()->name }}</h2>
            <p>{{ $greeting }}, Have a nice day :)</p>
        </section>
        <section class=" p-4">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <h4 class="text-success">Pasien Hari Ini</h4>
                    <div class="bg-white overflow-hidden px-3" style="border-radius: 1rem">
                        @if ($pasiens->count() > 0)
                            <table class="" style="width: 100%">
                                @foreach ($pasiens as $pasien)
                                    <tr>
                                        <td>
                                            <div st>{{ $pasien->pasien_nama }}</div>
                                            <div style="font-size: .75rem"">{{ $pasien->poli_nama_poli }}</div>
                                        </td>
                                        <td class="text-right">
                                            <span
                                                class="badge p-2 {{ $pasien->is_taken ? 'badge-success' : 'badge-danger' }}">
                                                {{ $pasien->is_taken ? 'Hadir' : 'Tidak Hadir' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        @else
                            <div class="d-flex align-items-center justify-content-center p-5">
                                Belum ada pasien hari ini
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="text-success">Total Pendaftaran</h4>
                    <div class="bg-white overflow-hidden px-3" style="border-radius: 1rem">
                        <table class="" style="width: 100%">
                            <tr>
                                <td class="align-middle">Hari Ini</td>
                                <td class="text-center">
                                    <h1 class="m-0" style="line-height: 2.25rem">{{ $nNow['total'] }}</h1>
                                    <div style="font-size: .75rem">Pendaftaran</div>
                                </td>
                                <td class="text-center">
                                    <h1 class="m-0 text-success" style="line-height: 2.25rem">{{ $nNow['taken'] }}</h1>
                                    <div style="font-size: .75rem">Hadir</div>
                                </td>
                                <td class="text-center">
                                    <h1 class="m-0 text-danger" style="line-height: 2.25rem">{{ $nNow['not_taken'] }}</h1>
                                    <div style="font-size: .75rem">Tidak Hadir</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">Minggu Ini</td>
                                <td class="text-center">
                                    <h1 class="m-0" style="line-height: 2.25rem">{{ $nWeek['total'] }}</h1>
                                    <div style="font-size: .75rem">Pendaftaran</div>
                                </td>
                                <td class="text-center">
                                    <h1 class="m-0 text-success" style="line-height: 2.25rem">{{ $nWeek['taken'] }}</h1>
                                    <div style="font-size: .75rem">Hadir</div>
                                </td>
                                <td class="text-center">
                                    <h1 class="m-0 text-danger" style="line-height: 2.25rem">{{ $nWeek['not_taken'] }}</h1>
                                    <div style="font-size: .75rem">Tidak Hadir</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white p-4">
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <h4 class="text-success">Jumlah Pasien Tiap Poli</h4>
                    <div class="d-flex flex-column" style="gap: 1rem">
                        @forelse ($countPendaftaran as $item)
                            <div class="bg-success p-3 justify-content-between d-flex flex-shrink-0"
                                style="gap:1rem;important;border-radius: 1rem">
                                <div class="text-white" style="white-space: normal">{{ $item->nama_poli }}</div>
                                <h1 class="text-white m-0" style="line-height: 2.25rem">{{ $item->total }}</h1>
                            </div>
                        @empty
                            <div class="bg-success p-3 justify-content-between d-flex flex-shrink-0"
                                style="gap:1rem; width: 200px !important;border-radius: 1rem">
                                <div class="text-white" style="white-space: normal">
                                    Belum ada data
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="col-lg-8 mb-5">
                    <h4 class="text-success">Jumlah Pasien Tiap Tanggal</h4>
                    <div class="table-responsive">

                        <table class="table table-bordered calendar">
                            <thead>
                                <tr>
                                    <th class="py-1">Minggu</th>
                                    <th class="py-1">Senin</th>
                                    <th class="py-1">Selasa</th>
                                    <th class="py-1">Rabu</th>
                                    <th class="py-1">Kamis</th>
                                    <th class="py-1">Jum'at</th>
                                    <th class="py-1">Sabtu</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $tgl = 1;
                                    $start = false;
                                @endphp
                                @for ($i = 0; $i < ceil(count($calendar) / 7); $i++)
                                    <tr>
                                        @for ($j = 0; $j < 7; $j++)
                                            @if (!$start)
                                                @if ($j == $dow)
                                                    <td>
                                                        <div class="d-flex h-100 flex-column justify-content-between">
                                                            {{ $tgl++ }}
                                                            <h1 class="text-{{ $calendar[$tgl - 2] > 0 ? 'success' : 'secondary' }} m-0 text-right"
                                                                style="line-height: 100%">
                                                                {{ $calendar[$tgl - 2] }}
                                                            </h1>
                                                        </div>
                                                    </td>
                                                    @php
                                                        $start = true;
                                                    @endphp
                                                @else
                                                    <td></td>
                                                @endif
                                            @else
                                                @if ($tgl > count($calendar))
                                                    <td></td>
                                                @else
                                                    <td>
                                                        <div class="d-flex h-100 flex-column justify-content-between">
                                                            {{ $tgl++ }}
                                                            <h1 class="text-{{ $calendar[$tgl - 2] > 0 ? 'success' : 'secondary' }} m-0 text-right"
                                                                style="line-height: 100%">
                                                                {{ $calendar[$tgl - 2] }}
                                                            </h1>
                                                        </div>
                                                    </td>
                                                @endif
                                            @endif
                                        @endfor
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
