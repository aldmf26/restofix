<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use App\Models\Koki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HeadController extends Controller
{
    public function index(Request $request)
    {
        $id_user = Auth::user()->id;
        $id_menu = DB::table('tb_permission')->select('id_menu')->where('id_user',$id_user)->where('id_menu', 27)->first();
        if(empty($id_menu)) {
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
                'title' => 'Tugas Head',
                'logout' => $request->session()->get('logout'),
                'id' => $id,
                'menu' => DB::table('view_menu')
                    ->where('id_distribusi', $id)
                    ->where('akv', 'on')
                    ->where('lokasi', $lokasi)
                    ->get(),
                'orderan' => DB::select("SELECT COUNT(id_order) as jml_order FROM tb_order WHERE id_lokasi = '$lokasi' AND id_distribusi = '$id' AND selesai = 'dimasak' AND void = 0"),
            ];
           
    
            return view('head.head', $data);
        }
    }

    public function getSearchHead(Request $r)
    {
        $s = $r->s;
        if (empty($r->id)) {
            $id_distribusi = '1';
        } else {
            $id_distribusi = $r->id;
        }

        $lokasi = $r->session()->get('id_lokasi');
        $tgl = date('Y-m-d');

        // $tb_koki = DB::join('tb_karyawan', 'tb_karyawan.id_karyawan', '=', 'tb_koki.id_karyawan')->where('tb_koki.tgl', $tgl)->where('tb_koki.id_lokasi', $lokasi)->get();
        $tb_koki = DB::table('tb_koki')->join('tb_karyawan', 'tb_karyawan.id_karyawan', '=', 'tb_koki.id_karyawan')->where('tb_koki.tgl', $tgl)->where('tb_koki.id_lokasi', $lokasi)->get();

        $meja = DB::select("SELECT a.id_meja, d.nm_meja, a.no_order, RIGHT(a.no_order,2) AS kd, b.nm_distribusi,a.selesai, c.no_order AS bayar
        FROM tb_order AS a
        LEFT JOIN tb_distribusi AS b ON b.id_distribusi = a.id_distribusi
        left join tb_meja as d on d.id_meja = a.id_meja
        LEFT JOIN tb_transaksi AS c ON c.no_order = a.no_order
        left join view_menu as e on a.id_harga = e.id_harga
        WHERE e.nm_menu LIKE '%$s%' AND a.aktif = '1' AND a.selesai = 'dimasak' AND a.id_lokasi = '$lokasi' and a.id_distribusi = '$id_distribusi'
        group by a.no_order order by a.id_distribusi , a.id_meja ASC
        ");

        $data = [
            'title' => 'Tugas Head',
            'meja' => $meja,
            'tb_koki' => $tb_koki,
            'lokasi' => $lokasi,
            'distribusi' => DB::select("SELECT a.*, c.jumlah
                            FROM tb_distribusi AS a 
                            LEFT JOIN (SELECT b.id_distribusi , COUNT(b.id_order) AS jumlah
                            FROM tb_order AS b
                            WHERE b.selesai = 'dimasak'
                            GROUP BY b.id_distribusi
                            ) c ON c.id_distribusi = a.id_distribusi
                            "),
            'id' => $id_distribusi,
            'search' => $s,
        ]; 
        return view('head.getSearchHead',$data);
    }

    public function get_head(Request $request)
    {
      
        if (empty($request->id)) {
            $id_distribusi = '1';
        } else {
            $id_distribusi = $request->id;
        }

        $lokasi = $request->session()->get('id_lokasi');
        $tgl = date('Y-m-d');

        // $tb_koki = DB::join('tb_karyawan', 'tb_karyawan.id_karyawan', '=', 'tb_koki.id_karyawan')->where('tb_koki.tgl', $tgl)->where('tb_koki.id_lokasi', $lokasi)->get();
        $tb_koki = DB::table('tb_koki')->join('tb_karyawan', 'tb_karyawan.id_karyawan', '=', 'tb_koki.id_karyawan')->where('tb_koki.tgl', $tgl)->where('tb_koki.id_lokasi', $lokasi)->get();

        $meja = DB::select("SELECT a.id_meja, d.nm_meja, a.no_order, RIGHT(a.no_order,2) AS kd, b.nm_distribusi,a.selesai, c.no_order AS bayar
        FROM tb_order AS a
        LEFT JOIN tb_distribusi AS b ON b.id_distribusi = a.id_distribusi
        left join tb_meja as d on d.id_meja = a.id_meja
        LEFT JOIN tb_transaksi AS c ON c.no_order = a.no_order
        WHERE a.aktif = '1' AND a.id_lokasi = '$lokasi' and a.id_distribusi = '$id_distribusi'
        group by a.no_order order by a.id_distribusi , a.id_meja ASC
        ");

        $data = [
            'title' => 'Tugas Head',
            'meja' => $meja,
            'tb_koki' => $tb_koki,
            'lokasi' => $lokasi,
            'distribusi' => DB::select("SELECT a.*, c.jumlah
                            FROM tb_distribusi AS a 
                            LEFT JOIN (SELECT b.id_distribusi , COUNT(b.id_order) AS jumlah
                            FROM tb_order AS b
                            WHERE b.selesai = 'dimasak'
                            GROUP BY b.id_distribusi
                            ) c ON c.id_distribusi = a.id_distribusi
                            "),
            'id' => $id_distribusi,

        ];
        return view('head.tugas', $data);
    }

    public function distribusi(Request $request)
    {
    
        if (empty($request->id)) {
            $id = '1';
        } else {
            $id = $request->id;
        }
        $tgl = date('Y-m-d');
        $lokasi = $request->session()->get('id_lokasi');
        $data = [
            'title'    => 'Menu | Buku Tugas',
            'id' => $id,
            'distribusi' => DB::select("SELECT a.*, c.jumlah
            FROM tb_distribusi AS a 
            LEFT JOIN (SELECT b.id_distribusi , COUNT(b.id_order) AS jumlah
            FROM tb_order AS b
            WHERE b.selesai = 'dimasak' AND b.id_lokasi = $lokasi AND b.void = 0
            GROUP BY b.id_distribusi
            ) c ON c.id_distribusi = a.id_distribusi
            "),
            'tb_koki' => DB::table('tb_koki')->join('tb_karyawan', 'tb_karyawan.id_karyawan', '=', 'tb_koki.id_karyawan')->where('tb_koki.tgl', $tgl)->where('tb_koki.id_lokasi', $lokasi)->get(),
            'orderan' => DB::select("SELECT COUNT(id_order) as jml_order FROM `tb_order` WHERE id_lokasi = $lokasi AND id_distribusi = $id AND selesai = 'dimasak'")

        ];
        return view('head.distribusi', $data);
    }

    public function jumlah(Request $request)
    {
        if (empty($request->id)) {
            $id = '1';
        } else {
            $id = $request->id;
        }
        $tgl = date('Y-m-d');
        $lokasi = $request->session()->get('id_lokasi');
        $data = [
            'title'    => 'Menu | Buku Tugas',
            'tb_order' => DB::join('view_menu', 'view_menu.id_harga = tb_order.id_harga')->where('tb_order', ['tb_order.aktif' => '1'])->get(),
            'kategori' => DB::table('tb_kategori')->where('lokasi', 'TAKEMORI')->get(),
           'distribusi' => DB::select("SELECT a.*, c.jumlah
            FROM tb_distribusi AS a 
            LEFT JOIN (SELECT b.id_distribusi , COUNT(b.id_order) AS jumlah
            FROM tb_order AS b
            WHERE b.selesai = 'dimasak' AND b.id_lokasi = $lokasi AND b.void = 0
            GROUP BY b.id_distribusi
            ) c ON c.id_distribusi = a.id_distribusi
            "),
            'tb_koki' => DB::table('tb_koki')->join('tb_karyawan', 'tb_karyawan.id_karyawan', '=', 'tb_koki.id_karyawan')->where('tb_koki.tgl', $tgl)->where('tb_koki.id_lokasi', $lokasi)->get(),
            'id' => $id

        ];
        return view('head.jumlah', $data);   
    }

    public function koki1(Request $request)
    {
        $id_order = $request->kode;
        $koki1 = $request->kry;
     
        $data = array(
            'id_koki1'   => $koki1,
        );
     
        DB::table('tb_order')->where('id_order', $id_order)->update($data);
    }

    public function koki2(Request $request)
    {
        $id_order = $request->kode;
        $koki2 = $request->kry;

        $data = array(
            'id_koki2'   => $koki2,
        );
        DB::table('tb_order')->where('id_order', $id_order)->update($data);
    }
    public function koki3(Request $request)
    {
        $id_order = $request->kode;
        $koki3 = $request->kry;

        $data = array(
            'id_koki3'   => $koki3,
        );
        DB::table('tb_order')->where('id_order', $id_order)->update($data);
    }
    public function un_koki1(Request $request)
    {
        $id_order = $request->kode;
        $data = array(
            'id_koki1'   => '0',
            'id_koki2'   => '0',
            'id_koki3'   => '0',
        );
        DB::table('tb_order')->where('id_order', $id_order)->update($data);
    }
    public function un_koki2(Request $request)
    {
        $id_order = $request->kode;
        $data = array(
            'id_koki2'   => '0',
            'id_koki3'   => '0',
        );
        DB::table('tb_order')->where('id_order', $id_order)->update($data);
    }
    public function un_koki3(Request $request)
    {
        $id_order = $request->kode;
        $data = array(
            'id_koki3'   => '0',
        );
        DB::table('tb_order')->where('id_order', $id_order)->update($data);
    }
    public function head_selesei(Request $request)
    {
        date_default_timezone_set('Asia/Makassar');
        $id_order = $request->kode;
        $data = array(
            'selesai'   => 'diantar',
            'j_selesai' => date('Y-m-d H:i:s'),
            'wait' => date('Y-m-d H:i:s'),
        );
  
        DB::table('tb_order')->where('id_order', $id_order)->update($data);
    }

    public function view1jam(Request $r)
    {
        date_default_timezone_set('Asia/Makassar');
        $tgl = date('Y-m-d');
        $loc = Session::get('id_lokasi');
        $lokasi = $loc == 1 ? 'TAKEMORI' : 'SOONDOBU';
        $data = [
            'title' => 'Data Orderan',
            'logout' => $r->session()->get('logout'),
            'tb_order' => DB::select("SELECT a.*,b.id_menu ,b.nm_menu, c.nm_meja, d.nama AS koki1 , e.nama AS koki2, f.nama AS koki3,
        timestampdiff(MINUTE, a.j_mulai,a.wait) AS selisih, tb_order2.id_order1 as cek_bayar
        FROM tb_order as a 
        left join view_menu as b on a.id_harga = b.id_harga
        LEFT JOIN tb_meja AS c ON c.id_meja = a.id_meja
        LEFT JOIN tb_karyawan AS d ON d.id_karyawan = a.id_koki1
        LEFT JOIN tb_karyawan AS e ON e.id_karyawan = a.id_koki2
        LEFT JOIN tb_karyawan AS f ON f.id_karyawan = a.id_koki3
        LEFT JOIN tb_order2 ON a.id_order = tb_order2.id_order1
        WHERE a.j_selesai BETWEEN NOW() - INTERVAL 1 HOUR AND NOW() AND a.selesai = 'selesai' and a.tgl = '$tgl' and a.id_lokasi = '$loc'  and a.void = 0 order by a.id_order DESC"),

            'kategori' => DB::table('tb_kategori')->where('lokasi', $lokasi)->get(),
            'distribusi' => Distribusi::all(),
            'tb_koki' => Koki::join('tb_karyawan', 'tb_karyawan.id_karyawan', '=', 'tb_koki.id_karyawan')->where('tb_koki.tgl', $tgl)->get(),
            'nav' => '5'
        ];
            
        return view('head.view1jam',$data);
    }
}
