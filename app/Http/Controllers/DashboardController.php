<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->user()->role === 'admin') {
            return view('admin.dashboard', [
                'stats' => [
                    'Dosen' => Dosen::count(),
                    'Mahasiswa' => Mahasiswa::count(),
                    'Mata Kuliah' => MataKuliah::count(),
                    'Jadwal' => Jadwal::count(),
                    'KRS' => Krs::count(),
                ],
                'chartLabels' => MataKuliah::orderBy('semester')->pluck('nama_mk'),
                'chartData' => MataKuliah::withCount('jadwals')->orderBy('semester')->pluck('jadwals_count'),
            ]);
        }

        if ($request->user()->role === 'dosen') {
            $dosen = Dosen::where('email', $request->user()->email)->first();
            abort_unless($dosen, 403, 'Profil dosen belum dibuat admin.');

            $jadwals = $dosen->jadwals()->with('mataKuliah')->get();

            return view('dosen.dashboard', [
                'dosen' => $dosen,
                'jadwals' => $jadwals,
            ]);
        }

        $mahasiswa = $request->user()->mahasiswa;
        abort_unless($mahasiswa, 403, 'Profil mahasiswa belum dibuat admin.');

        $krs = $mahasiswa->krs()->with('jadwal.mataKuliah', 'jadwal.dosen')->get();
        $hariIni = [
            'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu',
        ][Carbon::now()->englishDayOfWeek] ?? 'Senin';

        return view('mahasiswa.dashboard', [
            'mahasiswa' => $mahasiswa,
            'totalSks' => $krs->sum(fn ($item) => $item->jadwal->mataKuliah->sks),
            'jadwalHariIni' => $krs->filter(fn ($item) => $item->jadwal->hari === $hariIni),
        ]);
    }
}
