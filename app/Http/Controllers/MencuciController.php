<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Ket;
use App\Models\Mencuci;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MencuciController extends Controller
{
    public function index(Request $request)
    {
        $id_user = Auth::user()->id;
        $id_menu = DB::table('tb_permission')->select('id_menu')->where('id_user',$id_user)
        ->where('id_menu', 6)->first();
        if(empty($id_menu)) {
            return back();
        } else {

            $data = [
                'title' => 'Data Mencuci',
                'logout' => $request->session()->get('logout'),
                'mencuci' => Mencuci::select('tb_mencuci.*', 'keterangan_cuci.*')->join('keterangan_cuci','tb_mencuci.id_ket','=','keterangan_cuci.id_ket')->orderBy('id_mencuci', 'desc')->get(),
                'ket' => Ket::all(),
                'karyawan' => Karyawan::all(),
            ];
    
            return view('mencuci.mencuci', $data);
        }
    }
    public function addMencuci(Request $request)
    {   
        $nama = $request->nama;
        $ket = $request->ket;
        $j_awal = $request->j_awal;
        $j_akhir = $request->j_akhir;
        $tgl = $request->tgl;
        $ket2 = $request->ket2;

        for ($i=0; $i < count($request->nama); $i++) { 
            $data = [
                'nm_karyawan' => $nama[$i],
                'id_ket' => $ket[$i],
                'ket2' => $ket2[$i],
                'tgl' => $tgl[$i],
                'j_awal' => $j_awal[$i],
                'j_akhir' => $j_akhir[$i],
                'admin' => Auth::user()->nama
            ];
            Mencuci::create($data);
        }


        return redirect()->route('mencuci')->with('sukses', 'Berhasil tambah mencuci');
    }     

    public function editMencuci(Request $request)
    {
        $data = [
            'nm_karyawan' => $request->nama,
            'id_ket' => $request->ket,
            'ket2' => $request->ket2,
            'tgl' => $request->tgl,
            'j_awal' => $request->j_awal,
            'j_akhir' => $request->j_akhir,
            'admin' => Auth::user()->nama
        ];

    
        Mencuci::where('id_mencuci',$request->id_mencuci)->update($data);

      
        return redirect()->route('mencuci')->with('sukses', 'Berhasil Ubah Data mencuci');
    }

    public function deleteMencuci(Request $request)
    {
        Mencuci::where('id_mencuci',$request->id_mencuci)->delete();
        return redirect()->route('mencuci')->with('error', 'Berhasil hapus mencuci');
    }
     
}
