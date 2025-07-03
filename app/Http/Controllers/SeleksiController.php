<?php

namespace App\Http\Controllers;

use App\User;
use App\Balita;
use App\Orangtua;
use App\Rekapan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SeleksiController extends Controller
{
    public function seleksi(Request $request)
    {
        $selectedPosyandu = $request->get('posyandu');

        // Ambil daftar posyandu unik
        $posyandus = Orangtua::select('posyandu')->distinct()->pluck('posyandu');

        if (auth()->user()->level == 'orangtua') {
            $balita = Balita::whereHas('orangtua.user', function ($query) {
                return $query->where('name', '=', auth()->user()->name);
            })->get();
        } elseif ($selectedPosyandu) {
            $balita = Balita::whereHas('orangtua', function ($query) use ($selectedPosyandu) {
                $query->where('posyandu', $selectedPosyandu);
            })->get();
        } else {
            $balita = collect(); // kosongkan jika belum pilih posyandu
        }

        return view('pages.seleksi.create', compact('balita', 'posyandus', 'selectedPosyandu'));
    }


    public function preferensiSAW(Request $request)
    {
        $balita = Balita::with('orangtua')->where('id', '=', $request->id_balita)->first(); // ambil seluruh data di tabel balita

        // data bobot kriteria
        $c1 = 0.25;
        $c2 = 0.25;
        $c3 = 0.25;
        $c4 = 0.25;

        // normalisasi matriks
        $max = max($balita->bobot_tbu, $balita->bobot_bbu, $balita->bobot_bbtb, $balita->bobot_imtu);
        $normal_tbu = round($balita->bobot_tbu / $max, 2);
        $normal_bbu = round($balita->bobot_bbu / $max, 2);
        $normal_bbtb = round($balita->bobot_bbtb / $max, 2);
        $normal_imtu = round($balita->bobot_imtu / $max, 2);

        // menghitung matriks nilai V
        $nilaiV = round(($c1 * $normal_tbu) + ($c2 * $normal_bbu) + ($c3 * $normal_bbtb) + ($c4 * $normal_imtu), 2);

        if ($nilaiV <= 0.25) {
            $statusGizi = 'Gizi Buruk';
        } else if (($nilaiV > 0.26) && ($nilaiV <= 0.74)) {
            $statusGizi = 'Gizi Kurang';
        } else {
            $statusGizi = 'Gizi Baik';
        }

        return view('pages.seleksi.index', compact('balita', 'normal_tbu', 'normal_bbu', 'normal_bbtb', 'normal_imtu', 'nilaiV', 'statusGizi'));
    }

    public function rekapanSAW(Request $request)
    {
        $listPosyandu = ['Pada idi', 'Padaelo', 'Melati', 'Mawar', 'Air Payau'];
        $rekapanPerPosyandu = [];

        foreach ($listPosyandu as $posyandu) {
            $balitas = Balita::with('orangtua.user')
                ->whereHas('orangtua', function ($q) use ($posyandu) {
                    $q->whereRaw('LOWER(posyandu) = ?', [strtolower($posyandu)]);
                })
                ->get();

            if ($balitas->isEmpty()) {
                $rekapanPerPosyandu[$posyandu] = null;
                continue;
            }

            $c1 = $c2 = $c3 = $c4 = $c5 = $c6 = 1 / 6;
            $nilaiV = [];

            $maxTBU = $balitas->max('bobot_tbu') ?: 1;
            $maxBBU = $balitas->max('bobot_bbu') ?: 1;
            $maxBBTB = $balitas->max('bobot_bbtb') ?: 1;
            $maxIMTU = $balitas->max('bobot_imtu') ?: 1;
            $maxLILA = $balitas->max('bobot_lila') ?: 1;
            $maxLKepala = $balitas->max('bobot_lingkarkepala') ?: 1;

            foreach ($balitas as $data) {
                $nama = $data->orangtua->nama_balita;

                $normal_tbu = round($data->bobot_tbu / $maxTBU, 2);
                $normal_bbu = round($data->bobot_bbu / $maxBBU, 2);
                $normal_bbtb = round($data->bobot_bbtb / $maxBBTB, 2);
                $normal_imtu = round($data->bobot_imtu / $maxIMTU, 2);
                $normal_lila = round($data->bobot_lila / $maxLILA, 2);
                $normal_lingkarkepala = round($data->bobot_lingkarkepala / $maxLKepala, 2);

                $nilaiV[$nama] = round(
                    $c1 * $normal_tbu +
                        $c2 * $normal_bbu +
                        $c3 * $normal_bbtb +
                        $c4 * $normal_imtu +
                        $c5 * $normal_lila +
                        $c6 * $normal_lingkarkepala,
                    2
                );
            }

            $status = ['buruk' => 0, 'kurang' => 0, 'baik' => 0];
            foreach ($nilaiV as $v) {
                if ($v <= 0.25) $status['buruk']++;
                elseif ($v <= 0.74) $status['kurang']++;
                else $status['baik']++;
            }

            $total = count($nilaiV);
            $chartBuruk = $chartKurang = $chartBaik = 0;

            if ($total > 0) {
                $chartBuruk = round(($status['buruk'] / $total) * 100, 2);
                $chartKurang = round(($status['kurang'] / $total) * 100, 2);
                $chartBaik = round(($status['baik'] / $total) * 100, 2);
            }

            $rekapanPerPosyandu[$posyandu] = [
                'balitas' => $balitas,
                'nilaiV' => $nilaiV,
                'chartBuruk' => $chartBuruk,
                'chartKurang' => $chartKurang,
                'chartBaik' => $chartBaik,
            ];
        }

        return view('pages.seleksi.rekapan', compact('rekapanPerPosyandu', 'listPosyandu'));
    }
}
