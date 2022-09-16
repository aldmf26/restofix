<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Ctt_driver;
use App\Models\Discount;
use App\Models\Dp;
use App\Models\Invoice;
use App\Models\Invoice2;
use App\Models\Jurnal;
use App\Models\Order2;
use App\Models\Orderan;
use App\Models\Transaksi;
use App\Models\Voucher;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderanController extends Controller
{
    public function index(Request $request)
    {
        $tgl = date('Y-m-d');
        $id_lokasi = $request->session()->get('id_lokasi');
        $id = $request->id;
        $data = [
            'title'    => 'Order Permeja',
            'logout' => $request->session()->get('logout'),
            'tb_order' => DB::join('view_menu', 'view_menu.id_harga = tb_order.id_harga')->where('tb_order.aktif', 1)->where('tb_order.id_meja', $id)->get(),
            'no_meja' => DB::join('tb_distribusi', 'tb_distribusi.id_distribusi = tb_order.id_distribusi')->where('tb_order.no_order', $id)->get(),
            'waitress' => DB::table('tb_karyawan')->where('id_status', '2')->get(),
            'driver' => DB::table('tb_karyawan')->get(),
            'order' => DB::select("SELECT a.id_order, b.nm_menu, a.qty, a.request, c.nama AS koki1 , d.nama AS koki2, e.nama AS koki3, 
            a.pengantar, a.id_meja, a.j_mulai, a.j_selesai, a.wait, a.selesai, a.no_order, a.id_distribusi
            FROM tb_order as a 
            left join view_menu as b on a.id_harga = b.id_harga 
            left join tb_karyawan as c on c.id_karyawan = a.id_koki1
            left join tb_karyawan as d on d.id_karyawan = a.id_koki2
            left join tb_karyawan as e ON e.id_karyawan = a.id_koki3
            where a.aktif = '1' and a.no_order = '$id' "),

            'tb_menu' => DB::select("SELECT a.id_menu, a.id_harga, b.nm_menu, c.nm_distribusi, a.harga,b.image
            FROM tb_harga AS a 
            LEFT JOIN tb_menu AS b ON b.id_menu = a.id_menu 
            LEFT JOIN tb_distribusi AS c ON c.id_distribusi = a.id_distribusi
            where a.id_distribusi = '1' AND b.lokasi ='$id_lokasi'
            GROUP BY a.id_harga"),
        ];
        return view('orderan.orderan', $data);
    }
    public function check_pembayaran(Request $request)
    {
        $no = $request->no;
        $order = DB::select("SELECT a.id_order, a.id_harga, b.nm_menu, a.qty, a.request, c.nama AS koki1 , d.nama AS koki2, e.nama AS koki3, a.id_distribusi,
        a.pengantar, a.id_meja, a.j_mulai, a.j_selesai, a.wait, a.selesai, a.harga,
        timestampdiff(MINUTE, a.j_mulai,a.wait) AS selisih, if(f.qty IS NULL ,0,f.qty) AS qty2
        FROM tb_order as a 
        left join view_menu as b on a.id_harga = b.id_harga 
        left join tb_karyawan as c on c.id_karyawan = a.id_koki1
        left join tb_karyawan as d on d.id_karyawan = a.id_koki2
        left join tb_karyawan as e ON e.id_karyawan = a.id_koki3
        LEFT JOIN tb_order2 AS f ON f.id_order1 = a.id_order
        where   a.no_order = '$no' AND (a.qty - if(f.qty IS NULL ,0,f.qty)) != '0' AND a.selesai = 'selesai'");

        if ($order) {
            echo 'ada';
        } else {
            echo 'kosong';
        }
    }

    public function list_orderan(Request $request)
    {
        $no = $request->no;
        $transaksi = DB::table('tb_transaksi')->where('no_order', $no)->get();
        $order = DB::select("SELECT a.id_order, b.nm_menu, a.qty, a.request, c.nama AS koki1 , d.nama AS koki2, e.nama AS koki3, a.id_distribusi,
        a.pengantar, a.id_meja, a.j_mulai, a.j_selesai, a.wait, a.selesai, a.harga,
        timestampdiff(MINUTE, a.j_mulai,a.wait) AS selisih
        FROM tb_order as a 
        left join view_menu as b on a.id_harga = b.id_harga 
        left join tb_karyawan as c on c.id_karyawan = a.id_koki1
        left join tb_karyawan as d on d.id_karyawan = a.id_koki2
        left join tb_karyawan as e ON e.id_karyawan = a.id_koki3
        where   a.no_order = '$no' AND a.selesai = 'selesai' AND a.void = 0 ");

        $data = [
            'title' => 'Pembayaran',
            'logout' => $request->session()->get('logout'),
            'order' => $order,
            'no' => $no,
            'transaksi' => $transaksi,
            'dp' => DB::table('tb_dp')->get(),
            'nav' => '2'
        ];

        return view('orderan.list_orderan', $data);
    }

    public function list_order2(Request $request)
    {
        $id_lokasi = $request->session()->get('id_lokasi');
        $no = $request->no;
        $transaksi = DB::table('tb_transaksi')->where('no_order', $no)->get();
        $order = DB::select("SELECT a.id_order, a.id_harga, b.nm_menu, a.qty, a.request, c.nama AS koki1 , d.nama AS koki2, e.nama AS koki3, a.id_distribusi,
        a.pengantar, a.id_meja, a.j_mulai, a.j_selesai, a.wait, a.selesai, a.harga,
        timestampdiff(MINUTE, a.j_mulai,a.wait) AS selisih, if(f.qty IS NULL ,0,f.qty) AS qty2
        FROM tb_order as a 
        left join view_menu as b on a.id_harga = b.id_harga 
        left join tb_karyawan as c on c.id_karyawan = a.id_koki1
        left join tb_karyawan as d on d.id_karyawan = a.id_koki2
        left join tb_karyawan as e ON e.id_karyawan = a.id_koki3
        LEFT JOIN tb_order2 AS f ON f.id_order1 = a.id_order
        where   a.no_order = '$no' AND (a.qty - if(f.qty IS NULL ,0,f.qty)) != '0' AND a.selesai = 'selesai' AND a.void = 0 ");

        $data = [
            'title' => 'Pembayaran',
            'logout' => $request->session()->get('logout'),
            'order2' => $order,
            'no' => $no,
            'id_distribusi' => $request->id_distribusi,
            'transaksi' => $transaksi,
            'dp' => DB::table('tb_dp')->where('id_lokasi', $id_lokasi)->where('status', 0)->get(),
            'nav' => '2',
            'ongkir_bayar' => DB::select("SELECT SUM(a.rupiah) AS rupiah
            FROM tb_ongkir AS a"),
        ];

        return view('orderan.list_orderan2', $data);
    }

    public function save_transaksi(Request $request)
    {
        $no_order = $request->no_order;
        $id_order = $request->id_order;
        $id_harga = $request->id_harga;
        $qty = $request->qty;
        $harga = $request->harga;
        $id_meja = $request->id_meja;
        $kode_dp = $request->kode_dp;
        $id_distribusi = $request->id_distribusi;
        $lokasi = $request->session()->get('id_lokasi');
        $voucher = $request->voucher;
        $disc = $request->disc;
        $dis = DB::table('tb_distribusi')->where('id_distribusi', $id_distribusi)->first();
        $kode = substr($dis->nm_distribusi, 0, 2);

        $q = DB::select(
            DB::raw("SELECT MAX(RIGHT(a.no_order2,4)) AS kd_max FROM tb_order2 AS a
        WHERE DATE(a.tgl)=CURDATE() AND a.id_lokasi = '$lokasi' AND a.id_distribusi = '$id_distribusi'"),
        );
        $kd = '';
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf('%04s', $tmp);
            }
        } else {
            $kd = '0001';
        }
        
        date_default_timezone_set('Asia/Makassar');
        $no_invoice = date('ymd') . $kd;

        $dis = DB::table('tb_distribusi')
            ->where('id_distribusi', $id_distribusi)
            ->first();
        $kode = substr($dis->nm_distribusi, 0, 2);
        if ($lokasi == '1') {
            $hasil = "T$kode-$no_invoice";
        } else {
            $hasil = "S$kode-$no_invoice";
        }
        $data = [
            'no_invoice' => $hasil,
            'tanggal' => date('Y-m-d'),
        ];

        Invoice2::create($data);

        for ($x = 0; $x < sizeof($id_order); $x++) {
            if ($qty[$x] == '' || $qty[$x] == '0') {
            } else {
                // $ada = Order2::where([
                //     ['id_order1' => $id_order[$x]],
                //     ['created_at' => date('Y-m-d H:i:s')]
                // ]);
                $data = [
                    'id_order1' => $id_order[$x],
                    'no_order' => $no_order,
                    'no_order2' => $hasil,
                    'id_harga' => $id_harga[$x],
                    'qty' => $qty[$x],
                    'harga' => $harga[$x],
                    'tgl' => date('Y-m-d'),
                    'id_lokasi' => $lokasi,
                    'admin' => Auth::user()->nama,
                    'id_distribusi' => $id_distribusi,
                    'id_meja' => $id_meja[$x]
                ];
                Order2::create($data);
            }
        }

        $data = [
            'tgl_transaksi' => date('Y-m-d'),
            'no_order' => $hasil,
            'voucher' => ($request->voucher == '' ? 0 : $request->voucher),
            'discount' => $request->discount == '' ? 0 : $request->discount,
            'dp' => ($request->dp == '' ? 0 : $request->dp),
            'gosen' => $request->gosen,
            'round' => $request->round,
            'total_orderan' => $request->sub,
            'total_bayar' => $request->total_dibayar,
            'cash' => $request->cash,
            'd_bca' => $request->d_bca,
            'k_bca' => $request->k_bca,
            'd_mandiri' => $request->d_mandiri,
            'k_mandiri' => $request->k_mandiri,
            'admin' => Auth::user()->nama,
            'id_lokasi' => $lokasi,
            'ongkir' => $request->ongkir,
            'service' => $request->service,
            'tax' => $request->tax,
            'kembalian' => $request->kembalian1,
        ];
        DB::table('tb_transaksi')->insert($data);

        $data2 = [
            'terpakai' => 'sudah',
            'status' => 'off'
        ];

        Voucher::where('kode', $request->kd_voucher)->update($data2);
        $data3 = [
            'status' => '1'
        ];
        Dp::where('id_dp', $request->id_dp)->update($data3);

        $order = DB::table('tb_order')->select('pengantar')->where('no_order', $no_order)->groupBy('no_order')->first();
        $ongkir = DB::table('tb_ongkir')->select('rupiah')->where('id_ongkir', '1')->first();
        if ($id_distribusi == '3') {
            $data4 = [
                'no_order' => $hasil,
                'nm_driver' => $order->pengantar,
                'nominal' =>  $ongkir->rupiah,
                'tgl' => date('Y-m-d'),
                'admin' => Auth::user()->nama
            ];
            Ctt_driver::create($data4);
        }
        $ttl = $request->total_dibayar;
        $sub = $request->sub;
        $tax = $request->tax;
        $okir = $request->ongkir;
        $service = $request->service;
        $cash = $request->cash;
        $d_bca = $request->d_bca;
        $k_bca = $request->k_bca;
        $d_mandiri = $request->d_mandiri;
        $k_mandiri = $request->k_mandiri;
        $byrTotal = $cash + $d_bca + $k_bca + $d_mandiri + $k_mandiri;
        $kembalian = $byrTotal - $ttl;
        $dp = $request->dp;
        $tagal = date('Y-m-d');
        $month = date('m', strtotime($tagal));
        $year = date('Y', strtotime($tagal));

        $debca = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Bank BCA']])->first();
        $krbca = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Piutang BCA']])->first();
        $dmandiri = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Bank Mandiri']])->first();
        $kamndiri = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Piutang Mandiri']])->first();
        $kas = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Kas']])->first();
        $pjl = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Penjualan']])->first();
        $pll = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Pendapatan di Luar Usaha / lain - lain']])->first();
        $ho = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Hutang Ongkir']])->first();
        $hs = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Hutang Service Charge 7%']])->first();
        $pd = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Pb1 Pajak Daerah 10%']])->first();
        $pdd = Akun::where([['id_lokasi', $lokasi], ['nm_akun', 'Pendapatan dibayar dimuka']])->first();
        
        
        if($dp > 0) {
            $kode_akun = Jurnal::where('id_akun', $pdd->id_akun)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();
            if ($kode_akun == 0) {
                $kode_akun = 1;
            } else {
                $kode_akun += 1;
            }
            $pdd = [
                'id_buku' => 1,
                'id_lokasi' => $lokasi,
                'id_akun' => $pdd->id_akun,
                'kd_gabungan' => $hasil,
                'no_nota' => $pdd->kd_akun . date('Y-m') . '-' . $kode_akun,
                'debit' => $dp,
                'kredit' => 0,
                'tgl' => date('Y-m-d'),
                'ket' => $kode_dp,
                'admin' => Auth::user()->nama,
            ];
            Jurnal::create($pdd);

            if($request->kembalian1 > 0) {
                $kode_akun = Jurnal::where('id_akun',$kas->id_akun)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();
    
                if ($kode_akun == 0) {
                    $kode_akun = 1;
                } else {
                    $kode_akun += 1;
                }
                
                $csh = [
                    'id_buku' => 1,
                    'id_lokasi' => $lokasi,
                    'id_akun' =>$kas->id_akun,
                    'kd_gabungan' => $hasil,
                    'no_nota' =>$kas->kd_akun . date('Y-m') . '-' . $kode_akun,
                    'debit' => 0,
                    'kredit' => $request->kembalian1,
                    'tgl' => date('Y-m-d'),
                    'ket' => 'Kembalian Dp ' . $kode_dp,
                    'admin' => Auth::user()->nama,
                ];
                Jurnal::create($csh);
                $totKembali = $disc > 0 ? $sub * (100 - $disc) / 100 - $voucher : $sub - $voucher;
                if($totKembali < 0) {

                } else {
                    $pjlc = [
                        'id_buku' => 1,
                        'id_lokasi' => $lokasi,
                        'id_akun' => $pjl->id_akun,
                        'kd_gabungan' => $hasil,
                        'no_nota' => $pjl->kd_akun . date('Y-m') . '-' . $kode_akun,
                        'debit' => 0,
                        'kredit' => $totKembali < 0 ? 0 : $totKembali,
                        'tgl' => date('Y-m-d'),
                        'ket' => 'penjualan',
                        'admin' => Auth::user()->nama,
                    ];
                    Jurnal::create($pjlc);
        
                    $pdpll = [
                        'id_buku' => 1,
                        'id_lokasi' => $lokasi,
                        'id_akun' => $pll->id_akun,
                        'kd_gabungan' => $hasil,
                        'no_nota' => $pll->kd_akun . date('Y-m') . '-' . $kode_akun,
                        'debit' => 0,
                        'kredit' => $request->round,
                        'tgl' => date('Y-m-d'),
                        'ket' => 'penjualan',
                        'admin' => Auth::user()->nama,
                    ];
                    Jurnal::create($pdpll);
        
                    if($okir != 0) {
                        $hutong = [
                            'id_buku' => 1,
                            'id_lokasi' => $lokasi,
                            'id_akun' => $ho->id_akun,
                            'kd_gabungan' => $hasil,
                            'no_nota' => $ho->kd_akun . date('Y-m') . '-' . $kode_akun,
                            'debit' => 0,
                            'kredit' => $okir,
                            'tgl' => date('Y-m-d'),
                            'ket' => 'penjualan',
                            'admin' => Auth::user()->nama,
                        ];
                        Jurnal::create($hutong);
                    }
                    
        
                    $hsc = [
                        'id_buku' => 1,
                        'id_lokasi' => $lokasi,
                        'id_akun' => $hs->id_akun,
                        'kd_gabungan' => $hasil,
                        'no_nota' => $hs->kd_akun . date('Y-m') . '-' . $kode_akun,
                        'debit' => 0,
                        'kredit' => $service,
                        'tgl' => date('Y-m-d'),
                        'ket' => 'penjualan',
                        'admin' => Auth::user()->nama,
                    ];
                    Jurnal::create($hsc);
        
                    $ppd = [
                        'id_buku' => 1,
                        'id_lokasi' => $lokasi,
                        'id_akun' => $pd->id_akun,
                        'kd_gabungan' => $hasil,
                        'no_nota' => $pd->kd_akun . date('Y-m') . '-' . $kode_akun,
                        'debit' => 0,
                        'kredit' => $tax,
                        'tgl' => date('Y-m-d'),
                        'ket' => 'penjualan',
                        'admin' => Auth::user()->nama,
                    ];
                    Jurnal::create($ppd);
                }
            }

        }

        if($d_bca) {
            $kode_akun = Jurnal::where('id_akun', $debca->id_akun)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

            if ($kode_akun == 0) {
                $kode_akun = 1;
            } else {
                $kode_akun += 1;
            }
          
            $dbca = [
                'id_buku' => 1,
                'id_lokasi' => $lokasi,
                'id_akun' => $debca->id_akun,
                'kd_gabungan' => $hasil,
                'no_nota' => $debca->kd_akun . date('Y-m') . '-' . $kode_akun,
                'debit' => $d_bca <= $ttl ? $d_bca : $d_bca - $kembalian,
                'kredit' => 0,
                'tgl' => date('Y-m-d'),
                'ket' => 'penjualan',
                'admin' => Auth::user()->nama,
            ];
            Jurnal::create($dbca);
        }
        if($k_bca) {
            $kode_akun = Jurnal::where('id_akun',$krbca->id_akun)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

            if ($kode_akun == 0) {
                $kode_akun = 1;
            } else {
                $kode_akun += 1;
            }
            
            $kbca = [
                'id_buku' => 1,
                'id_lokasi' => $lokasi,
                'id_akun' =>$krbca->id_akun,
                'kd_gabungan' => $hasil,
                'no_nota' =>$krbca->kd_akun . date('Y-m') . '-' . $kode_akun,
                'debit' => $k_bca <= $ttl ? $k_bca : $k_bca - $kembalian,
                'kredit' => 0,
                'tgl' => date('Y-m-d'),
                'ket' => 'penjualan',
                'admin' => Auth::user()->nama,
            ];
            Jurnal::create($kbca);
        }
        if($d_mandiri) {
            $kode_akun = Jurnal::where('id_akun', $dmandiri->id_akun)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

            if ($kode_akun == 0) {
                $kode_akun = 1;
            } else {
                $kode_akun += 1;
            }
           
            $dman = [
                'id_buku' => 1,
                'id_lokasi' => $lokasi,
                'id_akun' => $dmandiri->id_akun,
                'kd_gabungan' => $hasil,
                'no_nota' => $dmandiri->kd_akun . date('Y-m') . '-' . $kode_akun,
                'debit' => $d_mandiri <= $ttl ? $d_mandiri : $d_mandiri - $kembalian,
                'kredit' => 0,
                'tgl' => date('Y-m-d'),
                'ket' => 'penjualan',
                'admin' => Auth::user()->nama,
            ];
            Jurnal::create($dman);
        }
        if($k_mandiri) {
            $kode_akun = Jurnal::where('id_akun', $kamndiri->id_akun)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

            if ($kode_akun == 0) {
                $kode_akun = 1;
            } else {
                $kode_akun += 1;
            }
       
            $kman = [
                'id_buku' => 1,
                'id_lokasi' => $lokasi,
                'id_akun' => $kamndiri->id_akun,
                'kd_gabungan' => $hasil,
                'no_nota' => $kamndiri->kd_akun . date('Y-m') . '-' . $kode_akun,
                'debit' => $k_mandiri <= $ttl ? $k_mandiri : $k_mandiri - $kembalian,
                'kredit' => 0,
                'tgl' => date('Y-m-d'),
                'ket' => 'penjualan',
                'admin' => Auth::user()->nama,
            ];
            Jurnal::create($kman);
        }
        if($cash) {
            $kode_akun = Jurnal::where('id_akun',$kas->id_akun)->whereMonth('tgl', $month)->whereYear('tgl', $year)->count();

            if ($kode_akun == 0) {
                $kode_akun = 1;
            } else {
                $kode_akun += 1;
            }
          
            $csh = [
                'id_buku' => 1,
                'id_lokasi' => $lokasi,
                'id_akun' =>$kas->id_akun,
                'kd_gabungan' => $hasil,
                'no_nota' =>$kas->kd_akun . date('Y-m') . '-' . $kode_akun,
                'debit' => $cash - $kembalian,
                'kredit' => 0,
                'tgl' => date('Y-m-d'),
                'ket' => 'penjualan',
                'admin' => Auth::user()->nama,
            ];
            Jurnal::create($csh);
        }
        if(!$cash && $d_bca || !$cash && $k_bca || !$cash && $d_mandiri || !$cash && $k_mandiri || $cash && $d_bca && $k_bca && $d_mandiri && $k_mandiri || $cash) 
        {
            
            $subTotal = $disc > 0 ? $sub * (100 - $disc) / 100 - $voucher : $sub - $voucher;
            $pjlc = [
                'id_buku' => 1,
                'id_lokasi' => $lokasi,
                'id_akun' => $pjl->id_akun,
                'kd_gabungan' => $hasil,
                'no_nota' => $pjl->kd_akun . date('Y-m') . '-' . $kode_akun,
                'debit' => 0,
                'kredit' => $subTotal < 0 ? 0 : $subTotal,
                'tgl' => date('Y-m-d'),
                'ket' => 'penjualan',
                'admin' => Auth::user()->nama,
            ];
            Jurnal::create($pjlc);

            $pdpll = [
                'id_buku' => 1,
                'id_lokasi' => $lokasi,
                'id_akun' => $pll->id_akun,
                'kd_gabungan' => $hasil,
                'no_nota' => $pll->kd_akun . date('Y-m') . '-' . $kode_akun,
                'debit' => 0,
                'kredit' => $request->round,
                'tgl' => date('Y-m-d'),
                'ket' => 'penjualan',
                'admin' => Auth::user()->nama,
            ];
            Jurnal::create($pdpll);

            if($okir != 0) {
                $hutong = [
                    'id_buku' => 1,
                    'id_lokasi' => $lokasi,
                    'id_akun' => $ho->id_akun,
                    'kd_gabungan' => $hasil,
                    'no_nota' => $ho->kd_akun . date('Y-m') . '-' . $kode_akun,
                    'debit' => 0,
                    'kredit' => $okir,
                    'tgl' => date('Y-m-d'),
                    'ket' => 'penjualan',
                    'admin' => Auth::user()->nama,
                ];
                Jurnal::create($hutong);
            }
            

            $hsc = [
                'id_buku' => 1,
                'id_lokasi' => $lokasi,
                'id_akun' => $hs->id_akun,
                'kd_gabungan' => $hasil,
                'no_nota' => $hs->kd_akun . date('Y-m') . '-' . $kode_akun,
                'debit' => 0,
                'kredit' => $service,
                'tgl' => date('Y-m-d'),
                'ket' => 'penjualan',
                'admin' => Auth::user()->nama,
            ];
            Jurnal::create($hsc);

            $ppd = [
                'id_buku' => 1,
                'id_lokasi' => $lokasi,
                'id_akun' => $pd->id_akun,
                'kd_gabungan' => $hasil,
                'no_nota' => $pd->kd_akun . date('Y-m') . '-' . $kode_akun,
                'debit' => 0,
                'kredit' => $tax,
                'tgl' => date('Y-m-d'),
                'ket' => 'penjualan',
                'admin' => Auth::user()->nama,
            ];
            Jurnal::create($ppd);
        }

        return redirect()->route('pembayaran2', ['no' => $hasil]);
    }

    public function pembayaran2(Request $request)
    {
        $no = $request->no;
        $order = DB::select("SELECT a.*, SUM(a.qty) as qty_produk, b.nm_menu, c.nm_meja
        FROM tb_order2 as a 
        left join view_menu as b on a.id_harga = b.id_harga 
        left join tb_meja as c on c.id_meja = a.id_meja
        
        where   a.no_order2 = '$no' 
        GROUP BY a.id_harga
        ");

        $meja = DB::table('tb_order2')->where('no_order2', $no)->first();

        $dis = Order2::where('no_order2', $no)->first();


        $data = [
            'title' => 'Pembayaran',
            'logout' => $request->session()->get('logout'),
            'transaksi' => DB::table('tb_transaksi')->where('no_order', $no)->first(),
            'order' => $order,
            'dis' => $dis->id_distribusi,
            'no' => $no,
            'meja' => $meja->id_meja,
            'dp' => DB::table('tb_dp')->get(),
            'nav' => '2',
            'ongkir_bayar' => DB::select("SELECT SUM(a.rupiah) AS rupiah
            FROM tb_ongkir AS a"),
        ];

        return view('orderan.pembayaran2', $data);
    }

    public function print_nota(Request $request)
    {
        $no = $request->no;
        $kembalian = $request->kembalian;
        $order = DB::select("SELECT a.*, SUM(a.qty) as qty_produk, b.nm_menu, c.j_mulai , c.j_selesai, c.wait ,
        timestampdiff(MINUTE, MIN(c.j_mulai),MAX(c.j_selesai)) AS selisih, timestampdiff(MINUTE, MIN(c.j_selesai),MAX(c.wait)) AS selisih2
        FROM tb_order2 as a 
        left join tb_order as c on c.id_order = a.id_order1
        left join view_menu as b on a.id_harga = b.id_harga 
        where   a.no_order2 = '$no'
        GROUP BY a.id_harga
        ");


        $data = [
            'title' => 'Pembayaran',
            'transaksi' => Transaksi::where('no_order', $no)->first(),
            'order' => $order,
            'no' => $no,
            'kembalian' => $kembalian,
            'dp' => Dp::all(),
            'pesan_2' => DB::select("SELECT a.*, sum(a.qty) as sum_qty ,  b.nm_meja , c.j_mulai, c.j_selesai, c.wait,c.orang
            FROM tb_order2 as a 
            left join tb_meja as b on a.id_meja = b.id_meja 
            LEFT JOIN tb_order AS c ON c.id_order = a.id_order1
            where a.no_order2 = '$no' 
            group by a.no_order2"),
        ];

        return view('orderan.print_nota', $data);
    }

    public function all_checker(Request $request)
    {
        $id = $request->no;
        $order = DB::select("SELECT a.id_order, b.nm_menu, a.qty, a.request, c.nama AS koki1 , d.nama AS koki2, e.nama AS koki3, 
        a.pengantar, a.id_meja, a.j_mulai, a.j_selesai, a.wait, a.selesai,
        timestampdiff(MINUTE, a.j_mulai,a.wait) AS selisih, a.no_checker , a.print, a.copy_print
        FROM tb_order as a 
        left join view_menu as b on a.id_harga = b.id_harga 
        left join tb_karyawan as c on c.id_karyawan = a.id_koki1
        left join tb_karyawan as d on d.id_karyawan = a.id_koki2
        left join tb_karyawan as e ON e.id_karyawan = a.id_koki3
        where a.aktif = '1' and  a.no_order = '$id' 
        ORDER BY a.id_order DESC
        ");

        $data = [
            'order' => $order,
            'no_order' => $id,
            'pesan_2'    => DB::select("SELECT a.*, sum(a.qty) as sum_qty ,  b.nm_meja FROM tb_order as a left join tb_meja as b on a.id_meja = b.id_meja where a.no_order = '$id' group by a.no_order"),
        ];
        return view('orderan.checker', $data);
    }

    public function voucher(Request $request)
    {
    }

    public function get_dp(Request $request)
    {
        $id_dp = $request->id_dp;
        $dp = Dp::where('id_dp', $id_dp)->get();
        $output = [];
        foreach ($dp as $d) {
            $output['id_dp'] = $d->id_dp;
            $output['kd_dp'] = $d->kd_dp;
            $output['tgl'] = $d->tgl;
            $output['jumlah'] = $d->jumlah;
            $output['metode'] = $d->metode;
        }
        echo json_encode($output);
    }

    public function get_discount(Request $request)
    {
        $id_discount = $request->id_discount;
        $now = date('Y-m-d');
        $discount = Discount::where('id_discount', $id_discount)->get();

        $output = [];
        foreach ($discount as $d) {
            $output['id_discount'] = $d->id_discount;
            $output['ket'] = $d->ket;
            $output['dari'] = $d->dari;
            $output['expired'] = $d->expired;
            $output['jenis'] = $d->jenis;
            $output['disc'] = $d->disc;
        }
        echo json_encode($output);
    }
}
