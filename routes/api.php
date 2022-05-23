<?php

use App\Models\Denda;
use App\Models\Order2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('tb_order2', function(Request $t){
    $data = array(
        'id_order2' => $t->id_order2,
        'id_order1' =>  $t->id_order1,
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
    );
    $respon = Order2::create($data);
    if (!$respon) {
        return 'gagal';
    } else {
        return 'sukses';
    }
});

Route::post('tb_denda', function(Request $t){
    $data = array(
        'id_order2' => $t->id_order2,
        'id_order1' =>  $t->id_order1,
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
    );
    $respon = Denda::create($data);
    if (!$respon) {
        return 'gagal';
    } else {
        return 'sukses';
    }
});
