<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VoucherHapusController extends Controller
{
    public function index(Request $request)
    {
        $id_user = Auth::user()->id;
        $id_menu = DB::table('tb_permission')->select('id_menu')->where('id_user', $id_user)
            ->where('id_menu', 6)->first();
        if (empty($id_menu)) {
            return back();
        } else {

            $data = [
                'title' => 'Voucher Hapus',
                'logout' => $request->session()->get('logout'),
                'voucher' => DB::table('tb_voucher_hapus')->orderBy('id_voucher', 'DESC')->get()
            ];
            return view("voucher.voucher", $data);
        }
    }

    public function tbh_voucher_hapus()
    {
        $random = Str::random('8');
        $data = [
            'kode_voucher' => Str::upper('TS-' . $random),
            'status' => 'T'
        ];
        DB::table('tb_voucher_hapus')->isnert($data);
        return redirect()->route('voucher_hapus')->with('sukses', 'Sukses');
    }
    public function hapus_voucher_hapus(Request $request)
    {
        $id = $request->id_voucher;

        DB::table('tb_voucher_hapus')->where('id_voucher', $id)->delete();
        return redirect()->route('voucher_hapus')->with('sukses', 'Sukses');
    }
}
