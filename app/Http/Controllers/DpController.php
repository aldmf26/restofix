<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Dp;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DpController extends Controller
{
    public function index(Request $request)
    {
        $id_user = Auth::user()->id;
        $id_menu = DB::table('tb_permission')->select('id_menu')->where('id_user',$id_user)
        ->where('id_menu', 8)->first();
        if(empty($id_menu)) {
            return back();
        } else {
            $data = [
                'title' => 'DP',
                'logout' => $request->session()->get('logout'),
                'dp' => Dp::where('id_lokasi', $request->session()->get('id_lokasi'))->orderBy('id_dp', 'desc')->get(),
            ];
    
            return view('dp.dp', $data);
        }
    }

    public function addDp(Request $request)
    {
        $id_lokasi = $request->session()->get('id_lokasi');
        if($id_lokasi == 1) {
            $c = 'TKMRDP';
            $kd_dp = $c . rand(10,1000);
        } else {
            $c = 'SDBDP';
            $kd_dp = $c . rand(10,1000);
        }
       $metode = $request->metode;
       $jumlah = $request->jumlah;
       $tgl = $request->tgl;
        $data = [
            'kd_dp' => $kd_dp,
            'nm_customer' => $request->nm_customer,
            'jumlah' => $jumlah,
            'server' => Auth::user()->nama,
            'tgl' => $tgl,
            'ket' => $request->ket,
            'metode' => $metode,
            'tgl_input' => date('Y-m-d'),
            'status' => $request->status,
            'id_lokasi' => $id_lokasi,
        ];

        Dp::create($data);
        $id_akunPDD = $id_lokasi == 1 ? '174' : '175';
        $id_akunKAS = $id_lokasi == 1 ? '68' : '106';
        $id_akunBCA = $id_lokasi == 1 ? '66' : '104';
        $id_akunMANDIRI = $id_lokasi == 1 ? '67' : '105';
        $tagal = date('Y-m-d');
        $month = date('m', strtotime($tagal));
        $year = date('Y', strtotime($tagal));

        $pdd = Akun::where('id_akun', $id_akunPDD)->first();
        $kas = Akun::where('id_akun', $id_akunKAS)->first();
        $bca = Akun::where('id_akun', $id_akunBCA)->first();
        $mandiri = Akun::where('id_akun', $id_akunMANDIRI)->first();
        if($metode == 'CASH') {
            $kode_akun = Jurnal::where('id_akun', $kas->id_akun)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();
            if ($kode_akun == 0) {
                $kode_akun = 1;
            } else {
                $kode_akun += 1;
            }
            $id_akun = $kas->id_akun;
            $kd_akun = $kas->kd_akun;
        } elseif($metode == 'MANDIRI'){
            $kode_akun = Jurnal::where('id_akun', $mandiri->id_akun)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();
            if ($kode_akun == 0) {
                $kode_akun = 1;
            } else {
                $kode_akun += 1;
            }
            $id_akun = $mandiri->id_akun;
            $kd_akun = $mandiri->kd_akun;
        } else {
            $kode_akun = Jurnal::where('id_akun', $bca->id_akun)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();
            if ($kode_akun == 0) {
                $kode_akun = 1;
            } else {
                $kode_akun += 1;
            }
            $id_akun = $bca->id_akun;
            $kd_akun = $bca->kd_akun;
        }
        $dataDebit = [
            'id_buku' => 1,
                'id_lokasi' => $id_lokasi,
                'id_akun' => $id_akun,
                'kd_gabungan' => $kd_dp,
                'no_nota' => $kd_akun . date('Y-m') . '-' . $kode_akun,
                'debit' => $jumlah,
                'kredit' => 0,
                'tgl' => date('Y-m-d'),
                'ket' => $kd_dp,
                'admin' => Auth::user()->nama,
        ];
        Jurnal::create($dataDebit);

        $dataKredit = [
            'id_buku' => 1,
                'id_lokasi' => $id_lokasi,
                'id_akun' => $pdd->id_akun,
                'kd_gabungan' => $kd_dp,
                'no_nota' => $pdd->kd_akun . date('Y-m') . '-' . $kode_akun,
                'debit' => 0,
                'kredit' => $jumlah,
                'tgl' => date('Y-m-d'),
                'ket' => $kd_dp,
                'admin' => Auth::user()->nama,
        ];
        Jurnal::create($dataKredit);
        return redirect()->route('dp')->with('sukses', 'Tambah Dp Sukses');
    }

    public function delDp(Request $r)
    {
        $id_dp = $r->id_dp;
        $kd_dp = $r->kd_dp;

        Dp::where('id_dp', $id_dp)->delete();
        Jurnal::where('kd_gabungan', $kd_dp)->delete();
        return redirect()->route('dp')->with('error', 'Hapus Dp Sukses');
    }
}
