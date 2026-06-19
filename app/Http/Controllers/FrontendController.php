<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AkreditasiInstitusi;
use App\Models\AkreditasiProdi;
use App\Models\Dosen;
use App\Models\Tendik;
use App\Models\BukuAkademik;

class FrontendController extends Controller
{
    public function pdptHome()
    {
        $stats = [
            'akreditasi_institusi' => AkreditasiInstitusi::where('status', 'Aktif')->count(),
            'akreditasi_prodi' => AkreditasiProdi::count(),
            'dosen' => Dosen::count(),
            'tendik' => Tendik::count()
        ];

        $chartData = [
            'akred' => AkreditasiProdi::select('peringkat', \DB::raw('count(*) as total'))->groupBy('peringkat')->get(),
            'jenjang' => AkreditasiProdi::select('prodi')->get()->map(function($p) {
                if (preg_match('/-\s*([S123D]+)/i', $p->prodi, $matches)) {
                    return strtoupper($matches[1]);
                }
                return 'Lainnya';
            })->countBy(),
            'dosen' => Dosen::select('jabatan', 'jabatan_terakhir')->get()
                ->map(function($d) {
                    $jab = trim($d->jabatan_terakhir ?: $d->jabatan ?: 'Lainnya');
                    return $jab === '' ? 'Lainnya' : $jab;
                })
                ->countBy()
                ->map(function($count, $jab) {
                    return [
                        'jabatan_akademik' => $jab,
                        'total' => $count
                    ];
                })
                ->values(),
            'tendik' => Tendik::select('status_kepegawaian')->get()
                ->map(function($t) {
                    $status = trim($t->status_kepegawaian ?: 'Lainnya');
                    return $status === '' ? 'Lainnya' : $status;
                })
                ->countBy()
                ->map(function($count, $status) {
                    return [
                        'status_pegawai' => $status,
                        'total' => $count
                    ];
                })
                ->values(),
        ];

        return view('pdpt.home', compact('stats', 'chartData'));
    }

    public function akreditasiInstitusi()
    {
        $data = AkreditasiInstitusi::orderBy('tahun_sk', 'desc')->get();
        $prodiStats = [
            'total' => AkreditasiProdi::count(),
            'unggul' => AkreditasiProdi::where('peringkat', 'Unggul')->count(),
            'a' => AkreditasiProdi::where('peringkat', 'A')->count(),
            'b' => AkreditasiProdi::where('peringkat', 'B')->count(),
            'proses' => AkreditasiProdi::whereIn('peringkat', ['Proses', 'Dalam Proses', '-', ''])->count(),
        ];
        return view('pdpt.akreditasi-institusi', compact('data', 'prodiStats'));
    }

    public function akreditasiProdi()
    {
        $data = AkreditasiProdi::orderBy('fakultas')->orderBy('prodi')->get()->map(function($item) {
            return [
                'fak' => $item->fakultas,
                'prodi' => $item->prodi,
                'akred' => $item->peringkat,
                'thn' => $item->tahun_sk,
                'noSert' => $item->no_sk ?? '-',
                'tglAkred' => $item->tanggal_sk ? \Carbon\Carbon::parse($item->tanggal_sk)->format('Y-m-d') : '-',
                'expired' => $item->tanggal_kadaluarsa ? \Carbon\Carbon::parse($item->tanggal_kadaluarsa)->format('Y-m-d') : '-',
            ];
        });
        return view('pdpt.akreditasi-prodi', compact('data'));
    }

    public function dataDosen()
    {
        $data = Dosen::orderBy('fakultas')->orderBy('nama')->get()->map(function($item) {
            // Extract golongan from pangkat_terakhir if empty (e.g. "Pembina (IV/a)")
            $gol = $item->golongan;
            if (empty($gol) && !empty($item->pangkat_terakhir)) {
                if (preg_match('/\(([^)]+)\)/', $item->pangkat_terakhir, $matches)) {
                    $gol = $matches[1];
                }
            }

            // Extract pangkat from pangkat_terakhir if empty
            $pangkat = $item->pangkat;
            if (empty($pangkat) && !empty($item->pangkat_terakhir)) {
                $pangkat = trim(preg_replace('/\s*\([^)]+\)/', '', $item->pangkat_terakhir));
            }

            return [
                'fak' => $item->fakultas ?? '-',
                'prodi' => $item->prodi ?? '-',
                'nama' => $item->nama,
                'pendidikan' => $item->pendidikan_terakhir ?? '-',
                'gol' => $gol ?? '-',
                'pangkat' => $pangkat ?? '-',
                'jabatan' => ($item->jabatan ?: $item->jabatan_terakhir) ?? '-',
                'status' => $item->status_kepegawaian ?? 'PNS',
            ];
        });
        return view('pdpt.data-dosen', compact('data'));
    }

    public function dataTendik()
    {
        $data = Tendik::orderBy('unit_kerja')->orderBy('nama')->get()->map(function($item) {
            return [
                'nama' => $item->nama,
                'nip' => $item->nip ?? '-',
                'gol' => $item->golongan ?? '-',
                'pangkat' => $item->pangkat ?? '-',
                'unitKerja' => $item->unit_kerja,
                'status' => $item->status_kepegawaian ?? 'PNS',
            ];
        });
        return view('pdpt.data-tendik', compact('data'));
    }

    public function rekapDosen()
    {
        $dosen = Dosen::all();
        $fakultasGroups = $dosen->groupBy('fakultas');
        $data = [];
        foreach ($fakultasGroups as $fak => $items) {
            $data[] = [
                'unit' => $fak,
                'pns' => $items->where('status_kepegawaian', 'PNS')->count(),
                'cpns' => $items->where('status_kepegawaian', 'CPNS')->count(),
                'kontrak' => $items->where('status_kepegawaian', 'Kontrak')->count(),
                'tetapNonPns' => $items->where('status_kepegawaian', 'Tetap Non PNS')->count(),
            ];
        }
        return view('pdpt.rekap-dosen', compact('data'));
    }

    public function rekapTendik()
    {
        $tendik = Tendik::all();
        $unitGroups = $tendik->groupBy('unit_kerja');
        $data = [];
        foreach ($unitGroups as $unit => $items) {
            $data[] = [
                'unit' => $unit,
                'pns' => $items->where('status_kepegawaian', 'PNS')->count(),
                'cpns' => $items->where('status_kepegawaian', 'CPNS')->count(),
                'kontrak' => $items->where('status_kepegawaian', 'Kontrak')->count(),
            ];
        }
        return view('pdpt.rekap-tendik', compact('data'));
    }

    public function bukuInfoAkademik()
    {
        $data = BukuAkademik::orderBy('start_year', 'desc')->orderBy('semester')->get();
        return view('pdpt.buku-info-akademik', compact('data'));
    }

    public function tentang()
    {
        return view('pdpt.tentang');
    }
}
