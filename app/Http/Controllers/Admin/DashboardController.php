<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $greeting = 'Good';
        if (date('H') >= 5 && date('H') < 12) {
            $greeting = 'Good Morning';
        } elseif (date('H') >= 12 && date('H') < 15) {
            $greeting = 'Good Afternoon';
        } elseif (date('H') >= 15 && date('H') < 18) {
            $greeting = 'Good Evening';
        } else {
            $greeting = 'Good Night';
        }

        $start = now()->startOfWeek()->format('Y-m-d');
        $end = now()->endOfWeek()->format('Y-m-d');
        $nWeek = [
            'total' => 0,
            'taken' => 0,
            'not_taken' => 0,
        ];
        $nNow = [
            'total' => 0,
            'taken' => 0,
            'not_taken' => 0,
        ];
        Pendaftaran::select('is_taken', 'tgl_berobat')
            ->whereDate('tgl_berobat', '>=', $start)
            ->whereDate('tgl_berobat', '<=', $end)
            ->get()
            ->each(function ($item) use (&$nWeek, &$nNow) {
                if ($item->tgl_berobat == date('Y-m-d')) {
                    $nNow['total'] += 1;
                    if ($item->is_taken == true) {
                        $nNow['taken'] += 1;
                    } else {
                        $nNow['not_taken'] += 1;
                    }
                }
                $nWeek['total'] += 1;
                if ($item->is_taken == true) {
                    $nWeek['taken'] += 1;
                } else {
                    $nWeek['not_taken'] += 1;
                }
            });


        $pasiens = Pendaftaran::select('is_taken')
            ->whereDate('tgl_berobat', now())
            ->withAggregate('pasien', 'nama')
            ->withAggregate('poli', 'nama_poli')
            ->get();

        $countPendaftaran = Pendaftaran::select(DB::Raw('polis.nama_poli, count("id") as total'))
            ->groupBy('poli_id')
            ->join('polis', 'poli_id', '=', 'polis.id')
            ->get();

        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);
        $calendar = $this->getCalendar($year, $month);
        $dow = Carbon::parse("$year-$month-01")->dayOfWeek;
        // dd($dow);
        return view("admin.dashboard", compact([
            'greeting',
            'countPendaftaran',
            'pasiens',
            'nWeek',
            'nNow',
            'dow',
            'calendar'
        ]));
    }
    function getCalendar($year, $month)
    {
        $pendaftarans = Pendaftaran::select(DB::raw('tgl_berobat, count("tgl_berobat") as total'))
            ->whereMonth('tgl_berobat', $month)
            ->whereYear('tgl_berobat', $year)
            ->groupBy('tgl_berobat')
            ->get();
        $som = Carbon::parse("$year-$month-01");
        $eom = $som->copy()->endOfMonth();
        $total = [];
        while ($som->lt($eom)) {
            $res = $pendaftarans->filter(function ($item) use ($som) {
                return $item->tgl_berobat == $som->copy()->format('Y-m-d');
            });
            array_push(
                $total,
                $res->first() ? $res->first()->total : 0
            );
            $som->addDay();
        }
        return $total;
    }
}
