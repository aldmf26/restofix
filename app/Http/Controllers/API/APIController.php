<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Denda;
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
}
