<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Denda;
use App\Models\Jurnal;
use App\Models\Kasbon;
use App\Models\Order2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
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

    public function tb_order3()
    {
        
        $order2 = Order2::where('import', 'T')->get();

        $data1 = [];
        foreach ($order2 as $t) {
            array_push($data1, [
                'no_order' =>  $t->no_order,
                'no_order2' =>  $t->no_order2,
                'id_harga' =>  $t->id_harga,
                'qty' => $t->qty,
                'harga' => $t->harga,
                'tgl' => $t->tgl,
                'id_lokasi' => $t->id_lokasi,
                'admin' => $t->admin,
                'id_distribusi' => $t->id_distribusi,
                'id_meja' => $t->id_meja,
            ]);
        }
        dd($data1);
        Http::post('https://resto-laravel.putrirembulan.com/api/tb_order3', $data1);
    }

    public function tb_kasbon()
    {
        $tb_kasbon = Kasbon::where('import', 'T')->get();


        $data = [];
        $id_kasbon = [];
        foreach ($tb_kasbon as $t) {
            $id_kasbon[] = $t->id_kasbon;
            array_push($data, [
                'tgl' => $t->tgl,
                'nm_karyawan' => $t->nm_karyawan,
                'admin' =>  $t->admin,
                'nominal' =>  $t->nominal,
            ]);
        }
        $response =  Http::post('https://ptagafood.com/api/tb_kasbon', $data);
        Kasbon::whereIn('id_kasbon', $id_kasbon)->update(['import' => 'Y']);
        return redirect()->route('sukses')->with('sukses', 'Sukses');
    }

    public function tb_jurnal(Request $r)
    {
        $data = Jurnal::where('import', 'T')->get();


        $data1 = [];
        $id_jurnal = [];
        foreach ($data as $t) {
            $id_jurnal[] = $t->id_jurnal;
            array_push($data1, [
                'id_buku' => $t->id_buku,
                'id_akun' =>  $t->id_akun,
                'kd_gabungan' =>  $t->kd_gabungan,
                'no_nota' =>  $t->no_nota,
                'id_lokasi' =>  $t->id_lokasi,
                'admin' => $t->admin,
                'debit' => $t->debit,
                'kredit' => $t->kredit,
                'tgl' => $t->tgl,
                'ket' => $t->ket,
                'status' => $t->status,
                'created_at' => $t->created_at,
                'updated_at' => $t->updated_at,
            ]);
        }
        $response = Http::post('https://ptagafood.com/api/tb_jurnal', $data1);
        Jurnal::whereIn('id_jurnal', $id_jurnal)->update(['import' => 'Y']);
    }
}
