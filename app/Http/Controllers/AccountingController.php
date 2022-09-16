<?php

namespace App\Http\Controllers;

use App\Models\Aktiva;
use App\Models\Akun;
use App\Models\Atk;
use App\Models\Jurnal;
use App\Models\Karyawan;
use App\Models\KelPeralatan;
use App\Models\Peralatan;
use App\Models\PostCenter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Str;


class AccountingController extends Controller
{

    public function index(Request $request)
    {
        $data = [
            'title' => 'Akun',
            'logout' => $request->session()->get('logout'),
            'akun' => Akun::join('tb_kategori_akun', 'tb_kategori_akun.id_kategori', '=', 'tb_akun.id_kategori')->get(),
            'akun_relation' => DB::select("SELECT tb_akun.id_akun as id_akun, nm_akun, relasi.id_relation_debit, relasi.id_relation_kredit 
            FROM tb_akun
            LEFT JOIN (SELECT id_akun, id_relation_debit, id_relation_kredit FROM tb_relasi_akun) relasi ON tb_akun.id_akun = relasi.id_akun
            ")
        ];
        return view('accounting.home', $data);
    }

    public function dashboard(Request $request)
    {

        $data = [
            'title' => 'Accounting Takemori',
            'logout' => $request->session()->get('logout'),
            'akun' => Akun::join('tb_kategori_akun', 'tb_kategori_akun.id_kategori', '=', 'tb_akun.id_kategori')->get()
        ];
        return view('accounting.dashboard', $data);
    }

    public function akun(Request $request)
    {
        $id_user = Auth::user()->id;
        $id_menu = DB::table('tb_permission')->select('id_menu')->where('id_user', $id_user)
            ->where('id_menu', 21)->first();
        if (empty($id_menu)) {
            return back();
        } else {
            if (Auth::user()->jenis == 'adm') {
                $data = [
                    'title' => 'Akun',
                    'logout' => $request->session()->get('logout'),
                    'akun' => Akun::join('tb_kategori_akun', 'tb_kategori_akun.id_kategori', '=', 'tb_akun.id_kategori')->where('id_lokasi', $request->acc)->orderBy('no_akun', 'asc')->get(),
                    'menu_akun' => DB::table('tb_menu_akun')->get(),
                    'kategori' => DB::table('tb_kategori_akun')->get(),
                    'akun_relation' => DB::select("SELECT tb_akun.id_akun as id_akun, nm_akun, relasi.id_relation_debit, relasi.id_relation_kredit 
                    FROM tb_akun
                    LEFT JOIN (SELECT id_akun, id_relation_debit, id_relation_kredit FROM tb_relasi_akun) relasi ON tb_akun.id_akun = relasi.id_akun
                    ")
                ];

                return view('accounting.accounting', $data);
            } else {
                return back();
            }
        }
    }

    public function deleteAkun(Request $r)
    {
        $id_akun = $r->id_akun;
        $ada = Jurnal::where('id_akun', $id_akun)->first();
        if(empty($ada)){
            Akun::where('id_akun', $id_akun)->delete();
            $cek = 'sukses';
            $pesan = 'Berhasil Hapus Akun';
        } else {
            $cek = 'error';
            $pesan = 'Gagal Hapus Akun';
        }
        return redirect()->route('akun', ['acc' => Session::get('id_lokasi')])->with($cek, $pesan);
    }

    public function getNoAkun(Request $r)
    {
        $id_kategori = $r->id_kategori;
        $kode = Akun::where('id_kategori', $id_kategori)->orderBy('id_akun', 'DESC')->first();
        $k = $kode->no_akun + 1;
        echo $k;
    }

    public function getAkunBiaya(Request $r)
    {
        return view('accounting.akunBiaya');
    }



    public function katAkun(Request $r)
    {
        $data = [
            'ps' => DB::table('tb_kategori_akun')->get(),
        ];
        return view('accounting.katAkun', $data);
    }

    public function add_relation_akun(Request $r)
    {
        $id_akun = $r->id_akun;
        $id_lokasi = $r->id_lokasi;
        $id_relation_debit = $r->id_relation_debit;
        $id_relation_kredit = $r->id_relation_kredit;
        $cek = DB::table('tb_relasi_akun')->where('id_akun', $id_akun)->First();

        if ($cek) {
            $data = [
                'id_relation_debit' => $id_relation_debit,
                'id_relation_kredit' => $id_relation_kredit,
            ];
            DB::table('tb_relasi_akun')->where('id_akun', $id_akun)->update($data);
        } else {
            $data = [
                'id_akun' => $id_akun,
                'id_relation_debit' => $id_relation_debit,
                'id_relation_kredit' => $id_relation_kredit,
            ];
            DB::table('tb_relasi_akun')->insert($data);
        }

        return redirect()->route('akun', ['acc' => $id_lokasi])->with('sukses', 'Berhasil tambah post center');
    }

    public function addKategoriAkun(Request $r)
    {
        DB::table('tb_kategori_akun')->insert(['nm_kategori' => $r->nm_kategori]);
    }


    public function delKetAkun(Request $r)
    {
        DB::table('tb_kategori_akun')->where('id_kategori', $r->id_kategori)->delete();
    }

    public function relasiAkun(Request $r)
    {
        $id_lokasi = $r->id_lokasi;
        $id_akun = $r->kd_akun;
        $no_akun = $r->no_akun;
        $id_sub_menu_akun = $r->id_sub_menu_akun;

        DB::table('tb_permission_akun')->where('id_akun', $id_akun)->delete();
        for ($x = 0; $x < sizeof($id_sub_menu_akun); $x++) {
            $no = Akun::where('no_akun', $no_akun)->get();
            foreach ($no as $n) {
                $data_permission = [
                    'id_akun' => $n->id_akun,
                    'id_sub_menu_akun' => $id_sub_menu_akun[$x]
                ];
                DB::table('tb_permission_akun')->insert($data_permission);
            }
        }

        return redirect()->route('akun', ['acc' => $id_lokasi])->with('sukses', 'Berhasil tambah relasi akun');
    }

    public function jPenyesuaian1(Request $r)
    {
        if (empty($r->tgl1)) {
            $month = date('m');
            $year = date('Y');
            $last_date = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tgl1 = $year . '-' . $month . '-01';
            $tgl2 = $year . '-' . $month . '-' . $last_date;
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }
        $id_lokasi = Session::get('id_lokasi');
        $jurnal = DB::select("SELECT a.* ,b.no_akun, b.nm_akun, c.nm_post, d.n, c.id_post
        FROM tb_jurnal as a 
        left join tb_akun as b on b.id_akun = a.id_akun 
        left join tb_post_center AS c ON c.id_post = a.id_post
        left join tb_satuan AS d ON d.id = a.id_satuan
        
        WHERE a.id_buku = '4' and a.tgl between '$tgl1' and '$tgl2' AND a.id_lokasi = '$id_lokasi'  order by  a.tgl DESC , a.id_jurnal DESC");

        $tahun = DB::select("SELECT tgl FROM tb_jurnal GROUP BY YEAR(tgl)");

        $data = [
            'title' => 'Jurnal Penyesuaian 1',
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'jurnal' => $jurnal,
        ];
        return view('accounting.akunting2.jPenyesuaian1', $data);
    }

    public function edit_get_jurnal(Request $r)
    {
        $kd_gabungan = $r->kd_gabungan;

        $kredit = Jurnal::where([['kd_gabungan', $kd_gabungan], ['kredit', '!=', null]])->first();
        $debit = Jurnal::where([['kd_gabungan', $kd_gabungan], ['debit', '!=', null]])->first();


        $data = [
            'kredit' => $kredit,
            'debit' => $debit,
            'akun' => Akun::all(),
        ];
        return view('accounting.akunting2.editJurnal', $data);
    }

    public function get_relation_akun(Request $r)
    {
        return "<h1>relasi akun</h1>";
    }

    public function jPenyesuaian2(Request $r)
    {
        if (empty($r->tgl1)) {
            $month = date('m');
            $year = date('Y');
            $last_date = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tgl1 = $year . '-' . $month . '-01';
            $tgl2 = $year . '-' . $month . '-' . $last_date;
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }
        $id_lokasi = Session::get('id_lokasi');

        $jurnal = DB::select("SELECT a.* ,b.no_akun, b.nm_akun, c.nm_post, d.n, c.id_post
        FROM tb_jurnal as a 
        left join tb_akun as b on b.id_akun = a.id_akun 
        left join tb_post_center AS c ON c.id_post = a.id_post
        left join tb_satuan AS d ON d.id = a.id_satuan
        
        WHERE a.id_buku = '4' and a.tgl between '$tgl1' and '$tgl2' and a.id_lokasi = '$id_lokasi'  order by  a.tgl DESC , a.id_jurnal DESC");

        $tahun = DB::select("SELECT tgl FROM tb_jurnal WHERE id_lokasi = '$id_lokasi' GROUP BY YEAR(tgl)");

        $data = [
            'title' => 'Jurnal Penyesuaian 2',
            'jurnal' => $jurnal,
            'barang' => Aktiva::where([['debit_aktiva', '!=', '0'], ['id_lokasi', $id_lokasi]])->get(),
            'tgl1' => $tgl1,
            'tgl2' => $tgl2

        ];

        return view('accounting.akunting2.jPenyesuaian2', $data);
    }

    public function exportJP2(Request $r)
    {
        return 'export jp2';
    }

    public function add_penyesuaian_akun(Request $r)
    {
        # code...
    }

    public function get_relation_atk(Request $r)
    {
        $relasi = DB::select("SELECT a.id_relation_debit as id_debit, b.nm_akun as akun_debit, a.id_relation_kredit as id_kredit, c.nm_akun as akun_kredit FROM `tb_relasi_akun` as a
        left JOIN tb_akun as b ON a.id_relation_debit = b.id_akun
        LEFT JOIN tb_akun as c ON a.id_relation_kredit = c.id_akun");
        $data = [
            'relasi' => $relasi,
            'id_lokasi' => Session::get('id_lokasi'),
        ];
        return view('accounting.akunting2.penyesuaianAtk', $data);
    }

    public function add_penyesuaian_atk(Request $r)
    {
        $admin = Auth::user()->nama;
        $tgl_atk = $r->tgl_atk;
        $id_akun1 = $r->id_akun1;
        $debit_atk = $r->debit_atk;
        $metode1 = $r->metode1;
        $kredit_atk = $r->kredit_atk;
        $id_lokasi = Session::get('id_lokasi');
        $id_akunLokasi = $id_lokasi == 1 ? 74 : 112;

        $year = date('Y', strtotime($tgl_atk));
        $month = date('m', strtotime($tgl_atk));

        $get_kd_akun_prltn = Akun::where('id_akun', $id_akun1)->get()[0];
        $kode_akun_prltn = Jurnal::where('id_akun', $id_akun1)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

        $get_kd_akun_prltn2 = Akun::where('id_akun', $metode1)->get()[0];
        $kode_akun_prltn2 = Jurnal::where('id_akun', $metode1)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

        $kd_gabungan_prltn = 'RST' . date('dmy') . strtoupper(Str::random(3));

        if ($kode_akun_prltn == 0) {
            $kode_akun_prltn = 1;
        } else {
            $kode_akun_prltn += 1;
        }
        if ($kode_akun_prltn2 == 0) {
            $kode_akun_prltn2 = 1;
        } else {
            $kode_akun_prltn2 += 1;
        }


        $data_jurnal2 = [
            'id_buku' => 4,
            'id_akun' => $metode1,
            'kd_gabungan' => $kd_gabungan_prltn,
            'no_nota' => $get_kd_akun_prltn2->kd_akun . date('my', strtotime($tgl_atk)) . '-' . $kode_akun_prltn2,
            'kredit' => $kredit_atk,
            'ket' => 'Penyesuaian atk',
            'tgl' => $tgl_atk,
            'tgl_input' => date('Y-m-d H:i:s'),
            'admin' => $admin,
            'id_lokasi' => $id_lokasi,
        ];
        Jurnal::create($data_jurnal2);

        $data_jurnal = [
            'id_buku' => 4,
            'id_akun' => $id_akun1,
            'kd_gabungan' => $kd_gabungan_prltn,
            'no_nota' => $get_kd_akun_prltn->kd_akun . date('my', strtotime($tgl_atk)) . '-' . $kode_akun_prltn,
            'debit' => $debit_atk,
            'ket' => 'Penyesuaian atk',
            'tgl' => $tgl_atk,
            'tgl_input' => date('Y-m-d H:i:s'),
            'admin' => $admin,
            'id_lokasi' => $id_lokasi,
        ];
        Jurnal::create($data_jurnal);


        $barang_atk = $r->barang_atk;
        $qty_kredit = $r->qty_kredit;
        $kredit_atk2 = $r->kredit_atk2;
        $no_nota = $r->nota;

        for ($count = 0; $count < count($barang_atk); $count++) {
            $data_peralatan = [
                'tgl' => $tgl_atk,
                'nm_barang' => $barang_atk[$count],
                'no_nota' => $no_nota[$count],
                'qty_kredit' => $qty_kredit[$count],
                'kredit_atk' => $kredit_atk[$count],
                'id_lokasi' => $id_lokasi,
            ];
            Atk::create($data_peralatan);
        }

        DB::select("UPDATE tb_jurnal as a SET a.disesuaikan = 'Y' WHERE YEAR(a.tgl) = '$year' AND MONTH(a.tgl) = '$month' AND a.id_akun = '30' ");

        return redirect()->route('jPenyesuaian1', ['acc' => Session::get('id_lokasi')])->with('sukses', 'Berhasil Tambah Atk');
    }
    
    public function get_relation_daging(Request $r)
    {
        $relasi = DB::select("SELECT a.id_relation_debit as id_debit, b.nm_akun as akun_debit, a.id_relation_kredit as id_kredit, c.nm_akun as akun_kredit FROM `tb_relasi_akun` as a
        left JOIN tb_akun as b ON a.id_relation_debit = b.id_akun
        LEFT JOIN tb_akun as c ON a.id_relation_kredit = c.id_akun");

        $daging = DB::select("SELECT a.id_list_bahan,c.*,  b.nm_bahan, sum(a.debit_makanan) debit_daging , sum(a.kredit_makanan) AS kredit_daging
        FROM tb_stok_makanan AS a
        LEFT JOIN tb_list_bahan AS b ON b.id_list_bahan = a.id_list_bahan
        LEFT JOIN tb_satuan as c ON c.id = b.id_satuan
        WHERE b.id_kategori_makanan = '1'
        GROUP BY a.id_list_bahan");

        $data = [
            'relasi' => $relasi,
            'id_lokasi' => Session::get('id_lokasi'),
            'daging' => $daging
        ];
        return view('accounting.akunting2.penyesuaianDaging', $data);
    }

    public function add_penyesuaian_daging(Request $r)
    {
        $id_akun_debit = $r->id_akun_daging;
        $debit = $r->debit_daging;
        $admin = Auth::user()->nama;
        $id_akun_kredit = $r->id_akun_kredit_daging;
        $kredit = $r->kredit_daging;
        $id_lokasi = Session::get('id_lokasi');
        $id_list_bahan = $r->id_list_bahan;
        $qty = $r->qty_daging;
        $h_satuan = $r->h_satuan_daging;
        $selisih = $r->selisih_daging;
        
        dd($selisih);
        $penyesuaian = DB::selectOne("SELECT * FROM tb_jurnal as a where a.id_buku = '4' AND a.id_akun = '$id_akun_kredit'");

        $tgl_last = DB::selectOne("SELECT max(a.tgl) as tgl FROM tb_jurnal as a where a.id_buku = '3' and a.id_akun = '$id_akun_kredit'");
        $tglAkhir = date('Y-m-t', strtotime('last day', strtotime($tgl_last->tgl)));

        $tgl = empty($penyesuaian) ? $tglAkhir : $r->tgl_daging;
    
        if ($kredit == 0 || empty($kredit)) {
            # code...
        } else {
            $month = date('m', strtotime($tgl));
            $year = date('Y', strtotime($tgl));
            $get_kd_akun = Akun::where('id_akun', $id_akun_debit)->get()[0];

            $kode_akun = Jurnal::where('id_akun',$id_akun_debit)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

            if ($kode_akun == 0) {
                $kode_akun = 1;
            } else {
                $kode_akun += 1;
            }
            $get_akun = Akun::where('id_akun', $id_akun_debit)->get()[0];

            $get_kd_metode = Akun::where('id_akun', $id_akun_kredit)->get()[0];
            
            $kode_metode = Jurnal::where('id_akun', $id_akun_kredit)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

            if ($kode_metode == 0) {
                $kode_metode = 1;
            } else {
                $kode_metode += 1;
            }
            $get_metode = Akun::where('id_akun', $id_akun_kredit)->get()[0];

            $kd_gabungan = 'RST' . date($tgl) . strtoupper(Str::random(3));

            $data_metode = [
                'id_buku' => 4,
                'id_akun' => $id_akun_kredit,
                'kd_gabungan' => $kd_gabungan,
                'no_nota' => $get_kd_metode->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_metode,
                'kredit' => $kredit,
                'tgl' => $tgl,
                'tgl_input' => date('Y-m-d H:i:s'),
                'admin' => $admin,
                'id_lokasi' => $id_lokasi,
                'ket' => 'Penyesuaian ' . $get_metode->nm_akun
            ];
            Jurnal::create($data_metode);

            $data_jurnal = [
                'id_buku' => 4,
                'id_akun' => $id_akun_debit,
                'kd_gabungan' => $kd_gabungan,
                'no_nota' => $get_kd_akun->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_akun,
                'debit' => $debit,
                'ket' => 'Penyesuaian ' . $get_akun->nm_akun,
                'tgl' => $tgl,
                'tgl_input' => date('Y-m-d H:i:s'),
                'admin' => $admin,
                'id_lokasi' => $id_lokasi,
            ];
            Jurnal::create($data_jurnal);

            $akun = $id_akun_kredit;
            DB::select("UPDATE tb_jurnal as a SET a.disesuaikan = 'Y' WHERE YEAR(a.tgl) = '$year' AND MONTH(a.tgl) = '$month' AND a.id_akun = '$akun'");
        }

        

        for ($x = 0; $x < count($id_list_bahan); $x++) {

            if ($selisih[$x] == '0') {
                # code...
            } else {
                $data_pakan = [
                    'tgl' => $tgl,
                    'id_lokasi' => $id_lokasi,
                    'id_list_bahan' => $id_list_bahan[$x],
                    'id_merk_bahan' => 0,
                    'kredit_makanan' => $selisih[$x],
                    'debit_makanan' => 0,
                    'penyesuaian' => 'Y',
                    'disesuaikan' => 'Y',
                    'kd_gabungan' => $kd_gabungan,
                    'admin' => $admin,
                    'h_satuan' => $h_satuan[$x],
                ];
                DB::table('tb_stok_makanan')->insert($data_pakan);
            }
            $data = [
                'tgl' => $tgl,
                'id_list_bahan' => $id_list_bahan[$x],
                'stok' => $qty[$x],
                'admin' => $admin,
                'h_satuan' => $h_satuan[$x],
                'kd_gabungan' => $kd_gabungan,
                'penyesuaian' => 'Y',
                'id_lokasi' => $id_lokasi,
            ];
            DB::table('tb_neraca_daging')->insert($data);

            DB::select("UPDATE tb_stok_makanan as a SET a.disesuaikan = 'Y' WHERE YEAR(a.tgl) = '$year' AND MONTH(a.tgl) = '$month'");

        }

        return redirect()->route('jPenyesuaian1', ['acc' => Session::get('id_lokasi')])->with('sukses', 'Berhasil Tambah Daging');
    }

    

    public function excel_atk(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        $atk = DB::select("SELECT a.tgl, a.id_atk, a.no_nota, a.nm_barang, SUM(a.qty_debit) AS qty_debit , SUM(a.qty_kredit) AS qty_kredit,
        b.n, SUM(a.debit_atk) AS debit_atk, SUM(a.kredit_atk) AS kredit_atk
        FROM tb_atk AS a
        LEFT JOIN tb_satuan AS b ON b.id = a.id_satuan
        WHERE a.id_lokasi = '$id_lokasi'
        GROUP BY a.no_nota");

        $data = [
            'atk' => $atk,
            'id_lokasi' => $id_lokasi,
        ];

        return view('accounting.akunting2.excelAtk', $data);
    }
    public function print_atk(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        $atk = DB::select("SELECT a.tgl, a.id_atk, a.no_nota, a.nm_barang, SUM(a.qty_debit) AS qty_debit , SUM(a.qty_kredit) AS qty_kredit,
        b.n, SUM(a.debit_atk) AS debit_atk, SUM(a.kredit_atk) AS kredit_atk
        FROM tb_atk AS a
        LEFT JOIN tb_satuan AS b ON b.id = a.id_satuan
        WHERE a.id_lokasi = '$id_lokasi'
        GROUP BY a.no_nota");

        $data = [
            'atk' => $atk,
            'id_lokasi' => $id_lokasi,
        ];

        return view('accounting.akunting2.printAtk', $data);
    }

    public function get_relation_aktiva(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        $id_akunBDPA = $id_lokasi == 1 ? '212' : '213';
        $id_akunAPP = $id_lokasi == 1 ? '208' : '209';
        $jurnal = DB::selectOne("SELECT LAST_DAY(max(a.tgl)) AS  tgl_max FROM tb_jurnal as a where a.id_akun = '$id_akunBDPA' ");

        $aktiva = DB::selectOne("SELECT a.* , MIN(a.tgl) AS tgl_min FROM aktiva AS a WHERE a.id_lokasi = '$id_lokasi' ORDER BY a.tgl ASC");
        if (empty($jurnal->tgl_max)) {
            $tgl = date('Y-m-d', strtotime('last day of next month', strtotime($aktiva->tgl_min)));
        } else {
            $tgl = date('Y-m-d', strtotime('last day of next month', strtotime($jurnal->tgl_max)));
        }
        $aktiva = DB::select("SELECT *, SUM(a.kredit_aktiva) AS kredit2
        FROM aktiva AS a
        where a.tgl < '$tgl' and a.id_lokasi = '$id_lokasi'
        GROUP BY a.nota");
        $month1 = date('m-Y');
        $month2 = date('m-Y', strtotime($tgl));
        $last = date('Y-m-t');
        $data = [
            'aktiva' => $aktiva,
            'tgl_max' => $tgl,
            'month1' => $month1,
            'month2' => $month2,
            'last' => $last,
            'id_akunBDPA' => $id_akunBDPA,
            'id_akunAPP' => $id_akunAPP,
            'id_lokasi' => $id_lokasi,
        ];
        return view('accounting.akunting2.aktiva', $data);
    }

    public function add_penyesuaian_aktiva(Request $r)
    {
        $admin = Auth::user()->nama;
        $id_lokasi = Session::get('id_lokasi');
        $id_akun1 = $r->id_akun1;
        $debit_akv = $r->debit_akv;
        $metode1 = $r->metode1;
        $kredit_akv = $r->kredit_akv;
        $tgl_akv = $r->tgl_akv;
        $id_akunBDPA = $id_lokasi == 1 ? '212' : '213';
        $id_akunAPP = $id_lokasi == 1 ? '208' : '209';

        $year = date('Y', strtotime($tgl_akv));
        $month = date('m', strtotime($tgl_akv));

        $get_kd_akun_akv = Akun::where('id_akun', $id_akun1)->get()[0];

        $kode_akun_akv = Jurnal::whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

        $get_kd_akun_akv2 = Akun::where('id_akun', $metode1)->get()[0];
        $kode_akun_akv2 = Jurnal::where('id_akun', $metode1)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

        $kd_gabungan_akv = 'RST' . date($tgl_akv) . strtoupper(Str::random(3));

        if ($kode_akun_akv == 0) {
            $kode_akun_akv = 1;
        } else {
            $kode_akun_akv += 1;
        }
        if ($kode_akun_akv2 == 0) {
            $kode_akun_akv2 = 1;
        } else {
            $kode_akun_akv2 += 1;
        }

        if ($debit_akv == 0 || empty($debit_akv)) {
        } else {
            $jurnal = Jurnal::where([['tgl', $tgl_akv], ['id_akun', $id_akunBDPA]])->first();

            if (empty($jurnal)) {
                $data_jurnal2 = [
                    'id_buku' => 4,
                    'id_akun' => $metode1,
                    'kd_gabungan' => $kd_gabungan_akv,
                    'no_nota' => $get_kd_akun_akv2->kd_akun . date('my', strtotime($tgl_akv)) . '-' . $kode_akun_akv2,
                    'kredit' => $kredit_akv,
                    'ket' => 'Penyesuaian Aktiva',
                    'tgl' => $tgl_akv,
                    'tgl_input' => date('Y-m-d H:i:s'),
                    'admin' => $admin,
                    'id_lokasi' => $id_lokasi,
                ];
                Jurnal::create($data_jurnal2);

                $data_jurnal = [
                    'id_buku' => 4,
                    'id_akun' => $id_akun1,
                    'kd_gabungan' => $kd_gabungan_akv,
                    'no_nota' => $get_kd_akun_akv->kd_akun . date('my', strtotime($tgl_akv)) . '-' . $kode_akun_akv,
                    'debit' => $debit_akv,
                    'ket' => 'Penyesuaian Aktiva',
                    'tgl' => $tgl_akv,
                    'tgl_input' => date('Y-m-d H:i:s'),
                    'admin' => $admin,
                    'id_lokasi' => $id_lokasi,
                ];

                Jurnal::create($data_jurnal);

                $barang = $r->barang;
                $biaya_akv = $r->biaya_akv;
                $nm_barang = $r->nm_barang;

                for ($count = 0; $count < count($barang); $count++) {

                    $kelompok = Aktiva::where('nota', $barang[$count])->first();

                    $data_aktiva = [
                        'tgl' => $tgl_akv,
                        'id_kelompok' => $kelompok->id_kelompok,
                        'barang' => $nm_barang[$count],
                        'debit_aktiva' => 0,
                        'kredit_aktiva' => $biaya_akv[$count],
                        'nota' => $barang[$count],
                        'id_lokasi' => $id_lokasi
                    ];
                    Aktiva::create($data_aktiva);
                }
            } else {
            }
        }

        return redirect()->route('jPenyesuaian2', ['acc' => $id_lokasi])->with('sukses', 'Berhasil tambah penyesuaian');
    }
    public function get_relation_peralatan(Request $r)
    {
        return "peralatan";
    }
    public function add_penyesuaian(Request $r)
    {
        return "<h1>add penyesuaian </h1>";
    }

    public function get_aktiva(Request $r)
    {
        return 'get aktiva';
    }

    public function add_penyesuaian_peralatan(Request $r)
    {
        # code...
    }

    public function addPostCenter(Request $request)
    {
        $id_akun = $request->id_akun;
        $nm_post = $request->nm_post;
        $id_lokasi = Session::get('id_lokasi');

        $data = [
            'id_akun' => $id_akun,
            'nm_post' => $nm_post,
            'id_lokasi' => $id_lokasi,
        ];
        PostCenter::create($data);
        echo true;
    }

    public function delPostCenter(Request $r)
    {
        DB::table('tb_post_center')->where('id_post', $r->id_post)->delete();
    }



    public function get_data_post_center(Request $request)
    {
        $id_akun = $request->id_akun;
        $id_lokasi = $request->id_lokasi;

        $data = [
            'post_center' => PostCenter::where('id_akun', $id_akun)->get(),
            'id_akun' => $id_akun
        ];

        return view('accounting.postCenter', $data);
    }

    public function getProjek(Request $request)
    {
        $proyek = $request->id_projek;
        $aktiva = DB::select("SELECT j.id_proyek, sum(j.debit) as kredit1 from tb_jurnal as j where j.id_proyek = '$proyek' group by j.id_proyek");
        $output = [];
        foreach ($aktiva as $k) {
            if ($k->id_proyek == "PR022") {
                $output['b_kredit'] = '0';
            } else {
                $output['b_kredit'] = $k->kredit1;
            }
        }
        echo json_encode($output);
    }

    public function getPost(Request $request)
    {
        $id_pilih = $request->id_pilih;
        $post = PostCenter::where('id_akun', $id_pilih)->get();
        // dd($post);
        echo "<option value=''>Pilih post center</option>";
        foreach ($post as $k) {
            echo "<option value='" . $k->id_post . "'>" . $k->nm_post . "</option>";
        }
    }

    public function getPost2(Request $request)
    {
        $id_pilih = $request->id_pilih;
        $post = PostCenter::where('id_akun', $id_pilih)->get();
        echo "<option value=''>Pilih post center</option>";
        foreach ($post as $k) {
            echo "<option value='" . $k->id_post . "'>" . $k->nm_post . "</option>";
        }
    }

    public function getHargaAktiva(Request $r)
    {
        $id_pilih = $r->id_pilih;
        $id_lokasi = Session::get('id_lokasi');
        $id_akun = $id_lokasi == 1 ? '224' : '225';
        $jurnal = DB::selectOne("SELECT sum(a.debit) as ttl  FROM tb_jurnal as a where a.id_post = '$id_pilih' and a.id_akun = '$id_akun' group by a.id_post");
        if (empty($jurnal)) {
            echo 0;
        } else {
            echo $jurnal->ttl;
        }
    }

    public function addAkun(Request $r)
    {
        $i = Session::get('id_lokasi');
        $bukuBank = $r->bukuBank;
        $biayaDisesuaikan = $r->biayaDisesuaikan;
        $kd_akun = $r->kd_akun;
        $no_akun = $r->no_akun;
        $nm_akun = $r->nm_akun;
        $id_kategori = $r->id_kategori;
        // akun 2
        $kd_akun2 = $r->kd_akun2;
        $no_akun2 = $r->no_akun2;
        $nm_akun2 = $r->nm_akun2;
        $id_kategori2 = $r->id_kategori2;

        $jenisAkun = $r->jenisAkun;
        $jenisStok = $r->jenisStok;
        $id_kredit = [];
        
        $data = [
            'kd_akun' => $kd_akun,
            'no_akun' => $no_akun,
            'nm_akun' => $nm_akun,
            'id_kategori' => $id_kategori,
            'id_lokasi' => $i,
        ];
        $akun1 = Akun::create($data);
        
        if($no_akun2 != '') {
            $dataB = [
                'kd_akun' => $kd_akun2,
                'no_akun' => $no_akun2,
                'nm_akun' => $nm_akun2,
                'id_kategori' => $id_kategori2,
                'id_lokasi' => $i,
            ];

            $akun2 = Akun::create($dataB);

            $dataR = [
                'id_akun' => $akun1->id,
                'id_relation_debit' => $akun2->id,
                'id_relation_kredit' => $akun1->id,
            ];
            DB::table('tb_relasi_akun')->insert($dataR);
        }

        if($id_kategori == '5') {
            $subA = '27';
            $data = [
                'id_akun' => $akun1->id,
                'id_sub_menu_akun' => 27
            ];
            DB::table('tb_permission_akun')->insert($data);
        } else if($id_kategori == '4') {
            $subA = '26';
            $data = [
                'id_akun' => $akun1->id,
                'id_sub_menu_akun' => 26
            ];
            DB::table('tb_permission_akun')->insert($data);
        }else {

        }


        if($id_kategori == '1') {
            if($biayaDisesuaikan == 'on') { $sub = '30'; }
            if($bukuBank == 'on') { $sub = '28'; }

            $data = [
                'id_akun' => $akun1->id,
                'id_sub_menu_akun' => $sub,
            ];
            DB::table('tb_permission_akun')->insert($data);
        }
       
        // for ($i = 1; $i < 3; $i++) {
            

        // }

        return redirect()->route('akun', ['acc' => $r->id_lokasi])->with('sukses', 'Data berhasil Ditambah');
    }

    public function editAkun(Request $request)
    {

        $data = [
            'kd_akun' => $request->kd_akun,
            'no_akun' => $request->no_akun,
            'nm_akun' => $request->nm_akun,
            'id_kategori' => $request->id_kategori,
        ];

        Akun::where('id_akun', $request->id_akun)->update($data);

        return redirect()->route('akun', ['acc' => $request->id_lokasi])->with('sukses', 'Data berhasil Diubah');
    }

    public function exportAkun(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getStyle('A1:D4')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        // lebar kolom
        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);

        $sheet
            ->setCellValue('A1', 'NO AKUN')
            ->setCellValue('B1', 'AKUN ' . $request->id_lokasi == 1 ? 'TAKEMORI' : 'SOONDOBU')
            ->setCellValue('C1', 'KODE AKUN')
            ->setCellValue('D1', 'ID KATEGORI')
            ->setCellValue('E1', 'ID LOKASI');
        $no = 2;
        $data = Akun::join('tb_kategori_akun', 'tb_kategori_akun.id_kategori', '=', 'tb_akun.id_kategori')->where('id_lokasi', $request->id_lokasi)->orderBy('no_akun', 'asc')->get();
        foreach ($data as $k) {
            $sheet
                ->setCellValue('A' . $no, $k->no_akun)
                ->setCellValue('B' . $no, $k->nm_akun)
                ->setCellValue('C' . $no, $k->kd_akun)
                ->setCellValue('D' . $no, $k->id_kategori)
                ->setCellValue('E' . $no, $request->id_lokasi);
            $no++;
        }
        $writer = new Xlsx($spreadsheet);
        $style = [
            'borders' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ],
            ],
        ];

        // tambah style
        $batas = count($data) + 1;
        $sheet->getStyle('A1:E' . $batas)->applyFromArray($style);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data Akun.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function importAkun(Request $request)
    {
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($file);
        // $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
        // $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $lokasi = $request->id_lokasi;
        $numrow = 1;
        foreach ($sheet as $row) {
            if ($numrow > 1) {
                $data = [
                    'id_lokasi' => $row['E'],
                    'kd_akun' => $row['C'],
                    'no_akun' => $row['A'],
                    'nm_akun' => $row['B'],
                    'id_kategori' => $row['D'],
                ];
                Akun::create($data);
            }
            $numrow++;
        }
        return redirect()->route('akun', ['acc' => $lokasi])->with('sukses', 'Data berhasil Diimport');
    }

    public function jPemasukan(Request $request)
    {
        $id_user = Auth::user()->id;
        $id_menu = DB::table('tb_permission')->select('id_menu')->where('id_user', $id_user)
            ->where('id_menu', 32)->first();
        if (empty($id_menu)) {
            return back();
        } else {
            if (Auth::user()->jenis == 'adm') {
                $tglDari = $request->dari;
                $tglSampai = $request->sampai;
                if (empty($tglDari)) {
                    $dari = date('Y-m-1');
                    $sampai = date('Y-m-d');
                } else {
                    $dari = $tglDari;
                    $sampai = $tglSampai;
                }
                $id_lokasi = $request->acc;
                $data = [
                    'title' => 'Jurnal Pemasukan',
                    'logout' => $request->session()->get('logout'),
                    'jurnal' => Jurnal::join('tb_akun', 'tb_akun.id_akun', '=', 'tb_jurnal.id_akun')->where([
                        ['id_buku', 1],
                        ['tb_jurnal.id_lokasi', $id_lokasi]
                    ])->whereBetween('tgl', [$dari, $sampai])->orderBy('tb_jurnal.id_jurnal', 'DESC')->get(),
                ];

                return view('accounting.jPemasukan', $data);
            } else {
                return back();
            }
        }
    }

    public function jPengeluaran2(Request $request)
    {
        $request->session()->put('id_lokasi', $request->acc);
        $id_user = Auth::user()->id;
        $id_menu = DB::table('tb_permission')->select('id_menu')->where('id_user', $id_user)
            ->where('id_menu', 32)->first();
        if (empty($id_menu)) {
            return back();
        } else {
            if (Auth::user()->jenis == 'adm') {
                $tglDari = $request->dari;
                $tglSampai = $request->sampai;
                if (empty($tglDari)) {
                    $dari = date('Y-m-1');
                    $sampai = date('Y-m-d');
                } else {
                    $dari = $tglDari;
                    $sampai = $tglSampai;
                }
                $id_lokasi = Session::get('id_lokasi');
                $data = [
                    'title' => 'Jurnal Pengeluaran',
                    'logout' => $request->session()->get('logout'),
                    'akun' => Akun::where('id_lokasi', $request->acc)->get(),
                    'jurnal' => Jurnal::join('tb_akun', 'tb_akun.id_akun', '=', 'tb_jurnal.id_akun')->where([['tb_jurnal.id_lokasi', $request->get('acc')], ['tb_jurnal.id_buku', 3]])->whereBetween('tgl', [$dari, $sampai])->orderBy('tb_jurnal.id_jurnal', 'DESC')->get(),
                    'satuan' => DB::table('tb_satuan')->get(),
                    'peralatan' => KelPeralatan::all(),
                    'nm_penanggung' => DB::table('tb_penanggung_jawab')->get(),
                    'lokasi' => DB::table('tb_lokasi')->get(),
                    'aktiva' => DB::table('tb_kelompok_aktiva')->get(),
                    'dari' => $dari,
                    'sampai' => $sampai,
                    'lBahanDaging' => DB::table('tb_list_bahan')->where([['id_lokasi', $id_lokasi], ['id_kategori_makanan', $id_lokasi == 1 ? 1 : 2]])->get(),
                    'id_lokasi' => $id_lokasi,
                ];

                return view('accounting.jPengeluaran2', $data);
            } else {
                return back();
            }
        }
    }
    public function jPengeluaran(Request $request)
    {
        $request->session()->put('id_lokasi', $request->acc);
        $id_user = Auth::user()->id;
        $id_menu = DB::table('tb_permission')->select('id_menu')->where('id_user', $id_user)
            ->where('id_menu', 32)->first();
        if (empty($id_menu)) {
            return back();
        } else {
            if (Auth::user()->jenis == 'adm') {
                $tglDari = $request->dari;
                $tglSampai = $request->sampai;
                if (empty($tglDari)) {
                    $dari = date('Y-m-1');
                    $sampai = date('Y-m-d');
                } else {
                    $dari = $tglDari;
                    $sampai = $tglSampai;
                }
                $id_lokasi = Session::get('id_lokasi');
                $data = [
                    'title' => 'Jurnal Pengeluaran',
                    'logout' => $request->session()->get('logout'),
                    'akun' => Akun::where('id_lokasi', $request->acc)->get(),
                    'jurnal' => Jurnal::join('tb_akun', 'tb_akun.id_akun', '=', 'tb_jurnal.id_akun')->where([['tb_jurnal.id_lokasi', $request->get('acc')], ['tb_jurnal.id_buku', 3]])->whereBetween('tgl', [$dari, $sampai])->orderBy('tb_jurnal.id_jurnal', 'DESC')->get(),
                    'satuan' => DB::table('tb_satuan')->get(),
                    'peralatan' => KelPeralatan::all(),
                    'nm_penanggung' => DB::table('tb_penanggung_jawab')->get(),
                    'lokasi' => DB::table('tb_lokasi')->get(),
                    'aktiva' => DB::table('tb_kelompok_aktiva')->get(),
                    'dari' => $dari,
                    'sampai' => $sampai,
                    'lBahanDaging' => DB::table('tb_list_bahan')->where([['id_lokasi', $id_lokasi], ['id_kategori_makanan', $id_lokasi == 1 ? 1 : 2]])->get(),
                    'id_lokasi' => $id_lokasi,
                ];

                return view('accounting.jPengeluaran', $data);
            } else {
                return back();
            }
        }
    }

    public function loadFormJP(Request $r)
    {
        $id_akun = $r->id_akun;
        $getAkun = Akun::where('id_akun', $id_akun)->first();
        $jenis = $getAkun->jenis_akun;
        switch($jenis) {
            case 'peralatan':
                $view = 'peralatan';
                $f = 'addjPeralatan';
                break;
            case 'aktiva':
                $view = 'aktiva';
                $f = 'addjAktiva';
                break;
            case 'persediaan':
                $view = 'persediaan';
                $f = 'addjStok';
                break;
            case 'atk':
                $view = 'atk';
                $f = 'addjAtk';
                break;
            default:
                $view = 'umum';
                $f = 'addjPengeluaran';
                break;   
        }

        $data = [
            'satuan' => DB::table('tb_satuan')->get(),
            'peralatan' => KelPeralatan::all(),
            'nm_penanggung' => DB::table('tb_penanggung_jawab')->get(),
            'aktiva' => DB::table('tb_kelompok_aktiva')->get(),
            'id_lokasi' => Session::get('id_lokasi'),
            'v' => $view,
            'f' => $f,
        ];
        
        return view("accounting.viewJP.$view",$data);
    }

    public function edit_jurnal(Request $r)
    {
        $kd_gabungan = $r->kd_gabungan;

        $debit = DB::selectOne("SELECT a.id_jurnal,a.id_satuan, a.no_nota,a.kd_gabungan,  a.no_urutan, a.qty, a.tgl, a.id_akun, sum(a.debit) AS debit, sum(a.kredit) AS kredit, a.ket
        FROM tb_jurnal AS a
        WHERE a.kd_gabungan = '$kd_gabungan' AND a.debit != '0'
        GROUP BY a.id_akun");

        $kredit = DB::selectOne("SELECT a.id_post,a.kd_gabungan,a.id_satuan, a.id_jurnal, a.tgl, a.id_akun, sum(a.debit) AS debit, sum(a.kredit) AS kredit
        FROM tb_jurnal AS a
        WHERE a.kd_gabungan = '$kd_gabungan' AND a.kredit != '0'
        GROUP BY a.id_akun");

        $kelompok_debit = DB::select("SELECT a.id_satuan,a.id_jurnal, a.tgl, a.id_akun, sum(a.debit) AS debit , a.ket, a.ket2, a.debit, a.no_urutan, a.id_post,a.qty
        FROM tb_jurnal AS a
        WHERE a.kd_gabungan = '$kd_gabungan' AND a.debit != '0'
        GROUP BY a.id_jurnal        
        ");

        $kelompok_debit_daging = DB::select("SELECT a.id_jurnal, a.id_satuan,a.kd_gabungan,a.no_nota, a.tgl, a.id_akun, sum(a.debit) AS debit , a.ket, a.ket2, a.debit, a.no_urutan, a.id_post,a.qty, b.id_stok_makanan,b.id_merk_bahan, c.id_list_bahan,c.nm_bahan
        FROM tb_jurnal AS a
        left join tb_stok_makanan as b on b.id_list_bahan = a.id_produk
        left join tb_list_bahan as c on b.id_list_bahan = c.id_list_bahan
        WHERE a.kd_gabungan = '$kd_gabungan' AND a.debit != '0'
        GROUP BY a.id_jurnal;        
        ");

        $daging = DB::table('tb_stok_makanan')->where('kd_gabungan', $debit->kd_gabungan)->first();

        $bulan = date('m', strtotime($debit->tgl));
        $year = date('Y', strtotime($debit->tgl));

        $jurnal_penutup = DB::selectOne("SELECT * FROM tb_jurnal as a 
        where a.id_buku ='5' AND month(a.tgl) = '$bulan' AND YEAR(a.tgl) = '$year'
        GROUP BY a.id_buku = '5'");

        $data = [
            'kd_gabungan' => $kd_gabungan,
            'akun' => Akun::all(),
            'debit' => $debit,
            'kredit' => $kredit,
            'aktiva_benda' => DB::selectOne("SELECT *, SUM(a.kredit_aktiva) AS kredit from aktiva as a 
            where a.nota = '$debit->no_nota' 
            GROUP BY a.nota"),
            'kelompok_debit' => $kelompok_debit,
            'kelompok_debit_daging' => $kelompok_debit_daging,
            'post_center' => DB::table('tb_post_center')->where('id_akun', $debit->id_akun)->get(),
            'post_center_aktiva' => DB::select("SELECT a.*
            FROM tb_post_center AS a 
            WHERE a.id_akun = '$kredit->id_akun'  AND a.nm_post NOT IN(SELECT b.barang FROM aktiva AS b)"),
            'post' => DB::table('tb_post_center')->where('id_post', $kredit->id_post)->first(),
            'satuan' => DB::table('tb_satuan')->get(),
            'aktiva' => DB::table('tb_kelompok_aktiva')->get(),
            'list_bahan' => DB::table('tb_list_bahan')->get(),
            'daging' => $daging,
            'jurnal_penutup' => $jurnal_penutup,
        ];
        $v = 'umum';
        if($debit->id_akun == 143 || $debit->id_akun == 146) {
            $v = 'aktiva';
        } else if($debit->id_akun == 228 || $debit->id_akun == 229) {
            $v = 'stok';
        }
      
        return view("accounting.$v",$data);

    }

    public function saveEditJurnal(Request $r)
    {
        $tgl = $r->tgl;
        $id_jurnal_kredit = $r->id_jurnal_kredit;
        $id_jurnal_debit = $r->id_jurnal_debit;
        $id_akun_debit = $r->id_akun_debit;
        $id_akun_kredit = $r->id_akun_kredit;
        $kredit = $r->kredit;
        $no_id = $r->no_id;
        $ket = $r->ket;
        $ket2 = $r->ket2;
        $id_post_center = $r->id_post_center;
        $qty = $r->qty;
        $id_satuan = $r->id_satuan;
        $debit = $r->debit;

        
        $month = date('m', strtotime($tgl));
        $year = date('Y', strtotime($tgl));
    }

    public function addjPengeluaran(Request $request)
    {
        $redi = $request->stokMakanan == 'Y' ? 'stokMakanan' : 'jPengeluaran';
        $kd_gabungan = 'RST' . date('dmy') . strtoupper(Str::random(3));
        // dd($kd_gabungan);
        $tgl = $request->tgl;
        $id_akun = $request->id_akun;
        $metode = $request->metode;
        $ket = $request->keterangan;
        $ket2 = $request->ket2;
        $ttl_rp = $request->ttl_rp;
        $id_proyek = $request->id_proyek;
        $admin = Auth::user()->nama;
        $id_satuan = $request->id_satuan;
        $qty = $request->qty;
        $id_post = $request->id_post_center;
        $no_id = $request->no_id;
        $id_lokasi = $request->id_lokasi;

        $month = date('m', strtotime($tgl));
        $year = date('Y', strtotime($tgl));

        $get_kode_akun = Akun::where('id_akun', $id_akun)->get()[0];
        $kode_akun = Jurnal::where('id_akun', $id_akun)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

        if ($kode_akun == 0) {
            $kode_akun = 1;
        } else {
            $kode_akun += 1;
        }

        $get_kd_metode = Akun::where('id_akun', $metode)->get()[0];
        $kode_metode = Jurnal::where('id_akun', $metode)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

        if ($kode_metode == 0) {
            $kode_metode = 1;
        } else {
            $kode_metode += 1;
        }

        $total = 0;

        for ($count = 0; $count < count($ttl_rp); $count++) {
            $total += $ttl_rp[$count];
        }

        $data_metode = [
            'id_buku' => 3,
            'id_akun' => $metode,
            'id_akun_lawan' => $id_akun,
            'id_customer' => '3',
            'kd_gabungan' => $kd_gabungan,
            'no_nota' => $get_kd_metode->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_metode,
            'kredit' => $total,
            'tgl' => $tgl,
            'tgl_input' => date('Y-m-d H:i:s'),
            'admin' => $admin,
            'jenis' => 'biaya',
            'id_lokasi' => $id_lokasi,
            'id_post' => $id_post[$count]

        ];

        Jurnal::create($data_metode);

        for ($i = 0; $i < count($ttl_rp); $i++) {
            // $total += $ttl_rp[$i];
            $data_jurnal = [
                'id_buku' => 3,
                'id_akun' => $id_akun,
                'id_akun_lawan' => $metode,
                'id_customer' => '3',
                'kd_gabungan' => $kd_gabungan,
                'id_proyek' => $id_proyek,
                'no_nota' => $get_kode_akun->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_akun,
                'debit' => $ttl_rp[$i],
                'ket' => $ket[$i],
                'ket2' => $ket2[$i],
                'tgl' => $tgl,
                'tgl_input' => date('Y-m-d H:i:s'),
                'admin' => $admin,
                'qty' => $qty[$i],
                'no_urutan' => $no_id[$i],
                'id_satuan' => $id_satuan[$i],
                // 'rp_beli' => $rp_beli[$i],
                'ttl_rp' => $ttl_rp[$i],
                'jenis' => 'biaya',
                'id_lokasi' => $id_lokasi,
                'id_post' => $id_post[$i],
            ];

            Jurnal::create($data_jurnal);
            // $kode_akun++;
        }
        
        return redirect()->route($redi, ['acc' => $id_lokasi])->with('sukses', 'Data berhasil Ditambah');
    }

    public function addjAtk(Request $request)
    {
        $kd_gabungan = 'RST' . date('dmy') . strtoupper(Str::random(3));
        // dd($kd_gabungan);
        $tgl = $request->tgl;
        $id_akun = $request->id_akun;
        $metode = $request->metode;
        $ket = $request->keterangan;
        $ket2 = $request->ket2;
        $ttl_rp = $request->ttl_rp;
        $id_proyek = $request->id_proyek;
        $admin = Auth::user()->nama;
        $id_satuan = $request->id_satuan;
        $qty = $request->qty;
        $id_post = $request->id_post_center;
        $no_id = $request->no_id;

        $id_lokasi = $request->id_lokasi;

        $month = date('m', strtotime($tgl));
        $year = date('Y', strtotime($tgl));

        $get_kode_akun = Akun::where('id_akun', $id_akun)->get()[0];
        $kode_akun = Jurnal::where('id_akun', $id_akun)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

        if ($kode_akun == 0) {
            $kode_akun = 1;
        } else {
            $kode_akun += 1;
        }

        $get_kd_metode = Akun::where('id_akun', $metode)->get()[0];
        $kode_metode = Jurnal::where('id_akun', $metode)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

        if ($kode_metode == 0) {
            $kode_metode = 1;
        } else {
            $kode_metode += 1;
        }

        $total = 0;
        for ($i = 0; $i < count($ttl_rp); $i++) {
            $total += $ttl_rp[$i];
        }

        $data_metode = [
            'id_buku' => 3,
            'id_akun' => $metode,
            'id_customer' => '3',
            'kd_gabungan' => $kd_gabungan,
            'no_nota' => $get_kd_metode->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_metode,
            'kredit' => $total,
            'tgl' => $tgl,
            'tgl_input' => date('Y-m-d H:i:s'),
            'admin' => $admin,
            'jenis' => 'atk',
            'id_lokasi' => $id_lokasi,
            'id_post' => $id_post[$i]

        ];

        Jurnal::create($data_metode);

        for ($i = 0; $i < count($ttl_rp); $i++) {
            // $total += $ttl_rp[$i];
            $data_jurnal = [
                'id_buku' => 3,
                'id_akun' => $id_akun,
                'id_customer' => '3',
                'kd_gabungan' => $kd_gabungan,
                'id_proyek' => $id_proyek,
                'no_nota' => $get_kode_akun->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_akun,
                'debit' => $ttl_rp[$i],
                'ket' => $ket[$i],
                'ket2' => $ket2[$i],
                'tgl' => $tgl,
                'tgl_input' => date('Y-m-d H:i:s'),
                'admin' => $admin,
                'qty' => $qty[$i],
                'no_urutan' => $no_id[$i],
                'id_satuan' => $id_satuan[$i],
                // 'rp_beli' => $rp_beli[$i],
                'ttl_rp' => $ttl_rp[$i],
                'jenis' => 'atk',
                'id_lokasi' => $id_lokasi,
            ];

            Jurnal::create($data_jurnal);
            // $kode_akun++;
        }

        for ($i = 0; $i < count($ket); $i++) {

            $nota = DB::selectOne("SELECT MAX(a.no_nota) as nota
            FROM tb_atk AS a");
            if (empty($nota->nota)) {
                $no = '1001';
            } else {
                $no = $nota->nota + 1;
            }
            $data_atk = [
                'no_nota' => $no,
                'tgl' => $tgl,
                'nm_barang' => $ket2[$i],
                'debit_atk' => $ttl_rp[$i],
                'qty_debit' => $qty[$i],
                'id_satuan' => $id_satuan[$i],
                'id_lokasi' => $id_lokasi

            ];
            Atk::create($data_atk);
        }

        return redirect()->route('jPengeluaran', ['acc' => $id_lokasi])->with('sukses', 'Data berhasil Ditambah');
    }

    public function addjPeralatan(Request $request)
    {
        $kd_gabungan = 'RST' . date('dmy') . strtoupper(Str::random(3));
        // dd($kd_gabungan);
        $tgl = $request->tgl;
        $id_akun = $request->id_akun;
        $metode = $request->metode;
        $nm_barang = $request->nm_barang;
        $ttl_rp = $request->ttl_rp;
        $total3 = $request->total;
        $admin = Auth::user()->nama;
        $id_satuan = $request->id_satuan;
        $qty = $request->qty;
        $no_urutan = $request->no_id;
        $id_lokasi = $request->id_lokasi;
        $id_penanggung = $request->id_penanggung;
        $id_kelompok = $request->id_kelompok;

        $month = date('m', strtotime($tgl));
        $year = date('Y', strtotime($tgl));

        $get_kode_akun = Akun::where('id_akun', $id_akun)->get()[0];
        $kode1 = DB::selectOne("SELECT a.id_jurnal,a.no_nota, SUBSTRING(a.no_nota,-1) AS nota2
        FROM tb_jurnal AS a
        WHERE a.id_akun = '$id_akun' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'
        GROUP BY a.no_nota
        ORDER BY SUBSTRING(a.no_nota,-1) DESC");

        if (empty($kode1)) {
            $kode_akun = 1;
        } else {
            $kode_akun = $kode1->nota2 + 1;
        }

        $get_kd_metode = Akun::where('id_akun', $metode)->get()[0];
        $kode = DB::selectOne("SELECT a.id_jurnal,a.no_nota, SUBSTRING(a.no_nota,-1) AS nota2
        FROM tb_jurnal AS a
        WHERE a.id_akun = '$metode' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'
        GROUP BY a.no_nota
        ORDER BY SUBSTRING(a.no_nota,-1) DESC
        ");

        if (empty($kode)) {
            $kode_metode = 1;
        } else {
            $kode_metode = $kode->nota2 + 1;
        }

        $total = 0;
        for ($count = 0; $count < count($ttl_rp); $count++) {
            $total += $ttl_rp[$count];
        }

        $data_metode = [
            'id_buku' => 3,
            'id_akun' => $metode,
            'id_customer' => '3',
            'kd_gabungan' => $kd_gabungan,
            'no_nota' => $get_kd_metode->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_metode,
            'kredit' => $total3,
            'tgl' => $tgl,
            'tgl_input' => date('Y-m-d H:i:s'),
            'admin' => $admin,
            'jenis' => 'peralatan',
            'id_lokasi' => $id_lokasi,
            // 'id_post' => $id_post

        ];

        Jurnal::create($data_metode);

        for ($i = 0; $i < count($ttl_rp); $i++) {
            $data_jurnal = [
                'id_buku' => 3,
                'id_customer' => '3',
                'id_akun' => $id_akun,
                'kd_gabungan' => $kd_gabungan,
                'no_nota' => $get_kode_akun->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_akun,
                'debit' => $ttl_rp[$i],
                'ket' => 'pembelian ' . ' ' . $nm_barang[$i],
                'tgl' => $tgl,
                'tgl_input' => date('Y-m-d H:i:s'),
                'admin' => $admin,
                'qty' => $qty[$i],
                'id_satuan' => $id_satuan[$i],
                'ttl_rp' => $ttl_rp[$i],
                'no_urutan' => $no_urutan[$i],
                'jenis' => 'peralatan',
                'id_lokasi' => $id_lokasi
            ];
            $id_kredit = Jurnal::create($data_jurnal);
            $id_kredit = $id_kredit->id;
        }

        for ($x = 0; $x < sizeof($nm_barang); $x++) {

            $kelompok = KelPeralatan::where('id_kelompok', $id_kelompok[$x])->first();

            if ($kelompok->satuan == 'Bulan') {
                $susut = $kelompok->umur;
            } else {
                $susut = $kelompok->umur * 12;
            }
            $b_penyusutan = $ttl_rp[$x] / $susut;

            $data_barang = [
                'tgl' => $tgl,
                'id_kelompok_peralatan' =>  $id_kelompok[$x],
                'barang' => $nm_barang[$x],
                'qty' => $qty[$x],
                'debit' => $ttl_rp[$x],
                'lokasi' => $id_lokasi[$x],
                'id_satuan' => $id_satuan[$x],
                'penanggung_jawab' => $id_penanggung[$x],
                'id_peralatan_kredit' => $id_kredit,
                'b_penyusutan' =>  $b_penyusutan,

            ];
            Peralatan::create($data_barang);
        }
        return redirect()->route('jPengeluaran', ['acc' => $id_lokasi])->with('sukses', 'Data berhasil Ditambah');
    }

    public function addjAktiva(Request $request)
    {
        $kd_gabungan = 'RST' . date('dmy') . strtoupper(Str::random(3));
        // dd($kd_gabungan);
        $tgl = $request->tgl;
        $id_akun = $request->id_akun;
        $metode = $request->metode;
        $ttl_rp = $request->ttl_rp;
        $total = $request->total;
        $admin = Auth::user()->nama;
        $rp_satuan = $request->rp_satuan;
        $qty = $request->qty;
        $ppn = $request->ppn;
        $id_lokasi = Session::get('id_lokasi');
        $id_post = $request->id_post;
        $ket2 = $request->ket;
        $no_urutan = $request->no_id;
        $id_satuan = $request->id_satuan;


        // aktiva
        $id_kelompok = $request->id_kelompok;
        $kelompok = DB::table('tb_kelompok_aktiva')->where('id_kelompok', $id_kelompok)->first();
        $susut = $kelompok->tarif;
        $satuan = DB::table('tb_satuan')->where('id', $id_satuan)->first();
        $penyusutan = (($rp_satuan * $qty) * $susut) / 12;
        $post_center = DB::table('tb_post_center')->where('id_post')->first();
        $ket3 = empty($post_center->nm_post) ? $ket2 : $post_center->nm_post;
        $month = date('m', strtotime($tgl));
        $year = date('Y', strtotime($tgl));

        $get_kode_akun = Akun::where('id_akun', $id_akun)->get()[0];
        $kode1 = DB::selectOne("SELECT a.id_jurnal,a.no_nota, SUBSTRING(a.no_nota,-1) AS nota2
        FROM tb_jurnal AS a
        WHERE a.id_akun = '$id_akun' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'
        GROUP BY a.no_nota
        ORDER BY SUBSTRING(a.no_nota,-1) DESC");


        if (empty($kode1)) {
            $kode_akun = 1;
        } else {
            $kode_akun = $kode1->nota2 + 1;
        }

        $get_kd_metode = Akun::where('id_akun', $metode)->get()[0];
        $kode = DB::selectOne("SELECT a.id_jurnal,a.no_nota, SUBSTRING(a.no_nota,-1) AS nota2
        FROM tb_jurnal AS a
        WHERE a.id_akun = '$metode' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'
        GROUP BY a.no_nota
        ORDER BY SUBSTRING(a.no_nota,-1) DESC
        ");

        if (empty($kode)) {
            $kode_metode = 1;
        } else {
            $kode_metode = $kode->nota2 + 1;
        }

        $total = $ttl_rp;
        $id_akunPPN = $id_lokasi == 1 ? 222 : 223;
        $get_kode_ppn = Akun::where('id_akun', $id_akunPPN)->get()[0];
        $kode_ppn = Jurnal::where('id_akun', $id_akunPPN)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

        if ($kode_ppn == 0) {
            $kode_ppn = 1;
        } else {
            $kode_ppn += 1;
        }

        $data_metode = [
            'id_buku' => 3,
            'id_akun' => $metode,
            'id_customer' => '3',
            'kd_gabungan' => $kd_gabungan,
            'no_nota' => $get_kd_metode->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_metode,
            'kredit' => $total,
            'tgl' => $tgl,
            'tgl_input' => date('Y-m-d H:i:s'),
            'admin' => $admin,
            'jenis' => 'aktiva',
            'id_lokasi' => $id_lokasi,
            'no_urutan' => $no_urutan,
            'id_post' => $id_post

        ];

        Jurnal::create($data_metode);

        if (empty($ppn)) {
        } else {
            $data_jurnal1 = [
                'id_buku' => 3,
                'id_akun' => $id_akunPPN,
                'id_customer' => '3',
                'kd_gabungan' => $kd_gabungan,
                'no_nota' => $get_kode_akun->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_akun,
                'debit' => $ppn,
                'tgl' => $tgl,
                'ttl_rp' => $total,
                'tgl_input' => date('Y-m-d H:i:s'),
                'admin' => $admin,
                'no_urutan' => $no_urutan,
                // 'rp_beli' => $rp_beli[$i],
                'jenis' => 'aktiva',
                'id_lokasi' => $id_lokasi,
            ];

            Jurnal::create($data_jurnal1);
            $kode_akun++;
        }

        $data_jurnal2 = [
            'id_buku' => 3,
            'id_akun' => $id_akun,
            'id_customer' => '3',
            'kd_gabungan' => $kd_gabungan,
            'no_nota' => $get_kode_akun->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_akun,
            'debit' => $rp_satuan * $qty,
            'tgl' => $tgl,
            'ket' => $ket3,
            'ttl_rp' => $ttl_rp,
            'tgl_input' => date('Y-m-d H:i:s'),
            'admin' => $admin,
            'qty' => $qty,
            'no_urutan' => $no_urutan,
            // 'rp_beli' => $rp_beli[$i],
            'jenis' => 'aktiva',
            'id_lokasi' => $id_lokasi,
        ];

        Jurnal::create($data_jurnal2);


        $aktiva = [
            'id_lokasi' => $id_lokasi,
            'barang' => $ket3,
            'debit_aktiva' => $rp_satuan * $qty,
            'tgl' => $tgl,
            'qty' => $qty,
            'satuan' => $satuan->n,
            'id_kelompok' => $id_kelompok,
            'nota' => $get_kode_akun->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_akun,
            'b_penyusutan' => $penyusutan,
        ];

        Aktiva::create($aktiva);

        return redirect()->route('jPengeluaran', ['acc' => $id_lokasi])->with('sukses', 'Data berhasil Ditambah');
    }

    public function addjStok(Request $r)
    {
        
        $redi = $r->stokMakanan == 'Y' ? 'stokMakanan' : 'jPengeluaran';
       
        $id_lokasi = Session::get('id_lokasi');
        
        $tgl = $r->tgl;
        $id_akun = $r->id_akun;
        $metode = $r->metode;
        $ket = $r->keterangan;
        $ttl_rp = $r->ttl_rp;
        // $id_proyek = $r->id_proyek;
        $admin = Auth::user()->nama;
        $id_satuan = $r->id_satuan;
        $qty = $r->qty;
        $no_id = $r->no_id;
        $id_list_bahan = $r->id_list_bahan;
        $id_merk_bahan = $r->id_merk_bahan;
        $biaya_penunjang = $r->biaya_penunjang;
        $ppn = $r->ppn;
        $ongkir = $r->ongkir;
        $parkir = $r->parkir;
        $month = date('m', strtotime($tgl));
        $year = date('Y', strtotime($tgl));
    
        
        $get_kode_akun = Akun::where('id_akun', $id_akun)->get()[0];
        $kode_akun = Jurnal::where('id_akun', $id_akun)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();
        
        if ($kode_akun == 0) {
            $kode_akun = 1;
        } else {
            $kode_akun += 1;
        }

        $get_kd_metode = Akun::where('id_akun', $metode)->get()[0];
        $kode_metode = Jurnal::where('id_akun', $metode)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

        if ($kode_metode == 0) {
            $kode_metode = 1;
        } else {
            $kode_metode += 1;
        }

        $total = 0;
        // for ($count = 0; $count < count($ttl_rp); $count++) {
        //     $total += $r->t_rp[$count] + $ppn[$count];
        // }

        

        for ($i = 0; $i < count($ttl_rp); $i++) {
            $lBahan = DB::table('tb_list_bahan')->where('id_list_bahan', $id_list_bahan[$i])->first();
            
            $kd_gabungan = 'RST' . date('dmy') . strtoupper(Str::random(3));
            
            $data_metode = [
                'id_buku' => 3,
                'id_akun' => $metode,
                'id_customer' => '3',
                'kd_gabungan' => $kd_gabungan,
                'no_nota' => $get_kd_metode->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_metode,
                'kredit' => $r->t_rp[$i] + $ppn[$i],
                'tgl' => $tgl,
                'tgl_input' => date('Y-m-d H:i:s'),
                'admin' => $admin,
                'jenis' => 'stok',
                'id_lokasi' => $id_lokasi,
                // 'id_post' => $id_post[$count]
            ];
            Jurnal::create($data_metode);

            $id_akunPPN = $id_lokasi == 1 ? 320 : 321;
            $get_kode_ppn = Akun::where('id_akun', $id_akunPPN)->get()[0];
            $kode_ppn = Jurnal::where('id_akun', $id_akunPPN)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();
    
            if ($kode_ppn == 0) {
                $kode_ppn = 1;
            } else {
                $kode_ppn += 1;
            }

            $dataPpn = [
                'id_buku' => 3,
                'id_akun' => $id_akunPPN,
                'id_customer' => '3',
                'kd_gabungan' => $kd_gabungan,
                'no_nota' => $get_kode_ppn->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_ppn,
                'debit' => $ppn[$i],
                'tgl' => $tgl,
                'ttl_rp' => $r->t_rp[$i],
                'tgl_input' => date('Y-m-d H:i:s'),
                'admin' => $admin,
                'no_urutan' => $no_id,
                // 'rp_beli' => $rp_beli[$i],
                'jenis' => 'stok',
                'id_lokasi' => $id_lokasi,
            ];
            Jurnal::create($dataPpn);

            // $total += $ttl_rp[$i];
            $data_jurnal = [
                'id_buku' => 3,
                'id_akun' => $id_akun,
                'id_customer' => '3',
                'kd_gabungan' => $kd_gabungan,
                // 'id_proyek' => $id_proyek,
                'no_nota' => $get_kode_akun->kd_akun . date('my', strtotime($tgl)) . '-' . $kode_akun,
                'debit' => $r->t_rp[$i] + $ppn[$i],
                'ket' => $lBahan->nm_bahan,
                'ket2' => $ket,
                'tgl' => $tgl,
                'tgl_input' => date('Y-m-d H:i:s'),
                'admin' => $admin,
                'qty' => $qty[$i],
                'no_urutan' => $no_id,
                'id_satuan' => $id_satuan[$i],
                'id_produk' => $id_list_bahan[$i],
                // 'rp_beli' => $rp_beli[$i],
                'ttl_rp' => $r->t_rp[$i],
                'jenis' => 'stok',
                'id_lokasi' => $id_lokasi,
                // 'id_post' => $id_post[$i],
            ];

            $jid = Jurnal::create($data_jurnal);
            if (empty($id_list_bahan[$i])) {
                # code...
            } else {
                $data_pakan = [
                    'tgl' => $tgl,
                    'id_lokasi' => $id_lokasi,
                    'id_list_bahan' => $id_list_bahan[$i],
                    'id_merk_bahan' => $id_merk_bahan[$i],
                    'debit_makanan' => $r->qtyResep[$i],
                    'kredit_makanan' => 0,
                    'kd_gabungan' => $kd_gabungan,
                    'admin' => $admin,
                    'h_satuan' => $ttl_rp[$i],
                    'satuan_beli' => $r->id_satuanBeli[$i],
                ];
                DB::table('tb_stok_makanan')->insert($data_pakan);
            }
            $kode_akun++;
        }

        return redirect()->route($redi, ['acc' => $id_lokasi])->with('sukses', 'Data berhasil Ditambah');
    }

    public function deletejPengeluaran(Request $request)
    {
        Jurnal::where('kd_gabungan', $request->kd_gabungan)->delete();
        DB::table('tb_stok_makanan')->where('kd_gabungan', $request->kd_gabungan)->delete();
        return redirect()->route('jPengeluaran', ['acc' => $request->id_lokasi, 'dari' => $request->dari, 'sampai' => $request->sampai])->with('error', 'Data berhasil dihapus');
    }

    public function exportJPengeluaran(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;

        $jurnal = DB::select("SELECT a.* ,b.no_akun, b.nm_akun, c.nm_post, d.n, a.admin
        FROM tb_jurnal as a 
        left join tb_akun as b on b.id_akun = a.id_akun 
        left join tb_post_center AS c ON c.id_post = a.id_post
        left join tb_satuan AS d ON d.id = a.id_satuan
        WHERE a.id_buku IN('3','4','5') and a.tgl between '$dari' and '$sampai'  order by a.no_urutan  ASC;");

        $spreadsheet = new Spreadsheet;
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setTitle('Jurnal Pengeluaran');
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Id');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Tanggal');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'D');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'M');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Y');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'No Nota');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'No id');
        $spreadsheet->getActiveSheet()->setCellValue('H1', 'Id Akun');
        $spreadsheet->getActiveSheet()->setCellValue('I1', 'No Akun');
        $spreadsheet->getActiveSheet()->setCellValue('J1', 'Post Akun');
        $spreadsheet->getActiveSheet()->setCellValue('K1', 'Id Post Center');
        $spreadsheet->getActiveSheet()->setCellValue('L1', 'Post Center');
        $spreadsheet->getActiveSheet()->setCellValue('M1', 'Keterangan');
        $spreadsheet->getActiveSheet()->setCellValue('N1', 'Qty');
        $spreadsheet->getActiveSheet()->setCellValue('O1', 'Satuan');
        $spreadsheet->getActiveSheet()->setCellValue('P1', 'Debit');
        $spreadsheet->getActiveSheet()->setCellValue('Q1', 'Kredit');
        $spreadsheet->getActiveSheet()->setCellValue('R1', 'Admin');

        $style = array(
            'font' => array(
                'size' => 9
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
        );

        $spreadsheet->getActiveSheet()->getStyle('A1:R1')->applyFromArray($style);


        $yelow = array(
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => 'F7F700')
            )
        );

        $red = array(
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => 'F70000')
            )
        );

        $spreadsheet->getActiveSheet()->getStyle('A1:R1')->getAlignment()->setWrapText(true);

        // $spreadsheet->getActiveSheet()->getRowDimension('3')->setRowHeight(23);

        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(34.73);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(9.91);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(9.64);

        $spreadsheet->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
        // $spreadsheet->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode('');
        $spreadsheet->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode('');
        $spreadsheet->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode('0000');

        $kolom = 2;
        foreach ($jurnal as $d) {
            $spreadsheet->setActiveSheetIndex(0);
            $spreadsheet->getActiveSheet()->setCellValue('A' . $kolom, $d->id_jurnal);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $kolom, date('Y-m-d', strtotime($d->tgl)));
            $spreadsheet->getActiveSheet()->setCellValue('C' . $kolom, date('d', strtotime($d->tgl)));
            $spreadsheet->getActiveSheet()->setCellValue('D' . $kolom, date('m', strtotime($d->tgl)));
            $spreadsheet->getActiveSheet()->setCellValue('E' . $kolom, date('Y', strtotime($d->tgl)));
            $spreadsheet->getActiveSheet()->setCellValue('F' . $kolom, $d->no_nota);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $kolom, $d->no_urutan);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $kolom, $d->id_akun);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $kolom, $d->no_akun);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $kolom, $d->nm_akun);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $kolom, $d->id_post);

            $spreadsheet->getActiveSheet()->setCellValue('L' . $kolom, $d->nm_post);


            $spreadsheet->getActiveSheet()->setCellValue('M' . $kolom, $d->ket);
            $spreadsheet->getActiveSheet()->setCellValue('N' . $kolom, $d->qty);
            $spreadsheet->getActiveSheet()->setCellValue('O' . $kolom, $d->n);
            $spreadsheet->getActiveSheet()->setCellValue('P' . $kolom, $d->debit);
            $spreadsheet->getActiveSheet()->setCellValue('Q' . $kolom, $d->kredit);
            $spreadsheet->getActiveSheet()->setCellValue('R' . $kolom, $d->admin);
            $kolom++;
        }

        $border_collom = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            )
        );

        $batas = $kolom - 1;
        $spreadsheet->getActiveSheet()->getStyle('A1:R' . $batas)->applyFromArray($style);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data export jurnal all.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function exportJPemasukan(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;

        $jurnal = DB::select("SELECT a.* ,b.no_akun, b.nm_akun, c.nm_post, d.n, a.admin
        FROM tb_jurnal as a 
        left join tb_akun as b on b.id_akun = a.id_akun 
        left join tb_post_center AS c ON c.id_post = a.id_post
        left join tb_satuan AS d ON d.id = a.id_satuan
        WHERE a.id_buku IN('1') and a.tgl between '$dari' and '$sampai'  order by a.no_urutan  ASC;");

        $spreadsheet = new Spreadsheet;
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setTitle('Jurnal Pengeluaran');
        $spreadsheet->getActiveSheet()->setCellValue('A1', '#');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Tanggal');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'D');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'M');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Y');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'No Invoice');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'Keterangan');
        $spreadsheet->getActiveSheet()->setCellValue('H1', 'No Akun');
        $spreadsheet->getActiveSheet()->setCellValue('I1', 'Nama Akun');
        $spreadsheet->getActiveSheet()->setCellValue('J1', 'Debit');
        $spreadsheet->getActiveSheet()->setCellValue('K1', 'Kredit');

        $style = array(
            'font' => array(
                'size' => 9
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
        );

        $spreadsheet->getActiveSheet()->getStyle('A1:K1')->applyFromArray($style);


        $yelow = array(
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => 'F7F700')
            )
        );

        $red = array(
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => 'F70000')
            )
        );

        $spreadsheet->getActiveSheet()->getStyle('A1:K1')->getAlignment()->setWrapText(true);

        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(9.91);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(9.64);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(9.64);

        $spreadsheet->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
        // $spreadsheet->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode('');
        $spreadsheet->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode('');
        $spreadsheet->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode('0000');

        $kolom = 2;
        $no = 1;
        $debit = 0;
        $kredit = 0;
        foreach ($jurnal as $d) {
            $spreadsheet->setActiveSheetIndex(0);
            $spreadsheet->getActiveSheet()->setCellValue('A' . $kolom, $no++);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $kolom, date('Y-m-d', strtotime($d->tgl)));
            $spreadsheet->getActiveSheet()->setCellValue('C' . $kolom, date('d', strtotime($d->tgl)));
            $spreadsheet->getActiveSheet()->setCellValue('D' . $kolom, date('m', strtotime($d->tgl)));
            $spreadsheet->getActiveSheet()->setCellValue('E' . $kolom, date('Y', strtotime($d->tgl)));
            $spreadsheet->getActiveSheet()->setCellValue('F' . $kolom, $d->no_nota);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $kolom, $d->ket);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $kolom, $d->no_akun);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $kolom, $d->nm_akun);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $kolom, $d->debit);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $kolom, $d->kredit);
            $kolom++;
            $debit += $d->debit;
            $kredit += $d->kredit;
        }
        $spreadsheet->getActiveSheet()->setCellValue('A' . $kolom, 'TOTAL');
        $spreadsheet->getActiveSheet()->setCellValue('J' . $kolom, $debit);
        $spreadsheet->getActiveSheet()->setCellValue('K' . $kolom, $kredit);

        $border_collom = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            )
        );

        $batas = $kolom - 1;
        $spreadsheet->getActiveSheet()->getStyle('A1:K' . $batas + 1)->applyFromArray($style);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data export jurnal all.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function lapBulanan(Request $request)
    {
        $id_lokasi = Session::get('id_lokasi');
        $periode = DB::select("SELECT tgl FROM tb_jurnal where id_lokasi = $id_lokasi GROUP BY MONTH(tgl), YEAR(tgl) ORDER BY tgl ASC");

        $akun_pendapatan = DB::select("SELECT a.*
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '21'");

        // $kategori = [4,7];
        $akun_pengeluaran = DB::select("SELECT a.*
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '22'");

        $akun_biaya_fix = DB::select("SELECT a.*
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '23'");

        $akun_aktiva = DB::select("SELECT a.*
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '25'");

        $tahun = DB::select("SELECT tgl FROM tb_jurnal GROUP BY YEAR(tgl)");

        $data = [
            'title' => 'Laporan Bulanan',
            'logout' => $request->session()->get('logout'),
            'tahun' => $tahun,
            'akun_aktiva' => $akun_aktiva,
            'akun_biaya_fix' => $akun_biaya_fix,
            'akun_pengeluaran' => $akun_pengeluaran,
            'akun_pendapatan' => $akun_pendapatan,
            'periode' => $periode,
            'id_lokasi' => Session::get('id_lokasi'),
        ];
        return view('accounting.homepage.lapBulanan', $data);
    }

    public function excelLapBulanan(Request $r)
    {
        $periode = DB::select("SELECT tgl FROM tb_jurnal GROUP BY MONTH(tgl) AND YEAR(tgl) ORDER BY tgl ASC");
        $akun_pendapatan = DB::select("SELECT a.*
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '21'");

        // $kategori = [4,7];
        $akun_pengeluaran = DB::select("SELECT a.*
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '22'");

        $akun_biaya_fix = DB::select("SELECT a.*
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '23'");

        $akun_aktiva = DB::select("SELECT a.*
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '25'");

        $tahun = DB::select("SELECT tgl FROM tb_jurnal GROUP BY YEAR(tgl)");
        $data = [
            'title' => 'Laporan Bulanan',
            'logout' => $r->session()->get('logout'),
            'tahun' => $tahun,
            'akun_aktiva' => $akun_aktiva,
            'akun_biaya_fix' => $akun_biaya_fix,
            'akun_pengeluaran' => $akun_pengeluaran,
            'akun_pendapatan' => $akun_pendapatan,
            'periode' => $periode,
            'id_lokasi' => Session::get('id_lokasi'),
        ];
        return view('accounting.homepage.exportBulanan', $data);
    }

    public function getDetailLap(Request $r)
    {
        $id_akun = $r->id_akun;
        $bulan = $r->bulan;
        $tahun = $r->tahun;

        $bulan_sebelum = date('Y-m-d', strtotime('last day of -1 month', strtotime($tahun . '-' . $bulan . '-' . '01')));

        $jurnal = DB::select("SELECT a.id_buku, b.nm_akun, a.debit, a.kredit, a.ket, c.nm_post
        FROM tb_jurnal AS a
        LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
        left join tb_post_center as c on c.id_post = a.id_post
        WHERE a.id_akun = '$id_akun' AND MONTH(a.tgl) = '$bulan' AND YEAR(a.tgl) = '$tahun'");
        
        $jurnalS = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a left Join tb_akun as b on a.id_akun = b.id_akun WHERE a.tgl = '$bulan_sebelum' and a.id_akun = '$id_akun' order by a.tgl DESC limit 1");

        $data = [
            'id_akun' => $id_akun,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jurnal' => $jurnal,
            'jurnalS' => $jurnalS,
        ];
        return view('accounting.homepage.detail', $data);
    }

    public function getDetailLap2(Request $r)
    {
        $id_akun = $r->id_akun;
        $bulan = $r->bulan;
        $tahun = $r->tahun;
        $jurnal = DB::select("SELECT a.id_buku, a.tgl,a.no_nota, b.nm_akun, a.debit, a.kredit, a.ket, c.nm_post, d.nm_akun AS akun2
        FROM tb_jurnal AS a
        LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
        left join tb_post_center as c on c.id_post = a.id_post
        
        LEFT JOIN (SELECT b.kd_gabungan, b.id_akun, c.nm_akun
        FROM tb_jurnal AS b
        LEFT JOIN tb_akun AS c ON c.id_akun = b.id_akun 
        WHERE b.id_akun != '$id_akun'
        group by b.kd_gabungan
        ) AS d ON d.kd_gabungan = a.kd_gabungan 
              
                
        WHERE a.id_buku in('1','3','4') and a.id_akun = '$id_akun' AND MONTH(a.tgl) = '$bulan' AND YEAR(a.tgl) = '$tahun'
        order by a.tgl ASC
        ");

        $data = [
            'id_akun' => $id_akun,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jurnal' => $jurnal,
            'penjualan' => 'Y'
        ];
        return view('accounting.homepage.detail', $data);
    }

    // public function cashFlow(Request $r)
    // {
    //     $periode = DB::select("SELECT tgl FROM tb_jurnal GROUP BY MONTH(tgl),YEAR(tgl) ORDER BY tgl ASC");
    //     $id_lokasi = Session::get('id_lokasi');
    //     $akun_pendapatan = DB::select("SELECT a.*
    //     FROM tb_akun AS a
    //     LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
    //     WHERE a.id_lokasi = '$id_lokasi' AND b.id_sub_menu_akun = '26'");

    //     // $kategori = [4,7];

    //     $akun_pengeluaran = DB::select("SELECT a.*
    //     FROM tb_akun AS a
    //     WHERE a.id_lokasi = '$id_lokasi' AND a.buku_bank = 'Y'");

    //     $liabilities = DB::select("SELECT a.*
    //     FROM tb_akun AS a
    //     LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
    //     WHERE a.id_lokasi = '$id_lokasi' AND b.id_sub_menu_akun = '28'");

    //     $tahun = DB::select("SELECT tgl FROM tb_jurnal GROUP BY YEAR(tgl)");
    //     $data = [
    //         'title' => 'Cash Flow',
    //         'tahun' => $tahun,
    //         'liabilities' => $liabilities,
    //         'akun_pengeluaran' => $akun_pengeluaran,
    //         'akun_pendapatan' => $akun_pendapatan,
    //         'periode' => $periode,
    //     ];
    //     return view('accounting.homepage.cashFlow', $data);
    // }
    public function cashFlow(Request $r)
    {
        if (empty($r->bulan1)) {
            $tgl_hari_ini = date('m');
            $tahun_hari_ini = date('Y');
            $tgl_ini = date('Y-m-d');
            $tgl_bulan_lalu = date('Y-m-d', strtotime('-1 month', strtotime($tgl_ini)));
            $tgl_akhir = date('Y-m-d', strtotime('-1 month', strtotime($tgl_ini)));
            $tgl_awal = date('Y-m-01', strtotime('-1 month', strtotime($tgl_ini)));
            $bulan_lalu = date('m', strtotime('-1 month', strtotime($tgl_ini)));
            $tahun_lalu = date('Y', strtotime('-1 month', strtotime($tgl_ini)));
        } else {
            $bulan1 = $r->bulan1;
            $tahun1 = $r->tahun1;
            $bulan2 = $r->bulan2;
            $tahun2 = $r->tahun2;
            $h1 = date('t');
            $tgl_h = date('Y-m-t');
            $tgl_k = $tahun2 . '-' . $bulan2 . '-' . $h1;

            if ($tgl_h == $tgl_k) {
                $tgl_hari_ini = date('m');
                $tahun_hari_ini = date('Y');
                $tgl_ini = date('Y-m-d');
                $tgl_akhir = date('Y-m-d', strtotime('-1 month', strtotime($tgl_h)));
            } else {
                $tgl_hari_ini = date('m');
                $tahun_hari_ini = date('Y');
                $tgl_ini = date('Y-m-d');
                $tgl_akhir = $tahun2 . '-' . $bulan2 . '-' . $h1;
            }
            $bulan_lalu = date('m', strtotime('-1 month', strtotime($tgl_ini)));
            $tahun_lalu = date('Y', strtotime('-1 month', strtotime($tgl_ini)));
            $tgl_bulan_lalu = date('Y-m-d', strtotime('-1 month', strtotime($tgl_ini)));
            $tgl_awal =  $tahun1 . '-' . $bulan1 . '-' . 01;
        }

        $periode2 =  DB::select("SELECT a.tgl
        FROM tb_jurnal AS a
        WHERE MONTH(a.tgl) = '$tgl_hari_ini' and YEAR(a.tgl) = '$tahun_hari_ini'
        GROUP BY MONTH(a.tgl) , YEAR(a.tgl)
        ORDER BY a.tgl ASC");

        $periode3 =  DB::select("SELECT a.tgl
        FROM tb_jurnal AS a
        WHERE MONTH(a.tgl) = '$bulan_lalu' and YEAR(a.tgl) = '$tahun_lalu'
        GROUP BY MONTH(a.tgl) , YEAR(a.tgl)
        ORDER BY a.tgl ASC");


        $periode = DB::select("SELECT a.tgl
        FROM tb_jurnal AS a
        WHERE a.tgl BETWEEN '$tgl_awal' and '$tgl_akhir'
        GROUP BY MONTH(a.tgl) , YEAR(a.tgl)
        ORDER BY a.tgl ASC");


        $akun_pendapatan = DB::select("SELECT a.*
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '26'");

        // $kategori = [4,7];

        $akun_pengeluaran = DB::select("SELECT a.*
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '27'");
        $akun_pengeluaran_saldo = DB::select("SELECT a.*
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '30'");

        $liabilities = DB::select("SELECT a.*
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '28'");

        $data = [
            'title' => 'Cash Flow',
            'tahun' => DB::select("SELECT tgl FROM tb_jurnal GROUP BY YEAR(tgl)"),
            'periode' => $periode,
            'periode2' => $periode2,
            'periode3' => $periode3,
            'akun_pendapatan' => $akun_pendapatan,
            'akun_pengeluaran' => $akun_pengeluaran,
            'akun_pengeluaran_saldo' => $akun_pengeluaran_saldo,
            'liabilities' => $liabilities,
            'akun_all' => Akun::all(),
            's_tahun' => DB::select("SELECT tgl FROM tb_jurnal GROUP BY YEAR(tgl)"),
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'bulan_lalu' => $bulan_lalu,
            's_bulan' => DB::table('bulan')->get(),


        ];
        return view('accounting.homepage.cashFlow',$data);
    }

    public function get_detail(Request $r)
    {
        $id_akun = $r->id_akun;
        $bulan = $r->bulan;
        $tahun = $r->tahun;

        $bulan_sebelum = date('Y-m-d', strtotime('last day of -1 month', strtotime($tahun . '-' . $bulan . '-' . '01')));

        $jurnal = DB::select("SELECT a.id_buku, a.tgl,a.no_nota, b.nm_akun, a.debit, a.kredit, a.ket, c.nm_post
        FROM tb_jurnal AS a
        LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
        left join tb_post_center as c on c.id_post = a.id_post
        
        WHERE  a.id_akun = '$id_akun' AND MONTH(a.tgl) = '$bulan' AND YEAR(a.tgl) = '$tahun'
        order by a.tgl ASC
        ");

        $neraca_saldo = DB::select("SELECT * FROM tb_neraca_saldo as a 
        left join tb_akun as b on b.id_akun = a.id_akun 
        where a.id_akun = '$id_akun' AND MONTH(a.tgl) = '$bulan' AND YEAR(a.tgl) = '$tahun'");


        $saldo_penutup = DB::select("SELECT * FROM tb_saldo_penutup as a 
        left join tb_akun as b on b.id_akun = a.id_akun 
        where a.id_akun = '$id_akun' AND a.tgl ='$bulan_sebelum' order by a.tgl DESC limit 1");

        $data = [
            'id_akun' => $id_akun,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jurnal' => $jurnal,
            'neraca' => $neraca_saldo,
            'saldo' => $saldo_penutup,
            'bulan_sebelum' => $bulan_sebelum
        ];
        return view('accounting.homepage.detail1',$data);
    }
    public function get_detail2(Request $r)
    {
        $id_akun = $r->id_akun;
        $bulan = $r->bulan;
        $tahun = $r->tahun;
       
        $jurnal = DB::select("SELECT a.id_buku, a.tgl,a.no_nota, b.nm_akun, a.debit, a.kredit, a.ket, c.nm_post, d.nm_akun AS akun2
        FROM tb_jurnal AS a
        LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
        left join tb_post_center as c on c.id_post = a.id_post
        
        LEFT JOIN (SELECT b.kd_gabungan, b.id_akun, c.nm_akun
        FROM tb_jurnal AS b
        LEFT JOIN tb_akun AS c ON c.id_akun = b.id_akun 
        WHERE b.id_akun != '$id_akun'
        group by b.kd_gabungan
        ) AS d ON d.kd_gabungan = a.kd_gabungan       
                
        WHERE a.id_buku in('1','3','4') and a.id_akun = '$id_akun' AND MONTH(a.tgl) = '$bulan' AND YEAR(a.tgl) = '$tahun'
        order by a.tgl ASC
        ");

        $akun = Akun::where('id_akun', $id_akun)->first(); 


        $data = [
            'id_akun' => $id_akun,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jurnal' => $jurnal,
            'akun' => $akun,
        ];
        return view('accounting.homepage.detail2',$data);
    }

    public function pl(Request $r)
    {
        $periode = DB::select("SELECT tgl FROM tb_jurnal GROUP BY MONTH(tgl) AND YEAR(tgl) ORDER BY tgl ASC");
        $id_lokasi = Session::get('id_lokasi');
        $akun_pendapatan = DB::select("SELECT a.* FROM tb_akun as a LEFT JOIN tb_permission_akun as b ON a.id_akun 
        = b.id_akun WHERE a.id_lokasi = '$id_lokasi' AND b.id_sub_menu_akun = '13'");

        $akun_pengeluaran = DB::select("SELECT a.* FROM tb_akun as a LEFT JOIN tb_permission_akun as b ON a.id_akun 
        = b.id_akun WHERE a.id_lokasi = '$id_lokasi' AND b.id_sub_menu_akun = '14'");

        $tahun = DB::select("SELECT tgl FROM tb_jurnal GROUP BY YEAR(tgl)");

        $data = [
            'title' => 'Profit & Loss',
            'tahun' => $tahun,
            'akun_pengeluaran' => $akun_pengeluaran,
            'akun_pendapatan' => $akun_pendapatan,
            'periode' => $periode,
        ];
        return view('accounting.homepage.pl', $data);
    }

    public function neracaSaldo(Request $request)
    {
        $id_user = Auth::user()->id;
        $id_menu = DB::table('tb_permission')->select('id_menu')->where('id_user', $id_user)
            ->where('id_menu', 31)->first();
        if (empty($id_menu)) {
            return back();
        } else {
            if (Auth::user()->jenis == 'adm') {
                // dd($request->acc);
                $data = [
                    'title' => 'Neraca Saldo',
                    'logout' => $request->session()->get('logout'),
                    'neracaSaldo' => DB::select("SELECT a.id_akun, b.tgl, a.nm_akun , b.debit_saldo, b.kredit_saldo
                    FROM tb_akun AS a
                    LEFT JOIN tb_neraca_saldo AS b ON b.id_akun = a.id_akun
                    WHERE a.id_kategori not IN ('3','4') AND a.id_lokasi = '$request->acc'"),
                    'lokasi' => DB::table('tb_lokasi')->get(),
                ];
                return view('accounting.neracaSaldo', $data);
            } else {
                return back();
            }
        }
    }

    public function addNeracaSaldo(Request $request)
    {
        $id_lokasi = $request->id_lokasi;
        $tgl = $request->tgl;
        $id_akun = $request->id_akun;
        $debit_saldo = $request->debit_saldo;
        $kredit_saldo = $request->kredit_saldo;

        for ($i = 0; $i < count($id_akun); $i++) {
            $neracaSaldo = DB::table('tb_neraca_saldo')->where('id_akun', $id_akun[$i])->first();
            // dd($neracaSaldo);
            if ($tgl == "") {
            } else {
                if (empty($neracaSaldo)) {
                    $data = [
                        'tgl' => $tgl,
                        'id_lokasi' => $id_lokasi,
                        'id_akun' => $id_akun[$i],
                        'debit_saldo' => $debit_saldo[$i],
                        'kredit_saldo' => $kredit_saldo[$i],
                    ];
                    DB::table('tb_neraca_saldo')->insert($data);
                } else {
                    $data = [
                        'tgl' => $tgl,
                        'id_lokasi' => $id_lokasi,
                        'id_akun' => $id_akun[$i],
                        'debit_saldo' => $debit_saldo[$i],
                        'kredit_saldo' => $kredit_saldo[$i],
                    ];
                    DB::table('tb_neraca_saldo')->where([['id_akun', $id_akun[$i]], ['id_lokasi', $id_lokasi]])->update($data);

                    // $dataNeraca = [

                    // ];
                    // DB::table('tb_neraca_saldo_penutup')->insert($dataNeraca);
                }
            }
        }
        return redirect()->route('neracaSaldo', ['acc' => $id_lokasi])->with('sukses', 'Data berhasil Ditambah');
    }

    public function bukuBesar(Request $request)
    {
        $id_user = Auth::user()->id;
        $id_menu = DB::table('tb_permission')->select('id_menu')->where('id_user', $id_user)
            ->where('id_menu', 32)->first();
        if (empty($id_menu)) {
            return back();
        } else {
            if (Auth::user()->jenis == 'adm') {
                $dari = $request->dari;
                $sampai = $request->sampai;

                if ($dari == '') {
                    $dari = date('Y-m-01');
                    $sampai = date('Y-m-t');
                } else {
                    $dari = $dari;
                    $sampai = $sampai;
                }
                $buku1 =  DB::select("SELECT a.no_akun,a.id_akun, a.nm_akun, b.tgl, jurnal.debit, jurnal.kredit , c.debit_saldo,c.kredit_saldo FROM tb_akun as a
                LEFT JOIN tb_neraca_saldo_penutup as b on a.id_akun = b.id_akun
                LEFT JOIN tb_neraca_saldo as c on b.id_akun = c.id_akun
                LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit, SUM(tb_jurnal.kredit) as kredit FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun AND tb_jurnal.tgl between '$dari' AND '$sampai' AND tb_jurnal.id_lokasi = '$request->acc' AND tb_jurnal.id_buku != 6 GROUP BY tb_jurnal.id_akun) jurnal ON a.id_akun = jurnal.id_akun
                WHERE c.tgl between '$dari' AND '$sampai' AND a.id_lokasi = '$request->acc' and a.id_kategori NOT IN(5)
                order by a.id_akun ASC");

                $buku = DB::select("SELECT tb_akun.id_akun, tb_akun.no_akun, tb_akun.nm_akun, jurnal.debit, jurnal.kredit, neraca_saldo.debit_saldo, neraca_saldo.kredit_saldo
                    FROM tb_akun
                     LEFT JOIN (SELECT tb_jurnal.id_akun,tb_jurnal.tgl, SUM(tb_jurnal.debit) as debit, SUM(tb_jurnal.kredit) as kredit FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun AND tb_jurnal.tgl between '$dari' AND '$sampai' AND tb_jurnal.id_lokasi = '$request->acc' AND tb_jurnal.id_buku != 6 GROUP BY tb_jurnal.id_akun) jurnal ON tb_akun.id_akun = jurnal.id_akun
                    
                     LEFT JOIN (SELECT tb_neraca_saldo_penutup.id_akun,sum(tb_neraca_saldo_penutup.debit) as debit_saldo, sum(tb_neraca_saldo_penutup.kredit) as kredit_saldo FROM tb_neraca_saldo_penutup WHERE tb_neraca_saldo_penutup.tgl between '$dari' AND  '$sampai' and tb_neraca_saldo_penutup.penutup = 'T'  GROUP BY tb_neraca_saldo_penutup.id_akun) neraca_saldo ON tb_akun.id_akun = neraca_saldo.id_akun
                     ORDER BY tb_akun.no_akun ASC");

                $tahun = DB::select("SELECT tgl FROM tb_jurnal GROUP BY YEAR('tgl')");
                $data = [
                    'title' => 'Buku Besar',
                    'logout' => $request->session()->get('logout'),
                    'buku' => $buku,
                    'tgl1' => $dari,
                    'tgl2' => $sampai,
                    'tahun' => $tahun
                ];
                return view('accounting.bukuBesar', $data);
            } else {
                return back();
            }
        }
    }

    public function detailBukuBesar(Request $request)
    {
        $id_lokasi = $request->acc;
        $id_akun = $request->id;
        $dari = $request->dari;
        $sampai = $request->sampai;


        $neracaSaldo = DB::selectOne("SELECT *
        FROM tb_neraca_saldo_penutup AS a
        WHERE a.id_akun = '$id_akun' AND a.tgl between '$dari' and '$sampai' and a.penutup = 'T'");

        $buku = DB::select("SELECT * FROM tb_jurnal as a left join tb_post_center as c on a.id_post = c.id_post
        LEFT JOIN(SELECT tb_jurnal.id_akun, GROUP_CONCAT(DISTINCT tb_jurnal.ket SEPARATOR ', ') as ket2, 
        GROUP_CONCAT(DISTINCT b.nm_akun SEPARATOR ', ') as ket3, kd_gabungan 
        FROM tb_jurnal 
        LEFT JOIN tb_akun AS b ON b.id_akun = tb_jurnal.id_akun
        WHERE debit > 0 GROUP BY kd_gabungan) jurnal2 ON a.kd_gabungan = jurnal2.kd_gabungan and jurnal2.id_akun != a.id_akun
        where a.id_akun = '$id_akun' and a.tgl between '$dari' and '$sampai'
        order by a.tgl DESC");

        $data = [
            'title' => 'Detail Buku Besar',
            'buku' => $buku,
            'akun' => DB::table('tb_akun')->where('id_akun', $id_akun)->first(),
            'tgl1' => $dari,
            'tgl2' => $sampai,
            'id_akun' => $id_akun,
            'neraca' => $neracaSaldo
        ];

        return view('accounting.detailBukuBesar', $data);
    }

    public function exportDetailBukuBesar(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        $id_akun = $r->id_akun;
        if (empty($r->tgl1)) {
            $tgl1 = date('Y-m-01');
            $tgl2 = date('Y-m-d');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }


        $neracaSaldo = DB::selectOne("SELECT *
        FROM tb_neraca_saldo_penutup AS a
        WHERE a.id_akun = '$id_akun' AND a.tgl between '$tgl1' and '$tgl2' and a.penutup = 'T'");

        $buku = DB::select("SELECT * FROM tb_jurnal as a left join tb_post_center as c on a.id_post = c.id_post
        LEFT JOIN(SELECT tb_jurnal.id_akun, GROUP_CONCAT(DISTINCT tb_jurnal.ket SEPARATOR ', ') as ket2, 
        GROUP_CONCAT(DISTINCT b.nm_akun SEPARATOR ', ') as ket3, kd_gabungan 
        FROM tb_jurnal 
        LEFT JOIN tb_akun AS b ON b.id_akun = tb_jurnal.id_akun
        WHERE debit > 0 GROUP BY kd_gabungan) jurnal2 ON a.kd_gabungan = jurnal2.kd_gabungan and jurnal2.id_akun != a.id_akun
        where a.id_akun = '$id_akun' and a.tgl between '$tgl1' and '$tgl2'
        order by a.tgl ASC");

        $data = [
            'title' => 'Detail Buku Besar',
            'buku' => $buku,
            'akun' => DB::table('tb_akun')->where('id_akun', $id_akun)->first(),
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'id_akun' => $id_akun,
            'id_lokasi' => $id_lokasi,
            'neraca' => $neracaSaldo
        ];

        return view('accounting.exportDetailBukuBesar', $data);
    }

    public function printBukuBesar(Request $request)
    {
        $id_lokasi = $request->id_lokasi;
        if (empty($request->dari)) {
            $tgl1 = date('Y-m-01');
            $tgl2 = date('Y-m-d');
        } else {
            $tgl1 = $request->dari;
            $tgl2 = $request->sampai;
        }

        $buku = DB::select("SELECT tb_akun.id_akun, tb_akun.no_akun, tb_akun.nm_akun, jurnal.debit, jurnal.kredit, neraca_saldo.debit_saldo, neraca_saldo.kredit_saldo
                    FROM tb_akun
                     LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit, SUM(tb_jurnal.kredit) as kredit FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun AND tb_jurnal.tgl between '$tgl1' AND '$tgl2' AND tb_jurnal.id_lokasi = '$request->acc' AND tb_jurnal.id_buku != 6 GROUP BY tb_jurnal.id_akun) jurnal ON tb_akun.id_akun = jurnal.id_akun
                     
                     LEFT JOIN (SELECT tb_neraca_saldo.id_akun,sum(tb_neraca_saldo.debit_saldo) as debit_saldo, sum(tb_neraca_saldo.kredit_saldo) as kredit_saldo FROM tb_neraca_saldo WHERE tb_neraca_saldo.tgl between '$tgl1' AND  '$tgl2' AND tb_neraca_saldo.id_lokasi = '$request->acc' GROUP BY tb_neraca_saldo.id_akun) neraca_saldo ON tb_akun.id_akun = neraca_saldo.id_akun
            
                     
                    
                     ORDER BY tb_akun.no_akun ASC");
        $tahun = DB::select("SELECT tgl FROM tb_jurnal GROUP BY YEAR('tgl')");
        $bulan = DB::select("SELECT tgl FROM tb_jurnal GROUP BY MONTH('tgl')");
        $data = [
            'title' => 'Rekapitulasi Jurnal',
            'buku' => $buku,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'tahun' => $tahun,
            'bulan' => $bulan,
        ];

        return view('accounting.printBukuBesar', $data);
    }

    public function exportBukuBesar(Request $request)
    {
        $id_lokasi = $request->id_lokasi;
        if (empty($request->dari)) {
            $tgl1 = date('Y-m-01');
            $tgl2 = date('Y-m-d');
        } else {
            $tgl1 = $request->dari;
            $tgl2 = $request->sampai;
        }

        $buku = DB::select("SELECT tb_akun.id_akun, tb_akun.no_akun, tb_akun.nm_akun, jurnal.debit, jurnal.kredit, neraca_saldo.debit_saldo, neraca_saldo.kredit_saldo
                    FROM tb_akun
                     LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit, SUM(tb_jurnal.kredit) as kredit FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun AND tb_jurnal.tgl between '$tgl1' AND '$tgl2' AND tb_jurnal.id_lokasi = '$request->acc' AND tb_jurnal.id_buku != 6 GROUP BY tb_jurnal.id_akun) jurnal ON tb_akun.id_akun = jurnal.id_akun
                     
                     LEFT JOIN (SELECT tb_neraca_saldo.id_akun,sum(tb_neraca_saldo.debit_saldo) as debit_saldo, sum(tb_neraca_saldo.kredit_saldo) as kredit_saldo FROM tb_neraca_saldo WHERE tb_neraca_saldo.tgl between '$tgl1' AND  '$tgl2' AND tb_neraca_saldo.id_lokasi = '$request->acc' GROUP BY tb_neraca_saldo.id_akun) neraca_saldo ON tb_akun.id_akun = neraca_saldo.id_akun
            
                     
                    
                     ORDER BY tb_akun.no_akun ASC");
        $tahun = DB::select("SELECT tgl FROM tb_jurnal GROUP BY YEAR('tgl')");
        $bulan = DB::select("SELECT tgl FROM tb_jurnal GROUP BY MONTH('tgl')");

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->setActiveSheetIndex(0);
        $sheet->setTitle('Jurnal Pengeluaran');
        $sheet->setCellValue('A1', '#');
        $sheet->setCellValue('B1', 'Tanggal');
        $sheet->setCellValue('C1', 'D');
        $sheet->setCellValue('D1', 'M');
        $sheet->setCellValue('E1', 'Y');
        $sheet->setCellValue('F1', 'No Invoice');
        $sheet->setCellValue('G1', 'Keterangan');
        $sheet->setCellValue('H1', 'No Akun');
        $sheet->setCellValue('I1', 'Nama Akun');
        $sheet->setCellValue('J1', 'Debit');
        $sheet->setCellValue('K1', 'Kredit');


        $kolom = 2;
        $no = 1;
        $total_debit = 0;
        $total_kredit = 0;
        $total_saldo = 0;
        $laba_ditahan = 0;

        foreach ($buku as $b) {
            $saldo = $b->debit + $b->debit_saldo  - $b->kredit - $b->kredit_saldo;
            $debit = $b->debit + $b->debit_saldo;
            $kredit = $b->kredit + $b->kredit_saldo;
            $total_debit += $debit;
            $total_kredit += $kredit;
            $total_saldo += $saldo;
            if ($debit == 0 and $kredit == 0) {
                continue;
            }
            $spreadsheet->setActiveSheetIndex(0);
            $sheet->setCellValue('A' . $kolom, $b->no_akun);
            $sheet->setCellValue('B' . $kolom, $b->nm_akun);
            $sheet->setCellValue('C' . $kolom, $debit);
            $sheet->setCellValue('D' . $kolom, $kredit);
            $sheet->setCellValue('E' . $kolom, $saldo);

            $kolom++;
        }
        $sheet->setCellValue('B' . $kolom, 'TOTAL');
        $sheet->setCellValue('C' . $kolom, $total_debit);
        $sheet->setCellValue('D' . $kolom, $total_kredit);
        $sheet->setCellValue('E' . $kolom, $total_saldo);

        $style = array(
            'font' => array(
                'size' => 9
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
        );

        $batas = $kolom - 1;
        $spreadsheet->getActiveSheet()->getStyle('A1:E' . $batas)->applyFromArray($style);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Export Buku Besar.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function kelPeralatan(Request $r)
    {
        $data = [
            'title' => 'Kelompok Peralatan',
            'query' => DB::table('tb_kelompok_peralatan')->get()
        ];

        return view('accounting.more.kelompokPeralatan', $data);
    }

    public function editKelPeralatan(Request $r)
    {
        $data = [
            'nm_kelompok' => $r->nm_kelompok,
            'umur' => $r->umur,
            'satuan' => $r->satuan,
            'barang_kelompok' => $r->barang,
        ];

        DB::table('tb_kelompok_peralatan')->where('id_kelompok', $r->id_kelompok)->update($data);

        return redirect()->route('kelPeralatan', ['acc' => $r->id_lokasi])->with('sukses', 'Berhasil edit kelompok peralatan');
    }

    public function jPenutup(Request $r)
    {
        if (empty($r->tgl1)) {
            $tgl1 = date('Y-m-01');
            $tgl2 = date('Y-m-t');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }
        $id_lokasi = Session::get('id_lokasi');
        $data = [
            'title' => 'Jurnal Penutup',
            'jurnal' => DB::select("SELECT a.* ,b.no_akun, b.nm_akun, c.nm_post, d.n, c.id_post
            FROM tb_jurnal as a 
            left join tb_akun as b on b.id_akun = a.id_akun 
            left join tb_post_center AS c ON c.id_post = a.id_post
            left join tb_satuan AS d ON d.id = a.id_satuan
            WHERE a.id_buku = '5' and a.tgl between '$tgl1' and '$tgl2' AND a.id_lokasi = '$id_lokasi'  order by  a.tgl DESC , a.id_jurnal DESC"),
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
        ];
        return view('accounting.akunting2.jPenutup', $data);
    }

    public function printJPenutup(Request $r)
    {
        if (empty($r->tgl1)) {
            $tgl1 = date('Y-m-01');
            $tgl2 = date('Y-m-t');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }

        $id_lokasi = Session::get('id_lokasi');
        $month = date('m', strtotime($tgl1));
        $year = date('Y', strtotime($tgl1));


        $penutup_pendapatan = DB::select("SELECT a.tgl, b.no_akun, b.nm_akun, sum(a.debit) AS debit, sum(a.kredit) AS kredit 
        FROM tb_jurnal AS a
        LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
        WHERE a.id_buku = '5' AND b.penutup_pendapatan = 'Y' AND a.id_lokasi = '$id_lokasi' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'
        GROUP BY a.id_akun");

        $penutup_biaya = DB::select("SELECT a.tgl, b.no_akun, b.nm_akun, sum(a.debit) AS debit, sum(a.kredit) AS kredit 
        FROM tb_jurnal AS a
        LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
        WHERE a.id_buku = '5' AND b.penutup_biaya = 'Y' AND a.id_lokasi = '$id_lokasi' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'
        GROUP BY a.id_akun");

        $modal = DB::selectOne("SELECT b.no_akun, a.tgl, b.nm_akun, sum(a.debit) AS debit, sum(a.kredit) AS kredit 
        FROM tb_jurnal AS a
        LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
        WHERE a.id_akun = '56' AND a.id_lokasi = '$id_lokasi' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'
        GROUP BY a.id_akun");

        $prive = DB::selectOne("SELECT b.no_akun, a.tgl, b.nm_akun, sum(a.debit) AS debit, sum(a.kredit) AS kredit 
        FROM tb_jurnal AS a
        LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
        WHERE a.id_akun = '57' AND a.id_lokasi = '$id_lokasi' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'
        GROUP BY a.id_akun");

        $data = [
            'title' => 'Laporan Jurnal Penutup',
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'penutup_pendapatan' => $penutup_pendapatan,
            'penutup_biaya' => $penutup_biaya,
            'modal' => $modal,
            'prive' => $prive,
        ];

        return view('accounting.akunting2.printJPenutup', ['acc' => $id_lokasi], $data);
    }

    public function get_akun_penutup(Request $r)
    {
        $biy = DB::selectOne("SELECT MONTH(MIN(a.tgl)) AS bulan , YEAR(MIN(a.tgl)) AS tahun,  min(a.tgl) AS tgl
        FROM tb_jurnal AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '16' AND a.penutup = 'T'
        GROUP BY b.id_sub_menu_akun");

        $id_lokasi = Session::get('id_lokasi');
        $id_akun_lokasi = $id_lokasi == 1 ? 147 : 168;

        $month = empty($biy) ? date('m') : $biy->bulan;
        $year = empty($biy) ? date('Y') : $biy->tahun;

        $penutup = DB::select("SELECT a.id_akun, b.nm_akun , last_day(a.tgl) as tgl, SUM(a.kredit) AS kredit, SUM(a.debit) AS debit
            FROM tb_jurnal AS a
            LEFT JOIN tb_akun AS b ON a.id_akun = b.id_akun
            LEFT JOIN tb_permission_akun AS c ON c.id_akun = a.id_akun
            WHERE c.id_sub_menu_akun = '15' and MONTH(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND a.penutup = 'T' AND a.id_lokasi = '$id_lokasi'
            GROUP BY b.id_akun");

        $penutup_biaya = DB::select("SELECT a.id_akun, b.nm_akun , last_day(a.tgl) as tgl, SUM(a.kredit) AS kredit, SUM(a.debit) AS debit
            FROM tb_jurnal AS a
            LEFT JOIN tb_akun AS b ON a.id_akun = b.id_akun
            LEFT JOIN tb_permission_akun AS c ON c.id_akun = a.id_akun
            WHERE c.id_sub_menu_akun = '16' and MONTH(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND a.penutup = 'T' AND a.id_lokasi = '$id_lokasi'
            GROUP BY b.id_akun");

        $prev = DB::selectOne("SELECT MAX(a.tgl) AS tgl 
            FROM tb_jurnal AS a
            WHERE a.id_akun = '$id_akun_lokasi'");

        $month_modal = date('m', strtotime($prev->tgl));
        $year_modal = date('Y', strtotime($prev->tgl));

        $modal = DB::selectOne("SELECT a.id_akun, b.nm_akun , SUM(a.kredit) AS kredit, SUM(a.debit) AS debit, last_day(a.tgl), a.tgl
            FROM tb_jurnal AS a
            LEFT JOIN tb_akun AS b ON a.id_akun = b.id_akun
            WHERE a.id_akun = '$id_akun_lokasi' and MONTH(a.tgl) = '$month_modal' and YEAR(a.tgl) = '$year_modal'
            GROUP BY b.id_akun");


        $aset = DB::select("SELECT tb_akun.id_akun, tb_akun.no_akun, tb_akun.nm_akun, jurnal.debit, jurnal.kredit, neraca_saldo.debit_saldo, neraca_saldo.kredit_saldo
        FROM tb_akun
         LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit, SUM(tb_jurnal.kredit) as kredit FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun AND MONTH(tb_jurnal.tgl) = '$month' and YEAR(tb_jurnal.tgl) = '$year' AND tb_jurnal.id_lokasi = '$id_lokasi' AND tb_jurnal.id_buku != 6 GROUP BY tb_jurnal.id_akun) jurnal ON tb_akun.id_akun = jurnal.id_akun
         
         LEFT JOIN (SELECT tb_neraca_saldo.id_akun,sum(tb_neraca_saldo.debit_saldo) as debit_saldo, sum(tb_neraca_saldo.kredit_saldo) as kredit_saldo FROM tb_neraca_saldo WHERE MONTH(tb_neraca_saldo.tgl) = '$month' and YEAR(tb_neraca_saldo.tgl) = '$year' AND tb_neraca_saldo.id_lokasi = '$id_lokasi' GROUP BY tb_neraca_saldo.id_akun) neraca_saldo ON tb_akun.id_akun = neraca_saldo.id_akun
         where tb_akun.id_lokasi = '$id_lokasi'
         ORDER BY tb_akun.no_akun ASC");

        $id_mp = $id_lokasi == 1 ? '147' : '168';
        $neraca = DB::table('tb_akun')->where('id_akun', $id_mp)->first();
        $data = [
            'penutup' => $penutup,
            'penutup_biaya' => $penutup_biaya,
            'modal' => $modal,
            'neraca' => $neraca,
            'aset' => $aset,
            'id_lokasi' => $id_lokasi,
        ];
        return view('accounting.akunting2.penutupAkun', $data);
    }

    public function addJPenutup(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        $tgl = $r->tgl;
        $id_akun = $r->id_akun;
        $metode = $r->metode;
        $kredit = $r->kredit;
        $aktiva = $r->aktiva;
        $passiva = $r->passiva;
        $admin = Auth::user()->nama;
        $totalPenjualan = 0;

        if ($tgl[0] == null) {
        } else {
            for ($x = 0; $x < count($tgl); $x++) {
                $month = date('m', strtotime($tgl[$x]));
                $year = date('Y', strtotime($tgl[$x]));

                if ($kredit[$x] == 0 || empty($kredit[$x])) {
                    # code...
                } else {
                    $get_kd_akun = Akun::where('id_akun', $id_akun[$x])->get()[0];
                    $kode_akun = Jurnal::where('id_akun', $id_akun[$x])->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();
                    if ($kode_akun == 0) {
                        $kode_akun = 1;
                    } else {
                        $kode_akun += 1;
                    }
                    $get_akun = Akun::where('id_akun', $id_akun[$x])->get()[0];
                    $get_kd_metode = Akun::where('id_akun', $metode[$x])->get()[0];
                    $kode_metode = Jurnal::where('id_akun', $metode[$x])->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();
                    if ($kode_metode == 0) {
                        $kode_metode = 1;
                    } else {
                        $kode_metode += 1;
                    }
                    $get_metode = Akun::where('id_akun', $metode[$x])->get()[0];

                    $kd_gabungan = 'RST' . date($tgl[$x]) . strtoupper(Str::random(3));
                    $data_metode = [
                        'id_buku' => 5,
                        'id_akun' => $metode[$x],
                        'kd_gabungan' => $kd_gabungan,
                        'no_nota' => $get_kd_metode->kd_akun . date('my', strtotime($tgl[$x])) . '-' . $kode_metode,
                        'kredit' => $kredit[$x],
                        'tgl' => $tgl[$x],
                        'tgl_input' => date('Y-m-d H:i:s'),
                        'admin' => $admin,
                        'id_lokasi' => $id_lokasi,
                        'ket' => 'Ikhtisar laba rugi'
                    ];

                    Jurnal::create($data_metode);

                    $data_jurnal = [
                        'id_buku' => 5,
                        'id_akun' => $id_akun[$x],
                        'kd_gabungan' => $kd_gabungan,
                        'no_nota' => $get_kd_akun->kd_akun . date('my', strtotime($tgl[$x])) . '-' . $kode_akun,
                        'debit' => $kredit[$x],
                        'tgl' => $tgl[$x],
                        'tgl_input' => date('Y-m-d H:i:s'),
                        'admin' => $admin,
                        'id_lokasi' => $id_lokasi,
                        'ket' => 'Ikhtisar laba rugi'
                    ];
                    Jurnal::create($data_jurnal);

                    $labaRugi = [
                        'id_akun' => $id_akun[$x],
                        'tgl' => $tgl[$x],
                        'id_lokasi' => $id_lokasi,
                        'debit' => $kredit[$x],
                        'kredit' => $kredit[$x],
                        'no_nota' => $get_kd_akun->kd_akun . date('my', strtotime($tgl[$x])) . '-' . $kode_akun,
                        'ket' => 'Penjualan',
                        'admin' => Auth::user()->nama,
                    ];
                    DB::table('tb_laba_rugi_penutup')->insert($labaRugi);
                }
            }
        }

        $tgl2 = $r->tgl2;
        if (empty($tgl2)) {
        } else {
            $id_akun2 = $r->id_akun2;
            $metode2 = $r->metode2;
            $kredit2 = $r->kredit2;
            $admin2 = Auth::user()->nama;

            for ($x = 0; $x < count($tgl2); $x++) {
                $month2 = date('m', strtotime($tgl2[$x]));
                $year2 = date('Y', strtotime($tgl2[$x]));

                if ($kredit2[$x] == 0 || empty($kredit2[$x])) {
                    # code...
                } else {

                    $get_kd_akun2 = Akun::where('id_akun', $id_akun2[$x])->get()[0];
                    $kode_akun2 = Jurnal::where('id_akun', $id_akun2[$x])->whereMonth('tgl', $month2)->whereYear('tgl', $year2)->count();
                    if ($kode_akun2 == 0) {
                        $kode_akun2 = 1;
                    } else {
                        $kode_akun2 += 1;
                    }

                    $get_kd_metode2 = Akun::where('id_akun', $metode2[$x])->get()[0];
                    $kode_metode2 = Jurnal::where('id_akun', $metode2[$x])->whereMonth('tgl', $month2)->whereYear('tgl', $year2)->count();
                    if ($kode_metode2 == 0) {
                        $kode_metode2 = 1;
                    } else {
                        $kode_metode2 += 1;
                    }


                    $kd_gabungan2 = 'RST' . date($tgl2[$x]) . strtoupper(Str::random(3));

                    $data_metode2 = [
                        'id_buku' => 5,
                        'id_akun' => $metode2[$x],
                        'kd_gabungan' => $kd_gabungan2,
                        'no_nota' => $get_kd_metode2->kd_akun . date('my', strtotime($tgl2[$x])) . '-' . $kode_metode2,
                        'kredit' => $kredit2[$x],
                        'tgl' => $tgl2[$x],
                        'tgl_input' => date('Y-m-d H:i:s'),
                        'admin' => $admin2,
                        'id_lokasi' => $id_lokasi,
                        'ket' => 'Ikhtisar laba rugi '
                    ];
                    Jurnal::create($data_metode2);

                    $data_jurnal2 = [
                        'id_buku' => 5,
                        'id_akun' => $id_akun2[$x],
                        'kd_gabungan' => $kd_gabungan2,
                        'no_nota' => $get_kd_akun2->kd_akun . date('my', strtotime($tgl2[$x])) . '-' . $kode_akun2,
                        'debit' => $kredit2[$x],
                        'tgl' => $tgl2[$x],
                        'tgl_input' => date('Y-m-d H:i:s'),
                        'admin' => $admin2,
                        'id_lokasi' => $id_lokasi,
                        'ket' => 'Ikhtisar laba rugi'
                    ];
                    Jurnal::create($data_jurnal2);

                    $labaRugi2 = [
                        'id_akun' => $id_akun2[$x],
                        'tgl' => $tgl2[$x],
                        'id_lokasi' => $id_lokasi,
                        'debit' => $kredit2[$x],
                        'kredit' => $kredit2[$x],
                        'no_nota' => $get_kd_akun2->kd_akun . date('my', strtotime($tgl2[$x])) . '-' . $kode_akun2,
                        'ket' => 'Biaya',
                        'admin' => Auth::user()->nama,
                    ];
                    DB::table('tb_laba_rugi_penutup')->insert($labaRugi2);
                }
                $akun_pen = $metode2[$x];
                Jurnal::where('id_akun', $akun_pen)->whereMonth('tgl', $month2)->whereYear('tgl', $year2)->update(['penutup' => 'Y']);
            }
        }


        $tgl3 = $r->tgl3;
        if (empty($tgl3)) {
        } else {
            $id_akun3 = $r->id_akun3;
            $metode3 = $r->metode3;
            $kredit3 = $r->kredit3;
            $admin3 = Auth::user()->nama;

            $month3 = date('m', strtotime($tgl3));
            $year3 = date('Y', strtotime($tgl3));

            $get_kd_akun3 = Akun::where('id_akun', $id_akun3)->get()[0];
            $kode_akun3 = Jurnal::where('id_akun', $id_akun3)->whereMonth('tgl', $month3)->whereYear('tgl', $year3)->count();
            if ($kode_akun3 == 0) {
                $kode_akun3 = 1;
            } else {
                $kode_akun3 += 1;
            }


            $get_kd_metode3 = Akun::where('id_akun', $metode3)->get()[0];
            $kode_metode3 = Jurnal::where('id_akun', $metode3)->whereMonth('tgl', $month3)->whereYear('tgl', $year3)->count();


            if ($kode_metode3 == 0) {
                $kode_metode3 = 1;
            } else {
                $kode_metode3 += 1;
            }
            $kd_gabungan3 = 'RST' . date($tgl3) . strtoupper(Str::random(3));

            $data_metode3 = [
                'id_buku' => 5,
                'id_akun' => $metode3,
                'kd_gabungan' => $kd_gabungan3,
                'no_nota' => $get_kd_metode3->kd_akun . date('my', strtotime($tgl3)) . '-' . $kode_metode3,
                'kredit' => $kredit3,
                'tgl' => $tgl3,
                'tgl_input' => date('Y-m-d H:i:s'),
                'admin' => $admin3,
                'id_lokasi' => $id_lokasi,
                'ket' => 'Ikhtisar laba rugi'
            ];
            Jurnal::create($data_metode3);

            $data_jurnal3 = [
                'id_buku' => 5,
                'id_akun' => $id_akun3,
                'kd_gabungan' => $kd_gabungan3,
                'no_nota' => $get_kd_akun3->kd_akun . date('my', strtotime($tgl3)) . '-' . $kode_akun3,
                'debit' => $kredit3,
                'tgl' => $tgl3,
                'tgl_input' => date('Y-m-d H:i:s'),
                'admin' => $admin3,
                'id_lokasi' => $id_lokasi,
                'ket' => 'Ikhtisar laba rugi'
            ];
            Jurnal::create($data_jurnal3);
        }

        $tgl4 = $r->tgl4;
        if (empty($tgl4)) {
        } else {
            $id_akun4 = $r->id_akun4;
            $metode4 = $r->metode4;
            $kredit4 = $r->kredit4;
            $admin4 = Auth::user()->nama;

            $month4 = date('m', strtotime($tgl4));
            $year4 = date('Y', strtotime($tgl4));

            $get_kd_akun4 = Akun::where('id_akun', $id_akun4)->get()[0];
            $kode_akun4 = Jurnal::where('id_akun', $id_akun4)->whereMonth('tgl', $month4)->whereYear('tgl', $year4)->count();
            if ($kode_akun4 == 0) {
                $kode_akun4 = 1;
            } else {
                $kode_akun4 += 1;
            }


            $get_kd_metode4 = Akun::where('id_akun', $metode4)->get()[0];
            $kode_metode4 = Jurnal::where('id_akun', $metode4)->whereMonth('tgl', $month4)->whereYear('tgl', $year4)->count();


            if ($kode_metode4 == 0) {
                $kode_metode4 = 1;
            } else {
                $kode_metode4 += 1;
            }
            $kd_gabungan4 = 'RST' . date($tgl4) . strtoupper(Str::random(3));

            if ($kredit4 == '0' || $kredit4 == '') {
            } else {
                $data_metode4 = [
                    'id_buku' => 5,
                    'id_akun' => $metode4,
                    'kd_gabungan' => $kd_gabungan4,
                    'no_nota' => $get_kd_metode4->kd_akun . date('my', strtotime($tgl4)) . '-' . $kode_metode4,
                    'kredit' => $kredit4,
                    'tgl' => $tgl4,
                    'tgl_input' => date('Y-m-d H:i:s'),
                    'admin' => $admin4,
                    'id_lokasi' => $id_lokasi,
                    'ket' => 'Ikhtisar laba rugi'
                ];
                Jurnal::create($data_metode4);

                $data_jurnal4 = [
                    'id_buku' => 5,
                    'id_akun' => $id_akun4,
                    'kd_gabungan' => $kd_gabungan4,
                    'no_nota' => $get_kd_akun4->kd_akun . date('my', strtotime($tgl4)) . '-' . $kode_akun4,
                    'debit' => $kredit4,
                    'tgl' => $tgl4,
                    'tgl_input' => date('Y-m-d H:i:s'),
                    'admin' => $admin4,
                    'id_lokasi' => $id_lokasi,
                    'ket' => 'Ikhtisar laba rugi'
                ];
                Jurnal::create($data_jurnal4);
            }
        }
        $tgl_awal = date('Y-m-01', strtotime($tgl4));
        $bulan_sebelum = date('Y-m-d', strtotime('last day of -1 month', strtotime($tgl4)));

        $neraca = DB::table('tb_neraca_saldo_penutup')->count();
        if (empty($neraca < 1)) {
            $buku =  DB::select("SELECT tb_akun.id_akun, tb_akun.no_akun, tb_akun.nm_akun, jurnal.debit, jurnal.kredit, tb_neraca_saldo_penutup.debit_saldo, tb_neraca_saldo_penutup.kredit_saldo
        FROM tb_akun
        LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit, SUM(tb_jurnal.kredit) as kredit FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun AND tb_jurnal.tgl between '2022-01-01' AND '$tgl4' AND tb_jurnal.id_buku != 6 GROUP BY tb_jurnal.id_akun) jurnal ON tb_akun.id_akun = jurnal.id_akun
             
         LEFT JOIN (SELECT tb_neraca_saldo_penutup.id_akun,sum(tb_neraca_saldo_penutup.debit) as debit_saldo, sum(tb_neraca_saldo_penutup.kredit) as kredit_saldo FROM tb_neraca_saldo_penutup WHERE tb_neraca_saldo_penutup.tgl between '2020-01-01' AND  '$tgl4' GROUP BY tb_neraca_saldo_penutup.id_akun) tb_neraca_saldo_penutup ON tb_akun.id_akun = tb_neraca_saldo_penutup.id_akun
         ORDER BY tb_akun.no_akun ASC");
        } else {
            $buku =  DB::select("SELECT a.id_akun, a.no_akun, a.nm_akun, b.debit, b.kredit, 
        c.debit_saldo, c.kredit_saldo
        FROM tb_akun AS a

        LEFT JOIN (SELECT b.id_akun, SUM(b.debit) as debit, SUM(b.kredit) as kredit 
        FROM tb_jurnal AS b
        where b.tgl BETWEEN '$tgl_awal' AND '$tgl4' AND b.id_buku != 6 GROUP BY b.id_akun) b ON a.id_akun = b.id_akun            


        LEFT JOIN (SELECT a.id_akun,sum(a.debit) as debit_saldo, sum(a.kredit) as kredit_saldo 
        FROM tb_neraca_saldo_penutup as a WHERE a.tgl = '$bulan_sebelum' GROUP BY a.id_akun) c ON a.id_akun = c.id_akun
        ORDER BY a.no_akun ASC");
        }

        foreach ($buku as $a) {
            $dataAset = [
                'id_akun' => $a->id_akun,
                'tgl' => $tgl4,
                'id_lokasi' => $id_lokasi,
                'debit' => $a->debit + $a->debit_saldo,
                'kredit' => $a->kredit + $a->kredit_saldo,
                'no_nota' => 'NCS-' . $a->nm_akun,
                'ket' => 'Penutup',
                'penutup' => 'Y',
                'admin' => Auth::user()->nama,
            ];
            DB::table('tb_neraca_saldo_penutup')->insert($dataAset);
        }
        $bulan = date('m', strtotime($tgl4));
        $tahun = date('Y', strtotime($tgl4));

        $cash_flow = DB::select("SELECT a.id_akun, a.nm_akun, SUM(if(c.debit IS NULL , '0',c.debit)) AS debit , 
        SUM(if(c.kredit IS NULL , '0' , c.kredit)) AS kredit
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun ='27'
        LEFT JOIN (
        SELECT *
        FROM tb_jurnal AS c 
        WHERE  MONTH(c.tgl) ='$bulan' AND YEAR(c.tgl) = '$tahun'
        ) AS c ON c.id_akun = a.id_akun
        WHERE b.id_sub_menu_akun = '27'
        GROUP BY a.id_akun
        ");
        foreach ($cash_flow as $c) {
            $data_cash = [
                'id_akun' => $c->id_akun,
                'tgl' => $tgl4,
                'saldo_cash' => $c->debit,
                'kd_gabungan' => $kd_gabungan2,
                'penutup' => 'Y',
                'id_lokasi' => $id_lokasi,
                'admin' => Auth::user()->nama,
                'tgl_input' => date('Y-m-d H:i:s')
            ];
            DB::table('tb_cashflow_penutup')->insert($data_cash);

            $data_budget = [
                'id_akun' => $c->id_akun,
                'tgl' => $tgl4,
                'buget' => $c->debit,
                'kd_gabungan' => $kd_gabungan2,
                'id_lokasi' => $id_lokasi
            ];
            DB::table('budgeting')->insert($data_budget);
        }
        
        $cash_flow_saldo = DB::select("SELECT a.id_akun, a.nm_akun, SUM(if(c.debit IS NULL , '0',c.debit)) AS debit , 
        SUM(if(c.kredit IS NULL , '0' , c.kredit)) AS kredit
        FROM tb_akun AS a
        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun ='30'
        
        LEFT JOIN (
        SELECT c.kd_gabungan, c.id_akun, SUM(c.debit) AS debit, SUM(c.kredit) AS kredit
        FROM tb_jurnal AS c 
        
        LEFT JOIN(SELECT a.id_akun,  kd_gabungan 
        FROM tb_jurnal AS a
        LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
        WHERE a.debit = 0
        GROUP BY kd_gabungan) d ON c.kd_gabungan = d.kd_gabungan and d.id_akun != c.id_akun
        
        
        WHERE  MONTH(c.tgl) ='$bulan' AND YEAR(c.tgl) = '$tahun' AND (d.id_akun = '24' OR d.id_akun IS NULL)
        GROUP BY c.id_akun
        ) AS c ON c.id_akun = a.id_akun
        
        WHERE b.id_sub_menu_akun = '30'
        GROUP BY a.id_akun");
        
        foreach ($cash_flow_saldo as $c) {
            $data_cash = [
                'id_akun' => $c->id_akun,
                'tgl' => $tgl4,
                'saldo_cash' => $c->debit,
                'kd_gabungan' => $kd_gabungan2,
                'penutup' => 'Y',
                'id_lokasi' => $id_lokasi,
                'admin' => Auth::user()->nama,
                'tgl_input' => date('Y-m-d H:i:s')
            ];
            DB::table('tb_cashflow_penutup')->insert($data_cash);

            $data_budget = [
                'id_akun' => $c->id_akun,
                'tgl' => $tgl4,
                'buget' => $c->debit,
                'kd_gabungan' => $kd_gabungan2,
                'id_lokasi' => $id_lokasi
            ];
            DB::table('budgeting')->insert($data_budget);


            $liabilities = DB::select("SELECT a.id_akun , sum(a.kredit) as kredit_saldo 
            FROM tb_jurnal as a 
            
            LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '28'
            
            LEFT JOIN(SELECT a.id_akun,  kd_gabungan 
            FROM tb_jurnal AS a
            LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
            WHERE a.debit != 0
            GROUP BY kd_gabungan) d ON a.kd_gabungan = d.kd_gabungan and d.id_akun != a.id_akun
            where month(a.tgl) = '$bulan' and YEAR(a.tgl) = '$tahun'
            AND d.id_akun != '63' AND b.id_sub_menu_akun = '28'
            GROUP BY a.id_akun");

            foreach ($liabilities as $c) {
                $data_cash = [
                    'id_akun' => $c->id_akun,
                    'tgl' => $tgl4,
                    'saldo_cash' => $c->kredit_saldo,
                    'kd_gabungan' => $kd_gabungan2,
                    'penutup' => 'Y',
                    'id_lokasi' => $id_lokasi,
                    'admin' => Auth::user()->nama,
                    'tgl_input' => date('Y-m-d H:i:s')
                ];
                DB::table('tb_cashflow_penutup')->insert($data_cash);
            }

        }


        return redirect()->route('jPenutup', ['acc' => $id_lokasi])->with('sukses', 'Berhasil Input Penutup');
    }

    public function labaRugi(Request $r)
    {
        if (empty($r->month)) {
            $month = date('m');
            $year = date('Y');
        } else {
            $month = $r->month;
            $year = $r->year;
        }

        $id_lokasi = Session::get('id_lokasi');

        $penutup = DB::select("SELECT a.id_akun, b.nm_akun , last_day(a.tgl) as tgl, SUM(a.kredit) AS kredit, SUM(a.debit) AS debit
        FROM tb_laba_rugi_penutup AS a
        LEFT JOIN tb_akun AS b ON a.id_akun = b.id_akun
        LEFT JOIN tb_permission_akun AS c ON c.id_akun = a.id_akun
        WHERE a.id_lokasi = '$id_lokasi' and c.id_sub_menu_akun = '13' and MONTH(a.tgl) = '$month' and YEAR(a.tgl) = '$year'
        GROUP BY b.id_akun");

        $penutup_biaya = DB::select("SELECT a.id_akun, b.nm_akun , last_day(a.tgl) as tgl, SUM(a.kredit) AS kredit, SUM(a.debit) AS debit
        FROM tb_laba_rugi_penutup AS a
        LEFT JOIN tb_akun AS b ON a.id_akun = b.id_akun
        LEFT JOIN tb_permission_akun AS c ON c.id_akun = a.id_akun
        WHERE a.id_lokasi = '$id_lokasi' and c.id_sub_menu_akun = '14' and MONTH(a.tgl) = '$month' and YEAR(a.tgl) = '$year'
        GROUP BY b.id_akun");
        $tahun = DB::select("SELECT tgl FROM tb_jurnal WHERE id_lokasi = '$id_lokasi' GROUP BY YEAR(tgl)");
        $data = [
            'title' => 'Laba Rugi',
            'penutup' => $penutup,
            'penutup_biaya' => $penutup_biaya,
            'month' => $month,
            'year' => $year,
            'tahun' => $tahun,
            'id_lokasi' => $id_lokasi,
        ];
        return view('accounting.akunting2.labaRugi', ['acc' => $id_lokasi], $data);
    }

    public function printLabaRugi(Request $r)
    {
        if (empty($r->month)) {
            $month = date('m');
            $year = date('Y');
        } else {
            $month = $r->month;
            $year = $r->year;
        }

        $id_lokasi = $r->acc;

        $penutup = DB::select("SELECT a.id_akun, b.nm_akun , last_day(a.tgl) as tgl, SUM(a.kredit) AS kredit, SUM(a.debit) AS debit
        FROM tb_jurnal AS a
        LEFT JOIN tb_akun AS b ON a.id_akun = b.id_akun
        LEFT JOIN tb_permission_akun AS c ON c.id_akun = a.id_akun
        WHERE a.id_buku != '5' AND a.id_lokasi = '$id_lokasi' and c.id_sub_menu_akun = '13' and MONTH(a.tgl) = '$month' and YEAR(a.tgl) = '$year'
        GROUP BY b.id_akun");

        $penutup_biaya = DB::select("SELECT a.id_akun, b.nm_akun , last_day(a.tgl) as tgl, SUM(a.kredit) AS kredit, SUM(a.debit) AS debit
        FROM tb_jurnal AS a
        LEFT JOIN tb_akun AS b ON a.id_akun = b.id_akun
        LEFT JOIN tb_permission_akun AS c ON c.id_akun = a.id_akun
        WHERE a.id_buku != '5' AND a.id_lokasi = '$id_lokasi' and c.id_sub_menu_akun = '14' and MONTH(a.tgl) = '$month' and YEAR(a.tgl) = '$year'
        GROUP BY b.id_akun");
        $tahun = DB::select("SELECT tgl FROM tb_jurnal WHERE id_lokasi = '$id_lokasi' GROUP BY YEAR(tgl)");
        $data = [
            'title' => 'Laba Rugi',
            'penutup' => $penutup,
            'penutup_biaya' => $penutup_biaya,
            'month' => $month,
            'year' => $year,
            'tahun' => $tahun,
            'id_lokasi' => $id_lokasi,
        ];
        return view('accounting.akunting2.printLabaRugi', ['acc' => $id_lokasi], $data);
    }

    public function excelLabaRugi(Request $r)
    {
        $buku = DB::select("SELECT tb_akun.id_akun, tb_akun.no_akun, tb_akun.nm_akun, jurnal.debit, jurnal.kredit, neraca_saldo.debit_saldo, neraca_saldo.kredit_saldo
                    FROM tb_akun
                     LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit, SUM(tb_jurnal.kredit) as kredit FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun AND tb_jurnal.tgl between '$tgl1' AND '$tgl2' AND tb_jurnal.id_lokasi = '$request->acc' AND tb_jurnal.id_buku != 6 GROUP BY tb_jurnal.id_akun) jurnal ON tb_akun.id_akun = jurnal.id_akun
                     
                     LEFT JOIN (SELECT tb_neraca_saldo.id_akun,sum(tb_neraca_saldo.debit_saldo) as debit_saldo, sum(tb_neraca_saldo.kredit_saldo) as kredit_saldo FROM tb_neraca_saldo WHERE tb_neraca_saldo.tgl between '$tgl1' AND  '$tgl2' AND tb_neraca_saldo.id_lokasi = '$request->acc' GROUP BY tb_neraca_saldo.id_akun) neraca_saldo ON tb_akun.id_akun = neraca_saldo.id_akun
            
                     
                    
                     ORDER BY tb_akun.no_akun ASC");
        $tahun = DB::select("SELECT tgl FROM tb_jurnal GROUP BY YEAR('tgl')");
        $bulan = DB::select("SELECT tgl FROM tb_jurnal GROUP BY MONTH('tgl')");

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->setActiveSheetIndex(0);
        $sheet->setTitle('Jurnal Pengeluaran');
        $sheet->setCellValue('A1', '#');
        $sheet->setCellValue('B1', 'Tanggal');
        $sheet->setCellValue('C1', 'D');
        $sheet->setCellValue('D1', 'M');
        $sheet->setCellValue('E1', 'Y');
        $sheet->setCellValue('F1', 'No Invoice');
        $sheet->setCellValue('G1', 'Keterangan');
        $sheet->setCellValue('H1', 'No Akun');
        $sheet->setCellValue('I1', 'Nama Akun');
        $sheet->setCellValue('J1', 'Debit');
        $sheet->setCellValue('K1', 'Kredit');


        $kolom = 2;
        $no = 1;
        $total_debit = 0;
        $total_kredit = 0;
        $total_saldo = 0;
        $laba_ditahan = 0;

        foreach ($buku as $b) {
            $saldo = $b->debit + $b->debit_saldo  - $b->kredit - $b->kredit_saldo;
            $debit = $b->debit + $b->debit_saldo;
            $kredit = $b->kredit + $b->kredit_saldo;
            $total_debit += $debit;
            $total_kredit += $kredit;
            $total_saldo += $saldo;
            if ($debit == 0 and $kredit == 0) {
                continue;
            }
            $spreadsheet->setActiveSheetIndex(0);
            $sheet->setCellValue('A' . $kolom, $b->no_akun);
            $sheet->setCellValue('B' . $kolom, $b->nm_akun);
            $sheet->setCellValue('C' . $kolom, $debit);
            $sheet->setCellValue('D' . $kolom, $kredit);
            $sheet->setCellValue('E' . $kolom, $saldo);

            $kolom++;
        }
        $sheet->setCellValue('B' . $kolom, 'TOTAL');
        $sheet->setCellValue('C' . $kolom, $total_debit);
        $sheet->setCellValue('D' . $kolom, $total_kredit);
        $sheet->setCellValue('E' . $kolom, $total_saldo);

        $style = array(
            'font' => array(
                'size' => 9
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
        );

        $batas = $kolom - 1;
        $spreadsheet->getActiveSheet()->getStyle('A1:E' . $batas)->applyFromArray($style);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Export Buku Besar.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function neracaSaldoPenutup(Request $r)
    {

        if (empty($r->month)) {
            $month = date('m');
            $year = date('Y');
        } else {
            $month = $r->month;
            $year = $r->year;
        }
        $id_lokasi = Session::get('id_lokasi');

        $aktiva_lancar = DB::select("SELECT a.no_akun, a.id_akun, a.nm_akun, c.debit, c.kredit
        FROM tb_akun AS a
        LEFT JOIN(
        SELECT b.tgl, b.id_akun , sum(b.debit) AS debit, 
        sum(b.kredit) AS kredit, MONTH(b.tgl) AS bulan, YEAR(b.tgl) AS tahun
        FROM tb_neraca_saldo_penutup AS b 
        WHERE MONTH(b.tgl) = '$month' and Year(b.tgl) = '$year' AND b.id_lokasi = '$id_lokasi' GROUP BY b.id_akun
        ) AS c ON c.id_akun = a.id_akun
        LEFT JOIN tb_permission_akun AS d ON d.id_akun = a.id_akun
        WHERE  d.id_sub_menu_akun = '17'
        ");
        $aktiva_tetap = DB::select("SELECT a.no_akun, a.id_akun, a.nm_akun, c.debit, c.kredit
        FROM tb_akun AS a
        LEFT JOIN(
        SELECT b.tgl, b.id_akun , sum(b.debit) AS debit, 
        sum(b.kredit) AS kredit, MONTH(b.tgl) AS bulan, YEAR(b.tgl) AS tahun
        FROM tb_neraca_saldo_penutup AS b 
        WHERE MONTH(b.tgl) = '$month' and Year(b.tgl) = '$year' AND b.id_lokasi = '$id_lokasi' GROUP BY b.id_akun
        ) AS c ON c.id_akun = a.id_akun
        LEFT JOIN tb_permission_akun AS d ON d.id_akun = a.id_akun
        WHERE a.id_kategori not IN ('3','4') and  d.id_sub_menu_akun = '18'");

        $hutang = DB::select("SELECT a.no_akun, a.id_akun, a.nm_akun, c.debit, c.kredit
        FROM tb_akun AS a
        LEFT JOIN(
        SELECT b.tgl, b.id_akun , sum(b.debit) AS debit, 
        sum(b.kredit) AS kredit, MONTH(b.tgl) AS bulan, YEAR(b.tgl) AS tahun
        FROM tb_neraca_saldo_penutup AS b 
        WHERE MONTH(b.tgl) = '$month' and Year(b.tgl) = '$year' AND b.id_lokasi = '$id_lokasi' GROUP BY b.id_akun
        ) AS c ON c.id_akun = a.id_akun
        LEFT JOIN tb_permission_akun AS d ON d.id_akun = a.id_akun
        WHERE d.id_sub_menu_akun = '19'");

        $modal = DB::select("SELECT a.no_akun, a.id_akun, a.nm_akun, c.debit, c.kredit
        FROM tb_akun AS a
        LEFT JOIN(
        SELECT b.tgl, b.id_akun , sum(b.debit) AS debit, 
        sum(b.kredit) AS kredit, MONTH(b.tgl) AS bulan, YEAR(b.tgl) AS tahun
        FROM tb_neraca_saldo_penutup AS b 
        WHERE MONTH(b.tgl) = '$month' and Year(b.tgl) = '$year' AND b.id_lokasi = '$id_lokasi' GROUP BY b.id_akun
        ) AS c ON c.id_akun = a.id_akun
        LEFT JOIN tb_permission_akun AS d ON d.id_akun = a.id_akun
        WHERE d.id_sub_menu_akun = '20' ");

        $data = [
            'title' => 'Neraca Saldo setelah Penutup',
            'aktiva_lancar' => $aktiva_lancar,
            'aktiva_tetap' => $aktiva_tetap,
            'hutang' => $hutang,
            'modal' => $modal,
            'bulan' => $month,
            'tahun' => $year,
            'id_lokasi' => $id_lokasi,
            's_tahun' => DB::select("SELECT tgl FROM tb_jurnal GROUP BY YEAR(tgl)"),
        ];

        return view('accounting.akunting2.neracaSaldoPenutup', $data);
    }

    public function cancelJurnal(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        $tgl = DB::select("SELECT a.id_jurnal, MONTH(a.tgl) AS bulan, Year(tgl) AS tahun, a.id_buku
        FROM tb_jurnal AS a
        WHERE a.id_buku IN ('5') AND a.id_lokasi = '$id_lokasi'
        GROUP BY a.tgl  
        ORDER BY a.tgl ASC");
        $data = [
            'title' => 'Cancel Jurnal',
            'tgl' => $tgl,
            'id_lokasi' => $id_lokasi,
        ];
        return view('accounting.akunting2.cancelJurnal', $data);
    }

    public function saveCancel(Request $r)
    {
        $bln = $r->bln;
        $thn = $r->thn;
        $id_jurnal = $r->id_jurnal;
        $bln_pen = $r->bln_pen;
        $thn_pen = $r->thn_pen;
        $bulan_akhir = $r->bulan_akhir;
        $tahun_akhir = $r->tahun_akhir;

        $tgl_awal = '01';
        $tgl_akhir = '31';

        // for ($x = 0; $x < sizeof($id_jurnal); $x++) {

        $bu = $bln;
        $ye = $thn;
        $bu2 = $bln_pen;
        $ye2 = $thn_pen;
        $id_lokasi = Session::get('id_lokasi');

        if (empty($bu2)) {
            return redirect()->route('cancelJurnal', ['acc' => $id_lokasi])->with('error', 'Gagal cancel jurnal');
        } else {
            // penyesuaian
            DB::select("DELETE FROM `tb_atk` WHERE `tgl` between '$ye2-$bu2-$tgl_awal' and '$tahun_akhir-$bulan_akhir-$tgl_akhir' and id_lokasi = '$id_lokasi' and id_satuan = 0");
            DB::select("DELETE FROM `tb_jurnal` WHERE `tgl` between '$ye2-$bu2-$tgl_awal' and '$tahun_akhir-$bulan_akhir-$tgl_akhir' and `id_buku` = '4' and id_lokasi = '$id_lokasi'");

            DB::select("UPDATE tb_jurnal as a SET penutup = 'T' WHERE a.tgl between '$ye2-$bu2-$tgl_awal' and '$tahun_akhir-$bulan_akhir-$tgl_akhir' AND a.id_lokasi = '$id_lokasi'");

            DB::select("DELETE FROM `tb_jurnal` WHERE `tgl` between '$ye2-$bu2-$tgl_awal' and '$tahun_akhir-$bulan_akhir-$tgl_akhir' and `id_buku` = '5' and id_lokasi = '$id_lokasi'");

            DB::select("DELETE FROM `tb_neraca_saldo_penutup` WHERE `tgl` between '$ye2-$bu2-$tgl_awal' and '$tahun_akhir-$bulan_akhir-$tgl_akhir' and id_lokasi = '$id_lokasi'");

            DB::select("DELETE FROM `tb_laba_rugi_penutup` WHERE `tgl` between '$ye2-$bu2-$tgl_awal' and '$tahun_akhir-$bulan_akhir-$tgl_akhir' and id_lokasi = '$id_lokasi'");

            DB::select("DELETE FROM `tb_cashflow_penutup` WHERE `tgl` between '$ye2-$bu2-$tgl_awal' and '$tahun_akhir-$bulan_akhir-$tgl_akhir' and id_lokasi = '$id_lokasi'");
            DB::select("DELETE FROM `budgeting` WHERE `tgl` between '$ye2-$bu2-$tgl_awal' and '$tahun_akhir-$bulan_akhir-$tgl_akhir' and id_lokasi = '$id_lokasi'");

            return redirect()->route('cancelJurnal', ['acc' => $id_lokasi])->with('sukses', 'Berhasil cancel jurnal');
        }
    }

    public function neracaSaldoBaru(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        if (empty($r->month)) {
            $month = date('m');
            $year = date('Y');
        } else {
            $month = $r->month;
            $year = $r->year;
        }
        $tahun = DB::select("SELECT tgl FROM tb_jurnal WHERE id_lokasi = '$id_lokasi' GROUP BY YEAR(tgl)");
        $tb_akun = DB::select("SELECT a.id_akun, a.nm_akun, tb_neraca_saldo_penutup.debit, tb_neraca_saldo_penutup.kredit,c.debit_saldo,c.kredit_saldo FROM tb_akun as a
        left join (SELECT a.id_akun, b.nm_akun, a.debit, a.kredit
        FROM tb_neraca_saldo_penutup AS a
        LEFT JOIN tb_akun AS b ON a.id_akun = b.id_akun
        
        WHERE MONTH(a.tgl) = '$month' and YEAR(a.tgl) = '$year' and a.id_lokasi = '$id_lokasi' 
        GROUP BY b.id_akun) tb_neraca_saldo_penutup on a.id_akun = tb_neraca_saldo_penutup.id_akun
        LEFT JOIN tb_neraca_saldo as c ON a.id_akun = c.id_akun
        WHERE a.id_lokasi = '$id_lokasi'
        order by a.id_akun ASC;");
        $data = [
            'title' => 'Neraca Saldo Baru',
            'id_lokasi' => $id_lokasi,
            'tb_akun' => $tb_akun,
            'tahun' => $tahun,
            'month' => $month,
            'year' => $year,
        ];
        return view('accounting.akunting2.neracaSaldoBaru', $data);
    }
    public function addSaldoAwal(Request $r)
    {
        if (empty($r->month)) {
            $month = date('m');
            $year = date('Y');
        } else {
            $month = $r->month;
            $year = $r->year;
        }
        $id_lokasi = Session::get('id_lokasi');
        $tahun = DB::select("SELECT tgl FROM tb_jurnal WHERE id_lokasi = '$id_lokasi' GROUP BY YEAR(tgl)");
        $tb_akun = DB::select("SELECT a.id_akun, b.tgl, a.nm_akun , b.debit_saldo, b.kredit_saldo
        FROM tb_akun AS a
        LEFT JOIN tb_neraca_saldo AS b ON b.id_akun = a.id_akun
        WHERE a.id_lokasi = '$id_lokasi'");

        $data = [
            'title' => 'Tambah Saldo Awal',
            'tb_akun' => $tb_akun,
            'id_lokasi' => $id_lokasi,
            'tahun' => $tahun,
            'month' => $month,
            'year' => $year,
        ];
        return view('accounting.akunting2.addSaldoAwal', $data);
    }

    public function saldoAwalDanger(Request $r)
    {
        $bulan = $r->bulan;
        $tahun = $r->tahun;
        $id_lokasi = Session::get('id_lokasi');
        $penutup = DB::selectOne("SELECT MONTH(a.tgl) AS bulan, YEAR(a.tgl) AS tahun
        FROM tb_neraca_saldo_penutup AS a
        WHERE a.penutup = 'T' and MONTH(a.tgl) = '$bulan' and YEAR(a.tgl) = '$tahun' and a.id_lokasi = '$id_lokasi'
        GROUP BY MONTH(a.tgl) , YEAR(a.tgl) ");
        if (empty($penutup)) {
            echo "";
        } else {
            echo "Saldo Awal sudah ada di $bulan - $tahun";
        }
    }

    public function saveSaldoAwal(Request $r)
    {
        $id_akun = $r->id_akun;
        $debit = $r->debit;
        $kredit = $r->kredit;
        $tgl = $r->tgl;
        $id_lokasi = Session::get('id_lokasi');

        for ($x = 0; $x < sizeof($id_akun); $x++) {
            $data = [
                'id_akun' => $id_akun[$x],
                'tgl' => $tgl,
                'id_lokasi' => $id_lokasi,
                'debit' => $debit[$x],
                'kredit' => $kredit[$x],
                'no_nota' => '',
                'ket' => 'Saldo Awal',
                'admin' => Auth::user()->nama,
            ];

            DB::table('tb_neraca_saldo_penutup')->insert($data);
        }
    }

    public function getPenutup(Request $r)
    {
        $bulan = $r->bulan;
        $tahun = $r->tahun;
        $id_lokasi = Session::get('id_lokasi');
        $penutup = DB::selectOne("SELECT MONTH(a.tgl) AS bulan, YEAR(a.tgl) AS tahun
        FROM tb_jurnal AS a
        WHERE a.penutup = 'Y' and MONTH(a.tgl) = '$bulan' and YEAR(a.tgl) = '$tahun' and a.id_lokasi = '$id_lokasi'
        GROUP BY MONTH(a.tgl) , YEAR(a.tgl) ");
        if (empty($penutup)) {
            echo "";
        } else {
            echo "Jurnal sudah ditutup pada akhir bulan $bulan - $tahun";
        }
    }

    public function accMenu(Request $r)
    {
        $data = [
            'title' => 'Data Menu',
            'menu' => DB::table('tb_acc_menu')->get(),
            'sub_menu' => DB::table('tb_acc_sub_menu')->join('tb_acc_menu', 'tb_acc_sub_menu.id_menu', 'tb_acc_menu.id_menu')->get(),
        ];
        return view('accounting.more.menu', $data);
    }

    // user acc
    public function accUser(Request $r)
    {
        $data = [
            'title' => 'Data User Accounting',
            'user' => User::where('jenis', 'adm')->get(),
        ];
        return view('accounting.more.user', $data);
    }

    public function accPermission(Request $r)
    {
        $id_user = $r->id_user;
        $permission =  $r->permission;

        DB::table('tb_acc_permission')->where('id_user', $id_user)->delete();

        for ($count = 0; $count < count($permission); $count++) {
            $data_permission = [
                'id_user' => $id_user,
                'permission' => $permission[$count]
            ];

            // var_dump($id_user);
            DB::table('tb_acc_permission')->insert($data_permission);
        }

        return redirect()->route('accUser', ['acc' => Session::get('id_lokasi')])->with('sukses', 'Berhasil Ubah Permission');
    }

    // end user acc -----------------

    // controller menu
    public function saveAccMenu(Request $r)
    {
        $urut = DB::table('tb_acc_menu')->orderBy('urutan', 'DESC')->first();
        if (empty($urutan)) {
            $urutan = 1;
        } else {
            $urutan = $urut->urutan + 1;
        }
        DB::table('tb_acc_menu')->insert([
            'menu' => $r->menu,
            'icon' => $r->icon,
            'urutan' => $urutan,
        ]);
        return redirect()->route('accMenu', ['acc' => $r->id_lokasi])->with('sukses', 'Berhasil tambah Menu');
    }

    public function saveMenuUrutan(Request $r)
    {
        for ($i = 0; $i < count($r->id_menu); $i++) {
            DB::table('tb_acc_menu')->where('id_menu', $r->id_menu[$i])->update([
                'urutan' => $r->urutan[$i],
            ]);
        }

        return redirect()->route('accMenu', ['acc' => Session::get('id_lokasi')])->with('sukses', 'Berhasil tambah Menu');
    }

    public function saveAccSubMenu(Request $r)
    {
        DB::table('tb_acc_sub_menu')->insert([
            'id_menu' => $r->id_menu,
            'sub_menu' => $r->sub_menu,
            'url' => $r->url,
        ]);
        return redirect()->route('accMenu', ['acc' => Session::get('id_lokasi')])->with('sukses', 'Berhasil tambah Sub Menu');
    }

    public function editAccMenu(Request $r)
    {
    }

    public function editSubMenu(Request $r)
    {
        DB::table('tb_acc_sub_menu')->where('id_sub_menu', $r->id_sub_menu)->update([
            'id_menu' => $r->id_menu,
            'sub_menu' => $r->sub_menu,
            'url' => $r->url,
        ]);
        return redirect()->route('accMenu', ['acc' => Session::get('id_lokasi')])->with('sukses', 'Berhasil edit Sub Menu');
    }

    public function deleteAccMenu(Request $r)
    {
    }

    public function deleteAccSubMenu(Request $r)
    {
    }
    // end menu -----------
    public function lBahan(Request $r)
    {
        $data = [
            'title' => 'List Bahan Makanan',
            'lBahan' => DB::table('tb_list_bahan as a')
                ->join('tb_satuan as b', 'a.id_satuan', 'b.id')
                ->join('tb_kategori_makanan as c', 'c.id_kategori_makanan', 'a.id_kategori_makanan')
                ->where('a.id_lokasi', Session::get('id_lokasi'))
                ->orderBy('a.id_list_bahan', 'DESC')
                ->get(),
            'id_lokasi' => Session::get('id_lokasi'),
        ];
        return view('accounting.more.lBahan', $data);
    }

    public function getKategoriMakanan(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        $data = [
            'kategori' => DB::table('tb_kategori_makanan')->where('id_lokasi', $id_lokasi)->get(),
        ];
        return view('accounting.more.kategoriMakanan', $data);
    }

    public function addKategoriMakanan(Request $r)
    {
        DB::table('tb_kategori_makanan')->insert(['nm_kategori' => $r->nm_kategori, 'id_lokasi' => Session::get('id_lokasi')]);
    }

    public function delKategoriMakanan(Request $r)
    {
        DB::table('tb_kategori_makanan')->where('id_kategori_makanan', $r->id_kategori)->delete();
    }

    public function saveLbahan(Request $r)
    {
        $nm_bahan = $r->nm_bahan;
        $id_satuan = $r->id_satuan;

        $data = [
            'nm_bahan' => $nm_bahan,
            'id_satuan' => $id_satuan,
            'id_kategori_makanan' => $r->kategori,
            'admin' => Auth::user()->nama,
            'tgl' => date('Y-m-d'),
            'id_lokasi' => Session::get('id_lokasi'),
        ];

        DB::table('tb_list_bahan')->insert($data);
      
        return redirect()->route('lBahan', ['acc' => Session::get('id_lokasi')])->with('sukses', 'Berhasil tambah Bahan');
        
    }

    public function editLbahan(Request $r)
    {
        $data = [
            'nm_bahan' => $r->nm_bahan,
            'id_satuan' => $r->id_satuan,
            'id_kategori_makanan' => $r->kategori,
        ];
        DB::table('tb_list_bahan')->where('id_list_bahan', $r->id_list_bahan)->update($data);
        return redirect()->route('lBahan', ['acc' => Session::get('id_lokasi')])->with('sukses', 'Berhasil edit Bahan');
    }

    public function delLbahan(Request $r)
    {
        DB::table('tb_list_bahan')->where('id_list_bahan', $r->id_list_bahan)->delete();
        return redirect()->route('lBahan', ['acc' => Session::get('id_lokasi')])->with('error', 'Berhasil hapus Bahan');
    }

    public function stokMakanan(Request $r)
    {
        $dari = $r->dari;
        $sampai = $r->sampai;

        if ($dari == '') {
            $dari = date('Y-m-01');
            $sampai = date('Y-m-t');
        } else {
            $dari = $dari;
            $sampai = $sampai;
        }
        $id_lokasi = Session::get('id_lokasi');
        $data = [
            'title' => 'Management Stok',
            'stok' => DB::select("SELECT e.nm_merk,d.n,a.tgl as tglStok, a.admin as adminStok,a.kd_gabungan, a.debit_makanan, a.kredit_makanan, a.h_satuan, b.nm_bahan, c.nm_kategori FROM `tb_stok_makanan` as a
            LEFT JOIN tb_list_bahan as b on a.id_list_bahan = b.id_list_bahan
            LEFT JOIN tb_merk_bahan as e on a.id_merk_bahan = e.id_merk_bahan
            LEFT join tb_kategori_makanan as c on b.id_kategori_makanan = c.id_kategori_makanan
            LEFT JOIN tb_satuan as d on b.id_satuan = d.id
            WHERE a.tgl BETWEEN '$dari' AND '$sampai' AND a.id_lokasi = '$id_lokasi' ORDER BY a.id_stok_makanan DESC"),
            'dari' => $dari,
            'sampai' => $sampai,
            'id_lokasi' => $id_lokasi,
            'lBahanDaging' => DB::table('tb_list_bahan')->where([['id_lokasi', $id_lokasi], ['id_kategori_makanan', $id_lokasi == 1 ? 1 : 2]])->get(),
            'akun' => Akun::where([['id_lokasi', $id_lokasi],['nm_akun', 'LIKE', '%persediaan%'],['nm_akun', 'NOT LIKE', '%biaya%']])->get(),
            'akun2' => Akun::where('id_lokasi', $id_lokasi)->get(),
            'lBahan' => DB::table('tb_list_bahan')->where('id_lokasi', $id_lokasi)->get()
        ];
        return view('accounting.more.stokMakanan', $data);
    }

    public function delStokMakanan(Request $r)
    {
        DB::table('tb_stok_makanan')->where('kd_gabungan', $r->kd_gabungan)->delete();
        Jurnal::where('kd_gabungan', $r->kd_gabungan)->delete();

        return redirect()->route('stokMakanan', ['acc' => Session::get('id_lokasi'), 'dari' => $r->dari, 'sampai' => $r->sampai])->with('error', 'Berhasil Hapus Stok');
    }

    public function lResep(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        $data = [
            'title' => "Resep Bahan",
            'menu' => DB::table('tb_menu')->where([['lokasi',$id_lokasi], ['tipe', 'food'], ['aktif', 'on']])->get(),
            'id_lokasi' => $id_lokasi,
            'bahan' => DB::table('tb_list_bahan')->where('id_lokasi', $id_lokasi)->get(),
            'resep' => DB::select("SELECT * FROM `tb_resep` as a
                                    LEFT JOIN tb_menu as b ON a.id_menu = b.id_menu
                                    LEFT JOIN  tb_kategori as c on b.id_kategori = c.kd_kategori
                                    WHERE a.id_lokasi = '$id_lokasi'
                                    GROUP BY a.id_menu ORDER BY a.id_resep;")
        ];
        return view('accounting.more.lResep',$data);
    }

    public function saveResep(Request $r)
    {
        $id_menu = $r->id_menu;
        $id_list_bahan = $r->id_list_bahan;
        $qty = $r->qty;
        $id_lokasi = Session::get('id_lokasi');
        
        for ($i=0; $i < count($id_list_bahan); $i++) { 
            $data = [
                'id_menu' => $id_menu,
                'id_list_bahan' => $id_list_bahan[$i],
                'qty' => $qty[$i],
                'id_lokasi' => $id_lokasi,
                'admin' => Auth::user()->nama,
                'tgl' => date('Y-m-d')
            ];
            DB::table('tb_resep')->insert($data);
        }
        return redirect()->route('lResep', ['acc' => $id_lokasi])->with('sukses', 'Berhasil tambah resep');
    }

    public function editResep(Request $r)
    {
        $id_menu = $r->id_menu;
        $id_list_bahan = $r->id_list_bahan;
        $qty = $r->qty;
        $id_list_bahanT = $r->id_list_bahanT;
        $qtyT = $r->qtyT;
        $id_lokasi = Session::get('id_lokasi');

        for ($i=0; $i < count($id_list_bahan); $i++) { 
            
            $data = [
                'id_list_bahan' => $id_list_bahan[$i],
                'qty' => $qty[$i],
                'tgl' => date('Y-m-d')
            ];
            DB::table('tb_resep')->where('id_list_bahan', $id_list_bahan[$i])->where('id_menu', $id_menu)->update($data);
            
        }
        
        if($id_list_bahanT != '') {
            for ($i=0; $i < count($id_list_bahanT); $i++) { 
                $data = [
                    'id_menu' => $id_menu,
                    'id_list_bahan' => $id_list_bahanT[$i],
                    'qty' => $qtyT[$i],
                    'id_lokasi' => $id_lokasi,
                    'admin' => Auth::user()->nama,
                    'tgl' => date('Y-m-d')
                ];
                DB::table('tb_resep')->insert($data);
            }
        }
        // return redirect()->route('lResep', ['acc' => $id_lokasi])->with('sukses', 'Berhasil Edit resep');
    }

    public function delResep(Request $r)
    {
        DB::table('tb_resep')->where('id_menu', $r->id_menu)->delete();
        return redirect()->route('lResep', ['acc' => Session::get('id_lokasi')])->with('error', 'Berhasil hapus resep');
    }

    public function getEditResep(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        $bahan = DB::table('tb_resep')->where('id_menu', $r->id_menu)->get();
        foreach($bahan as $b) {
            $datas = [
                'id_list_bahan' => $b->id_list_bahan
            ];
        }
        $data = [
            'bahanEdit' => $bahan,
            'id_menu' => $r->id_menu,
            'bahan' => DB::table('tb_list_bahan')->where('id_lokasi', $id_lokasi)->get(),
            'datas' => $datas
        ];
        // dd($data['bahan']);
        return view('accounting.more.getEditResep',$data);
    }

    public function delEditResep(Request $r)
    {
        DB::table('tb_resep')->where('id_resep', $r->id_resep)->delete();
    }

    public function mBahan(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        $data = [
            'title' => 'Merk Bahan',
            'merkBahan' => DB::table('tb_merk_bahan as a')
                           ->join('tb_list_bahan as b', 'a.id_list_bahan', 'b.id_list_bahan')
                           ->join('tb_satuan as d', 'b.id_satuan', 'd.id')
                           ->join('tb_kategori_makanan as c', 'b.id_kategori_makanan', 'c.id_kategori_makanan')
                           ->where('a.id_lokasi', $id_lokasi)
                           ->orderBy('a.id_merk_bahan', 'DESC')
                           ->get(),
            'bahan' => DB::table('tb_list_bahan')->get(),
            'id_lokasi' => $id_lokasi
        ];
        return view('accounting.more.mBahan',$data);
    }

    public function saveMbahan(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        $data = [
            'nm_merk' => $r->nm_merk,
            'id_list_bahan' => $r->id_list_bahan,
            'id_lokasi' => $id_lokasi,
            'admin' => Auth::user()->nama
        ];
        DB::table('tb_merk_bahan')->insert($data);
        return redirect()->route('mBahan', ['acc' => $id_lokasi])->with('sukses', 'Berhasil tambah Merk');
    }

    public function delMbahan(Request $r) 
    {
        DB::table('tb_merk_bahan')->where('id_merk_bahan', $r->id_merk_bahan)->delete();
        return redirect()->route('mBahan', ['acc' => Session::get('id_lokasi')])->with('error', 'Berhasil hapus Merk');
    }

    public function getEditMbahan(Request $r)
    {
        $data = [
            'merk' => DB::table('tb_merk_bahan')->where('id_merk_bahan', $r->id_merk_bahan)->first(),
            'bahan' => DB::table('tb_list_bahan')->get(),
        ];
        return view('accounting.more.getEditMbahan',$data);
    }

    public function editMbahan(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        $data = [
            'nm_merk' => $r->nm_merk,
            'id_list_bahan' => $r->id_list_bahan,
        ];
        DB::table('tb_merk_bahan')->where('id_merk_bahan', $r->id_merk_bahan)->update($data);
        return redirect()->route('mBahan', ['acc' => Session::get('id_lokasi')])->with('sukses', 'Berhasil edit Merk');
    }

    public function getSatuanResep(Request $r)
    {
        $d = DB::table('tb_list_bahan as a')->join('tb_satuan as b', 'a.id_satuan', 'b.id')->where('a.id_list_bahan', $r->id_list_bahan)->first();
        $output = [
            'id_satuan' => $d->id,
            'satuan' => $d->n
        ];
        
        echo json_encode($output);
    }

    public function getMerkBahan(Request $r)
    {
        $merk = DB::table('tb_merk_bahan')->where('id_list_bahan', $r->id_list_bahan)->get();
        echo "<option value='0'>- PIlih Merk -</option>";
        echo "<option value='tbhM'>+ Merk</option>";
        foreach($merk as $m)
        {
            echo "
                <option value='$m->id_merk_bahan' class='merkLoop'>$m->nm_merk</option>
            ";
        }
        
    }

    public function getLbahan(Request $r)
    {
        $id_lokasi = Session::get('id_lokasi');
        $bahan = DB::table('tb_list_bahan')->where([['id_lokasi', $id_lokasi], ['id_kategori_makanan', $id_lokasi == 1 ? 1 : 2]])->get();
        echo "<option value='0'>- PIlih Makanan -</option>";
        echo "<option value='tbh'>+ Bahan</option>";
        foreach($bahan as $b) {
            echo "<option value=$b->id_list_bahan>$b->nm_bahan</option>";
        }
    }

    public function tbhBahan(Request $r)
    {
        $data = [
            'title' => 'List Bahan',
            'id_lokasi' => Session::get('id_lokasi'),
        ];
        return view('accounting.template.tbhBahan',$data);
    }

    public function save_budget(Request $r)
    {
        $budget = $r->budget;
        $id_budget = $r->id_budget;

        for ($x = 0; $x < count($id_budget); $x++) {
            $data = [
                'buget' => $budget[$x]
            ];
            DB::table('budgeting')->where('id_budgeting', $id_budget[$x])->update($data);
        }
        return redirect()->route('cashFlow', ['acc' => Session::get('id_lokasi')])->with('sukses', 'Berhasil save budget');
    }

    public function getBiayaPenunjang(Request $r)
    {
        $penunjang = DB::table('tb_biaya_penunjang')->get();
        echo '<div class="row" id="row_monitoring' . $r->countB . '">';
        echo '<div class="col-md-2"><div class="form-group"><select name="" id="pilihPenunjang" class="form-control select">';
        echo "<option value='0'>- Pilih Penunjang -</option>";
        echo "<option value='tbh'>+ Penunjang</option>";
        foreach($penunjang as $p)
        {
            echo "<option value='$p->id_biaya_penunjang'>$p->nm_penunjang</option>";
        }
        echo '</select></div></div>';
        echo '<div class="col-md-2"><input type="text" class="form-control inputBiaya" id="inputBiaya'.$r->countB.'"></div>';
        echo '<div class="col-md-1"><button type="button" name="remove" data-row="row_monitoring' . $r->countB . '" class="btn btn-danger btn-sm remove_stokB">-</button></div></div>';
    }

    public function saveBiayaPenunjang(Request $r)
    {
        DB::table('tb_biaya_penunjang')->insert([
            'nm_penunjang' => $r->nm_penunjang,
            'id_lokasi' => Session::get('id_lokasi')
        ]);
    }
}
