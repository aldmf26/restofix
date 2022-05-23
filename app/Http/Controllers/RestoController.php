<?php 
namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Kasbon;
use App\Models\Posisi;
use App\Models\Tips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RestoController extends Controller
{
    public function tb_denda()
    {
        $data = Denda::where('import', 'T')->get();

        foreach($data as $t) {
            $response = Http::post('https://resto-laravel.putrirembulan.com/api/tb_denda', [
                'nama' => $t->nama,
                'alasan' =>  $t->alasan,
                'nominal' =>  $t->nominal,
                'tgl' =>  $t->tgl,
                'id_lokasi' =>  $t->id_lokasi,
                'admin' => $t->admin,
            ]);
            Denda::where('id_denda', $t->id_denda)->update([
                'import' => 'Y'
            ]);
        }
    }   

    public function tb_kasbon()
    {
        $data = Kasbon::where('import', 'T')->get();

        foreach($data as $t) {
            $response = Http::post('https://resto-laravel.putrirembulan.com/api/tb_kasbon', [
                'tgl' => $t->tgl,
                'nm_karyawan' => $t->nm_karyawan,
                'admin' =>  $t->admin,
                'nominal' =>  $t->nominal,
            ]);
            Kasbon::where('id_kasbon', $t->id_kasbon)->update([
                'import' => 'Y'
            ]);
        }
    }

    public function tb_tips()
    {
        $data = Tips::where('import', 'T')->get();

        foreach($data as $t) {
            $response = Http::post('https://resto-laravel.putrirembulan.com/api/tips_tb', [
                'tgl' => $t->tgl,
                'admin' =>  $t->admin,
                'nominal' =>  $t->nominal,
            ]);
            Tips::where('id_tips', $t->id_tips)->update([
                'import' => 'Y'
            ]);
        }
    }
}