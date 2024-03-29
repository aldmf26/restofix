<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Harga;
use App\Models\Jurnal;
use App\Models\Karyawan;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Orderan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MejaController extends Controller
{
    public function index(Request $request)
    {
        $id_user = Auth::user()->id;
        $id_menus = DB::table('tb_permission')->select('id_menu')->where('id_user', $id_user)
            ->where('id_menu', 26)->first();
            if(empty($id_menus)) {              
                return back();
            } else {
                if (empty($request->id)) {
                    $id = '1';
                } else {
                    $id = $request->id;
                }
                $tgl = date('Y-m-d');
                $lokasi = $request->session()->get('id_lokasi');
                
                $data = [
                    'title' => 'Meja',
                    'logout' => $request->session()->get('logout'),
                    'id' => $id,
                    'menu' => DB::table('view_menu')
                        ->where('id_distribusi', $id == 1 || $id == 3 ? 1 : 2)
                        ->where('akv', 'on')
                        ->where('lokasi', $lokasi)
                        ->get(),
                    'loc' => $lokasi,
                    'tgl' => date('Y-m-d'),
                ];
        
                return view('meja.meja', $data);
            }      
    }

    public function distribusi(Request $request)
    {
        $id = $request->id;
        $tgl = date('Y-m-d');
        $lokasi = $request->session()->get('id_lokasi');
        $distribusi = DB::select(
            DB::raw("SELECT a.*, c.jumlah
            FROM tb_distribusi AS a 
            LEFT JOIN (SELECT b.id_distribusi , COUNT(b.id_order) AS jumlah
            FROM tb_order AS b
            WHERE b.selesai = 'diantar' and b.id_lokasi = '$lokasi' AND void = 0
            GROUP BY b.id_distribusi
            ) c ON c.id_distribusi = a.id_distribusi"),
        );
        $orderan = DB::select(
            DB::raw(
                "SELECT 
            COUNT(id_order) as jml_order 
            FROM tb_order as a 
            WHERE a.id_lokasi = '$lokasi' AND a.id_distribusi = '$id' AND selesai = 'diantar' AND void = 0 
            group by a.id_distribusi",
            ),
        );
        $data = [
            'title' => 'Menu | Buku Tugas',
            'distribusi' => $distribusi,
            'orderan' => $orderan,
            'id' => $id,
        ];

        return view('meja.distribusi', $data);
    }

    public function waitress(Request $request)
    {
        $loc = $request->session()->get('id_lokasi');
        $tgl = date('Y-m-d');


        if (empty($request->dis)) {
            $id_distribusi = '1';
        } else {
            $id_distribusi = $request->dis;
        }

        if ($id_distribusi == '3') {
            $waitress = DB::select(
                DB::raw(
                    "SELECT a.* , b.nama FROM tb_absen as a left join tb_karyawan as b on a.id_karyawan = b.id_karyawan
                     WHERE a.tgl = '$tgl' and b.id_posisi != '5' and a.id_lokasi = '$loc'",
                ),
            );
        } else {
            $waitress = DB::select(
                DB::raw(
                    "SELECT a.* , b.nama FROM tb_absen as a left join tb_karyawan as b on a.id_karyawan = b.id_karyawan
                     WHERE a.tgl = '$tgl' and b.id_posisi = '5' and a.id_lokasi = '$loc'",
                ),
            );
        }

        $meja = DB::select(
            DB::raw(
                "SELECT a.id_meja, c.nm_meja, a.no_order, RIGHT(a.no_order,2) AS kd, b.nm_distribusi,a.selesai,
                a.pengantar,  SUM(a.qty) AS qty1 ,  e.qty2 , min(a.print) as prn , min(a.copy_print) as c_prn, MIN(a.j_mulai) as jam_datang, timestampdiff(MINUTE, MIN(a.j_mulai), MAX(a.wait)) as total_jam_pesan
        FROM tb_order AS a
        left join tb_meja as c on c.id_meja = a.id_meja
        LEFT JOIN tb_distribusi AS b ON b.id_distribusi = a.id_distribusi
        LEFT JOIN ( 
        SELECT d.no_order , SUM(d.qty) qty2 FROM tb_order2 AS d 
        GROUP BY d.no_order
        ) AS e ON e.no_order = a.no_order
        WHERE a.aktif = '1' and  a.id_lokasi = '$loc' and a.id_distribusi = '$id_distribusi' AND a.void = 0
        group by a.no_order order by a.id_distribusi , a.id_meja  ASC",
            ),
        );

        $data = [
            'meja' => $meja,
            'waitress' => $waitress,
            'loc' => $loc,
            'id' => $id_distribusi,
        ];

        return view('meja.waitress', $data)->render();
    }

    public function pilih_waitress(Request $request)
    {
        date_default_timezone_set('Asia/Makassar');
        $id_order = $request->kode;
        $waitress = $request->kry;
        $id = $request->id;

        $data = [
            'pengantar' => $waitress,
            'wait' => date('Y-m-d H:i:s'),
        ];
        Orderan::where('id_order', $id_order)->update($data);
    }

    public function un_waitress(Request $request)
    {
        $id_order = $request->kode;
        $data = [
            'pengantar' => '',
        ];
        Orderan::where('id_order', $id_order)->update($data);
    }
    public function meja_selesai(Request $request)
    {
        $id_order = $request->kode;
        $data = [
            'selesai' => 'selesai',
        ];
        Orderan::where('id_order', $id_order)->update($data);
    }
    public function tambah_pesanan(Request $request)
    {
        $lokasi = $request->session()->get('id_lokasi');
        $no_order = $request->no;
        $id = $request->id;

        $order = DB::table('tb_order')
            ->where('no_order', $no_order)
            ->where('id_lokasi', $lokasi)
            ->groupBy('no_order')
            ->first();

        $data = [
            'order' => $order,
            'menu' => DB::table('view_menu')
                ->where('id_distribusi', $id == 1 || $id == 3 ? 1 : 2)
                ->where('akv', 'on')
                ->where('lokasi', $lokasi)
                ->get(),
            'loc' => $lokasi,
            'tgl' => date('Y-m-d'),
        ];

        return view('meja.tbh_menu', $data)->render();
    }

    public function get_harga(Request $request)
    {
        $id_harga = $request->id_harga;
        $dp = DB::table('tb_harga')
            ->where('id_harga', $id_harga)
            ->first();
        
        echo "$dp->harga";
    }
    
    public function get_karyawan(Request $request)
    {

        $loc = $request->session()->get('id_lokasi');
        $tgl = date('Y-m-d');
        $karyawan = DB::select("SELECT a.* , b.nama FROM tb_absen as a left join tb_karyawan as b on
                    a.id_karyawan = b.id_karyawan
                    WHERE a.tgl = '$tgl' and b.id_posisi in('5','15','16') and a.id_lokasi = '$loc'");
        echo '<div class="row">';
        foreach ($karyawan as $key => $value) {
            echo '<div class="col-lg-2 col-4">
                            <label class="btn btn-default buying-selling">
                            <div class="checkbox-group required">
                                <input type="radio"  name="admin" value="' . $value->nama . '" autocomplete="off" class="cart_id_karyawan option1">
                            </div>	
                                <span class="radio-dot"></span>
                                <span class="buying-selling-word">' . $value->nama . '</span>
                            </label>
                            </div>';
        }
        echo   '</div>';
    }

    public function get_user(Request $request)
    {
        $admin = $request->admin;
        $loc = $request->session()->get('id_lokasi');
        $tgl = date('Y-m-d');
        $karyawan = Karyawan::whereIn('id_posisi', [5,15,16])->get();
        echo '<div class="row">';
        foreach ($karyawan as $key => $value) {
            if($admin == $value->nama) {
                $aktif = "active";
            } else {
                $aktif = '';
            }
            echo '<div class="col-lg-2 col-4">
                            <label class="btn btn-default buying-selling '.$aktif.'">
                            <div class="checkbox-group required">
                                <input type="radio"  name="admin" value="' . $value->nama . '" autocomplete="off" class="cart_id_karyawan option1">
                            </div>	
                                <span class="radio-dot"></span>
                                <span class="buying-selling-word">' . $value->nama . '</span>
                            </label>
                            </div>';
        }
        echo   '</div>';
    }

    public function get_karyawanExport(Request $request)
    {
        // $admin = $request->admin;
        // $loc = $request->session()->get('id_lokasi');
        $tgl = date('Y-m-d');
        $karyawan = Karyawan::all();
        echo '<div class="row">';
        foreach ($karyawan as $key => $value) {
            echo '<div class="col-lg-2 col-4">
                            <label class="btn btn-default buying-selling">
                            <div class="checkbox-group required">
                                <input type="check"  name="admin" value="' . $value->nama . '" autocomplete="off" class="cart_id_karyawan option1">
                            </div>	
                                <span class="radio-dot"></span>
                                <span class="buying-selling-word">' . $value->nama . '</span>
                            </label>
                            </div>';
        }
        echo   '</div>';
    }

    public function save_pesanan(Request $request)
    {
        $id_dis = $request->id_dis;
        $kd_order = $request->kd_order;
        $orang = $request->orang;
        $harga = $request->harga;
        $qty = $request->qty;
        $req = $request->req;
        $id_harga = $request->id_harga;
        $meja = $request->meja;
        $admin = $request->admin;
        $id_lokasi = $request->session()->get('id_lokasi');

        for ($i = 0; $i < sizeof($id_harga); $i++) {
            if ($qty[$i] == '' || $qty[$i] == '0') {
            } else {
                $menu = DB::table('view_menu as a')->where('id_harga', $id_harga[$i])->get();
                foreach($menu as $m)
                {
                    $cekStok = DB::table('tb_resep')->where('id_menu', $m->id_menu)->get();
                }
                foreach($cekStok as $c) {
                    $t = DB::selectOne("SELECT sum(a.debit_makanan - a.kredit_makanan) as ttl, b.nm_bahan, c.n FROM `tb_stok_makanan` as a
                    LEFT JOIN tb_list_bahan as b on a.id_list_bahan = b.id_list_bahan
                    LEFT JOIN tb_satuan as c on b.id_satuan = c.id
                    WHERE a.id_lokasi = '$id_lokasi' AND b.id_list_bahan = '$c->id_list_bahan'
                    GROUP BY a.id_list_bahan");
        
                    if(empty($t)) {
                        echo 'stok kurang';
                        exit();
                    } else {
                        if($t->ttl < ($c->qty * $qty[$i])) {
                            echo 'stok kurang';
                            exit();
                        }
                    }
                }
                
                for ($q = 1; $q <= $qty[$i]; $q++) {                    
                    $dt_harga = Harga::where('id_harga', $id_harga[$i])->first();
                    $data = [
                        'no_order' => $kd_order,
                        'id_harga' => $id_harga[$i],
                        'qty' => 1,
                        'harga' => $dt_harga->harga,
                        'request' => $req[$i],
                        'orang' => $orang,
                        'id_meja' => $meja,
                        'id_distribusi' => $id_dis,
                        'id_lokasi' => $id_lokasi,
                        'tgl' => date('Y-m-d'),
                        'admin' => $admin == '' ? Auth::user()->nama : $admin,
                        'j_mulai' => date('Y-m-d H:i:s'),
                        'selesai' => 'dimasak',
                        'aktif' => '1',
                    ];
                    Orderan::create($data);
                }
            }
        }
    }

    public function edit_pembayaran(Request $request)
    {
        $no_order = $request->no_order;
        $cash = $request->cash;
        $d_bca = $request->d_bca;
        $k_bca = $request->k_bca;
        $d_mandiri = $request->d_mandiri;
        $k_mandiri = $request->k_mandiri;

        // $jenis = $request->jenis;
        // $lokasi = $request->session()->get('id_lokasi');
        // $debca = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Bank BCA']])->first();
        // $krbca = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Piutang BCA']])->first();
        // $dmandiri = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Bank Mandiri']])->first();
        // $kamndiri = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Piutang Mandiri']])->first();
        // $kas = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Kas']])->first();

        // if($jenis == 'cash') {
        //     $id_akun = $kas->id_akun;
        // } elseif($jenis == 'd_bca') {
        //     $id_akun = $debca->id_akun;
        // } elseif($jenis == 'k_bca') {
        //     $id_akun = $krbca->id_akun;
        // }elseif($jenis == 'd_mandiri') {
        //     $id_akun = $dmandiri->id_akun;
        // }elseif($jenis == 'k_mandiri') {
        //     $id_akun = $kamndiri->id_akun;
        // }

        // $cek = Jurnal::where([['kd_gabungan', $no_order], ['id_akun', $id_akun]])->first();

        // $id_akunDiedit = $cek->id_akun;
        
        $data = [
            'cash' => $cash,
            'd_bca' => $d_bca,
            'k_bca' => $k_bca,
            'd_mandiri' => $d_mandiri,
            'k_mandiri' => $k_mandiri,
            'total_bayar' => $cash + $d_bca + $k_bca + $d_mandiri + $k_mandiri,
        ];
        Transaksi::where('no_order', $no_order)->update($data);

        // if($cash > 0) {
        //     $id_akun2 = $kas->id_akun;
        // } elseif($d_bca > 0) {
        //     $id_akun2 = $debca->id_akun;
        // } elseif($k_bca > 0) {
        //     $id_akun2 = $krbca->id_akun;
        // } elseif($d_mandiri > 0) {
        //     $id_akun2 = $dmandiri->id_akun;
        // } elseif($k_mandiri > 0) {
        //     $id_akun2 = $kamndiri->id_akun;
        // }
        
        // Jurnal::where([['kd_gabungan', $no_order], ['id_akun', $id_akunDiedit]])->update(['id_akun' => $id_akun2]);
        
        

        echo'success';
    }

    public function get_pembayaran(Request $request)
    {
        $no_order = $request->no_order;
        $data = [
            'dt_pembayaran' => Transaksi::where('no_order', $no_order)->first(),
            'no_order' => $no_order
        ];
        return view('meja.edit_pembayaran', $data);
    }

    public function clear(Request $request)
    {
        $id_order = $request->kode;
        $data = array(
            'aktif'   => '2',
        );

        DB::table('tb_order')->where('no_order', $id_order)->update($data);
    }

    public function check_pembayaran(Request $request)
    {
        
    }

    public function bill(Request $request)
    {
        $id = $request->no;
        $order =  DB::select(
            DB::raw("SELECT a.id_order, b.nm_menu, SUM(a.qty) as qty, a.request, c.nama AS koki1 , d.nama AS koki2, e.nama AS koki3, 
            a.pengantar, a.id_meja, a.j_mulai, a.j_selesai, a.wait, a.selesai, a.harga,
            timestampdiff(MINUTE, a.j_mulai,a.wait) AS selisih, a.ongkir, a.id_distribusi
            FROM tb_order as a 
            left join view_menu as b on a.id_harga = b.id_harga 
            left join tb_karyawan as c on c.id_karyawan = a.id_koki1
            left join tb_karyawan as d on d.id_karyawan = a.id_koki2
            left join tb_karyawan as e ON e.id_karyawan = a.id_koki3
            where   a.no_order = '$id' AND a.void = 0 
            GROUP BY a.id_harga
            "),
        );
        $data = [
            'order' => $order,
            'no_order' => $id,
            'pesan_2'    => DB::table('tb_order as a')
                ->select(DB::raw('a.*, sum(a.qty) as sum_qty ,  b.nm_meja'))
                ->leftJoin('tb_meja as b', 'b.id_meja', '=', 'a.id_meja')
                ->where('a.no_order', $id)
                ->groupBy('a.no_order')
                ->first(),
            'ongkir2' => DB::table('tb_ongkir as a')
                ->select(DB::raw('a.*, sum(a.rupiah) as rupiah '))
                ->first(),
            'batas' => DB::table('tb_batas_ongkir')
                ->first(),
        ];
        return view('meja.bill', $data);
    }

    public function checker(Request $request)
    {
        $id = $request->no;
        $order =  DB::select(
            DB::raw("SELECT a.id_order, b.nm_menu, SUM(a.qty) as qty, a.request, c.nama AS koki1 , d.nama AS koki2, e.nama AS koki3, 
            a.pengantar, a.id_meja, a.j_mulai, a.j_selesai, a.wait, a.selesai,
            timestampdiff(MINUTE, a.j_mulai,a.wait) AS selisih, a.no_checker , a.print, a.copy_print
            FROM tb_order as a 
            left join view_menu as b on a.id_harga = b.id_harga 
            left join tb_karyawan as c on c.id_karyawan = a.id_koki1
            left join tb_karyawan as d on d.id_karyawan = a.id_koki2
            left join tb_karyawan as e ON e.id_karyawan = a.id_koki3
            where a.aktif = '1' and a.print = 'T' and a.no_order = '$id'
            GROUP BY a.id_order
            ORDER BY a.id_order DESC"),
        );

        $data = [
            'order' => $order,
            'no_order' => $id,
            'pesan_2'    => DB::table('tb_order as a')
                ->select(DB::raw('a.*, sum(a.qty) as sum_qty ,  b.nm_meja'))
                ->leftJoin('tb_meja as b', 'b.id_meja', '=', 'a.id_meja')
                ->where('a.no_order', $id)
                ->groupBy('a.no_order')
                ->first(),
        ];

        $data1 = [
            'no_checker' => 'Y',
            'print' => 'Y'
        ];
        Orderan::where('no_order', $id)->update($data1);
        return view('meja.checker', $data);
    }

    public function copy_checker(Request $request)
    {
        $id = $request->no;
        $order =  DB::select(
            DB::raw("SELECT a.id_order, b.nm_menu, SUM(a.qty) as qty, a.request, c.nama AS koki1 , d.nama AS koki2, e.nama AS koki3, 
            a.pengantar, a.id_meja, a.j_mulai, a.j_selesai, a.wait, a.selesai,
            timestampdiff(MINUTE, a.j_mulai,a.wait) AS selisih, a.no_checker , a.print, a.copy_print
            FROM tb_order as a 
            left join view_menu as b on a.id_harga = b.id_harga 
            left join tb_karyawan as c on c.id_karyawan = a.id_koki1
            left join tb_karyawan as d on d.id_karyawan = a.id_koki2
            left join tb_karyawan as e ON e.id_karyawan = a.id_koki3
            where a.aktif = '1' and a.copy_print = 'T' and a.no_order = '$id' 
            GROUP BY a.id_order
            ORDER BY a.id_order DESC"),
        );

        $data = [
            'order' => $order,
            'no_order' => $id,
            'pesan_2'    => DB::table('tb_order as a')
                ->select(DB::raw('a.*, sum(a.qty) as sum_qty ,  b.nm_meja'))
                ->leftJoin('tb_meja as b', 'b.id_meja', '=', 'a.id_meja')
                ->where('a.no_order', $id)
                ->groupBy('a.no_order')
                ->first(),
        ];


        $data1 = [
            'copy_print' => 'Y',
        ];
        Orderan::where('no_order', $id)->update($data1);

        return view('meja.copy_checker', $data);
    }

    
}
