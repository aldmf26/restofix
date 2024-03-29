<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use App\Models\Harga;
use App\Models\Menu;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {

        $id_user = Auth::user()->id;
        $id_menus = DB::table('tb_permission')->select('id_menu')->where('id_user', $id_user)
            ->where('id_menu', 11)->first();
        if (empty($id_menus)) {
            return back()->with('warning', 'Permission belum diatur');
        } else {
            if (Auth::user()->jenis == 'adm') {
                $id_lokasi = $request->id_lokasi;
                $data = [
                    'title' => 'Menu',
                    'logout' => $request->session()->get('logout'),
                    'menu1' => DB::raw("SELECT tb_menu.*, tb_kategori.* FROM tb_menu LEFT JOIN tb_kategori ON tb_menu.id_kategori = tb_kategori.kd_kategori WHERE tb_menu.lokasi = $id_lokasi "),
                    'menu' => DB::table('tb_menu')->select('tb_menu.*', 'tb_kategori.*')->join('tb_kategori', 'tb_menu.id_kategori', '=', 'tb_kategori.kd_kategori')->where('tb_menu.lokasi', $id_lokasi)->orderBy('tb_menu.id_menu', 'DESC')->get(),

                    'kategori' => DB::table('tb_kategori')->get(),
                    'distribusi' => Distribusi::all(),
                    'id_lokasi' => $id_lokasi
                ];

                return view("menu.menu", $data);
            } else {
                return back();
            }
        }
    }

    public function tblMenu(Request $request)
    {
      
        $data = [
            'menu' => DB::table('tb_menu')->join('tb_kategori', 'tb_menu.id_kategori', '=', 'tb_kategori.kd_kategori')
            ->join('tb_station', 'tb_menu.id_station', 'tb_station.id_station')
            ->where('tb_menu.lokasi', $request->id_lokasi)->orderBy('tb_menu.id_menu', 'DESC')->paginate(10),
            'id_lokasi' => $request->id_lokasi,
            
        ];
        return view('menu.table',['page' => 1],$data);
    }

    public function cariMenu(request $request)
    {
        $data = [
            'menu' => DB::table('tb_menu')
            ->join('tb_kategori', 'tb_menu.id_kategori', '=', 'tb_kategori.kd_kategori')
            ->join('tb_station', 'tb_menu.id_station', '=', 'tb_station.id_station')->where('tb_menu.lokasi', $request->id_lokasi)
            ->where('tb_menu.nm_menu','like','%'.$request->keyword.'%')
            ->orWhere('tb_kategori.kategori','like','%'.$request->keyword.'%')
            ->orWhere('tb_menu.tipe','like','%'.$request->keyword.'%')
            ->orderBy('tb_menu.id_menu', 'DESC')->get(),
            'id_lokasi' => $request->id_lokasi,
            
        ];
        return view('menu.cari',$data);
    }

    public function importMenu(Request $request)
    {
            // include APPPATH.'third_party/PHPExcel/PHPExcel.php';
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($file);
            // $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
            // $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
            $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $lokasi = $request->id_lokasi;
    
    
            $data = array();
            $numrow = 1;
            // cek
            $cek = 0;
            foreach ($sheet as $row) {
    
                if ($row['A'] == "" && $row['B'] == "" && $row['C'] == "" && $row['D'] == "" && $row['E'] == "" && $row['F'] == "")
                    continue;
                $numrow++; // Tambah 1 setiap kali looping
            }
            // endcek
        
            
            $kmenu = Menu::orderBy('kd_menu', 'desc')->where('lokasi', $lokasi)->first();

            $kd_menu = $kmenu->kd_menu + 1;

            foreach ($sheet as $row) {
                if ($row['A'] == "" && $row['B'] == "" && $row['C'] == "" && $row['D'] == "" && $row['E'] == "" && $row['F'] == "")
                    continue;
    
    
                if ($numrow > 1) {
                    
                    $data = [
                        'id_kategori' => $row['A'],
                        'kd_menu' => $kd_menu++,
                        'nm_menu' => $row['B'],
                        'tipe' => $row['C'],
                        'aktif' => 'on',
                        'lokasi' => $lokasi,
                    ];
                    $menu = Menu::create($data);
    
                    if ($row['D'] == '') {
                        # code...
                    } else {
                        $data2 = [
                            'id_menu' => $menu->id,
                            'id_distribusi' => '1',
                            'harga' => $row['D']
                        ];
                        Harga::create($data2);
                    }

                    if ($row['E'] == '') {
                        # code...
                    } else {
                        $data3 = [
                            'id_menu' => $menu->id,
                            'id_distribusi' => '3',
                            'harga' => $row['E']
                        ];
                        Harga::create($data3);
                    }
    
                    if ($row['F'] == '') {
                        # code...
                    } else {
                        $data4 = [
                            'id_menu' => $menu->id,
                            'id_distribusi' => '2',
                            'harga' => $row['F']
                        ];
                        Harga::create($data4);
                    }
                }
                $numrow++; // Tambah 1 setiap kali looping
            }
    
            return redirect()->route('menu', ['id_lokasi' => 1])->with('sukses', 'Data berhasil Diimport');

        
    }

    public function exportMenu(Request $request)
    {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getStyle('A1:D4')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        // lebar kolom
        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(13);
        $sheet->getColumnDimension('F')->setWidth(13);
        // header text
        $sheet
            ->setCellValue('A1', 'KODE KATEGORI')
            ->setCellValue('B1', 'NAMA MENU')
            ->setCellValue('C1', 'TIPE(FOOD/DRINK)')
            ->setCellValue('D1', 'DINE IN')
            ->setCellValue('E1', 'DELIVERY')
            ->setCellValue('F1', 'GOJEK');
        
        $sheet
            ->setCellValue('A2', '3')
            ->setCellValue('B2', 'Sosis Ayam')
            ->setCellValue('C2', 'food')
            ->setCellValue('D2', '30000')
            ->setCellValue('E2', '30000')
            ->setCellValue('F2', '40000');

        $sheet
            ->setCellValue('I1', 'TAKEMORI')
            ->mergeCells('I1:J1')
            ->setCellValue('I2', 'KODE KATEGORI')
            ->setCellValue('J2', 'KATEGORI');

        $sheet
            ->setCellValue('M1', 'SOONDOBU')
            ->mergeCells('M1:N1')
            ->setCellValue('M2', 'KODE KATEGORI')
            ->setCellValue('N2', 'KATEGORI');

        $tkm = DB::table('tb_kategori')->where('lokasi', "TAKEMORI")->get();
        $sdb = DB::table('tb_kategori')->where('lokasi', "SOONDOBU")->get();
        $kolom = 3;
        foreach ($tkm as $k) {
            $sheet
                ->setCellValue('I'.$kolom,$k->kd_kategori)
                ->setCellValue('J'.$kolom,$k->kategori);
            $kolom++;
        }

        $kol = 3;
        foreach ($sdb as $k) {
            $sheet
                ->setCellValue('M'.$kol,$k->kd_kategori)
                ->setCellValue('N'.$kol,$k->kategori);
            $kol++;
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
        $sheet->getStyle('A1:F10')->applyFromArray($style);
        $batas = count($tkm) + 2;
        $sheet->getStyle('I1:J'.$batas)->applyFromArray($style);
        $batas = count($sdb) + 2;
        $sheet->getStyle('M1:N'.$batas)->applyFromArray($style);
        // center
        $sheet->getStyle('I1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('M1')->getAlignment()->setHorizontal('center');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format Menu.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function addMenu(Request $request)
    {
        $menu = Menu::orderBy('kd_menu', 'desc')->where('lokasi', $request->id_lokasi)->first();

        $kd_menu = $menu->kd_menu + 1;

        if($request->hasFile('image')){
            $request->file('image')->move('assets/tb_menu/', $request->file('image')->getClientOriginalName());
        $foto = $request->file('image')->getClientOriginalName();
        }else{
            $foto = '';
        }

        $data1 = [

            'id_kategori' => $request->id_kategori,
            'kd_menu' => $kd_menu,
            'nm_menu' => $request->nm_menu,
            'id_station' => $request->id_station,
            'id_kategori' => $request->id_kategori,
            'tipe' => $request->tipe,
            'image' => $foto,
            'lokasi' => $request->id_lokasi,
            'aktif' => 'on',

        ];

        $menu = Menu::create($data1);
        $id_menu = $menu->id;
        $id_distribusi = $request->id_distribusi;
        $harga = $request->harga;
        for ($i = 0; $i < count($request->id_distribusi); $i++) {
            $data2 = [
                'id_menu' => $id_menu,
                'id_distribusi' => $id_distribusi[$i],
                'harga' => $harga[$i],
            ];

            Harga::create($data2);
        }

        return redirect()->route('menu', ['id_lokasi' => $request->id_lokasi])->with('sukses', 'Berhasiil tambah Menu');
    }

    public function deleteMenu(Request $request)
    {
        Menu::where('id_menu', $request->id_menu)->delete();
        Harga::where('id_menu', $request->id_menu)->delete();
        return redirect()->route('menu', ['id_lokasi' => $request->id_lokasi])->with('error', 'Berhasiil Hapus Menu');
    }

    public function updateMenu(Request $request)
    {

        $data1 = [
            'id_kategori' => $request->id_kategori,
            'kd_menu' => $request->kd_menu,
            'nm_menu' => $request->nm_menu,
            'id_kategori' => $request->id_kategori,
            'tipe' => $request->tipe,
            'id_station' => $request->id_station,
            'lokasi' => $request->id_lokasi,
            'aktif' => 'on',

        ];
        $menu = Menu::where('id_menu', $request->id_menu)->update($data1);
        $id_menu = $request->id_menu;
        $id_distribusi = $request->id_distribusi;
        $harga = $request->harga;
        for ($i = 0; $i < count($id_distribusi); $i++) {
            $data2 = [
                'id_menu' => $id_menu,
                'id_distribusi' => $id_distribusi[$i],
                'harga' => $harga[$i],
            ];
            // dd($data2);
            Harga::where('id_harga', $request->id_harga[$i])->update($data2);
        }

        return redirect()->route('menu', ['id_lokasi' => $request->id_lokasi])->with('sukses', 'Berhasiil ubah Menu');
    }

    public function editMenuCheck(Request $request)
    {
        $id = $request->id_checkbox;
        $nilai1 = $request->nilai1;


        $data = [
            'aktif' => $nilai1
        ];
        Menu::where('id_menu', $id)->update($data);
    }

    public function plusDistribusi(Request $request)
    {
        $id_distribusi = $request->id_distribusi;
        $id_menu = $request->id_menu;
        $cek = Harga::where('id_menu', $id_menu)->where('id_distribusi', $id_distribusi)->first();
        if ($cek == '') {
            $data = [
                'id_distribusi' => $id_distribusi,
                'id_menu' => $id_menu,
                'harga' => $request->harga,
            ];

            Harga::create($data);
            return redirect()->route('menu', ['id_lokasi' => $request->id_lokasi])->with('sukses', 'Berhasil Tambah Harga');
        } else {
            return back()->with('error', 'Distribusi sudah ada');
        }
    }
    public function station(Request $r) 
    {
        $data = [
            'id_lokasi' => $r->id_lokasi
        ];
      
        return view('menu.station',$data);
    }
    public function addStation(Request $r)
    {
        DB::table('tb_station')->insert([
            'nm_station' => $r->nm_station,
            'id_lokasi' => $r->id_lokasi,
        ]);

        
    }

    public function delStation(Request $r)
    {
        DB::table('tb_station')->where('id_station', $r->id_station)->delete();
    }
}
