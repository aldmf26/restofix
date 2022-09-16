<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginAdministratorController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login Administrator',
            
        ];
        return view('administrator.login',$data);
    }   

    public function aksiLoginAdm(Request $request)
    {

        $data = [
            'username' => $request->username,
            'password' => $request->password,
            'jenis' => $request->jenis,
        ];
        
        $user = User::where('username', $request->username)->first();
        $data_permission = DB::table('tb_acc_permission')->join('tb_acc_sub_menu', 'tb_acc_permission.permission', 'tb_acc_sub_menu.id_sub_menu')->where('tb_acc_permission.id_user', $user['id'])->get();
        $permission = [];

        // $db = Login::where('username','=',$request->username)->get();

       if(Auth::attempt($data))
       {    
            if(count($data_permission) > 0) {
                foreach ($data_permission as $d) {
                    $permission[] = $d->permission;
                    $dt_menu[] = $d->id_menu;
                }
                $request->session()->put('permission', $permission);
                $request->session()->put('dt_menu', $dt_menu);
            } else {
                
            }
            $request->session()->regenerate();
            $request->session()->put('id_lokasi', 3);
            $request->session()->put('logout', 'Adm');
            return redirect()->route('welcome')->with('sukses', 'Login Berhasil');
        } else {
            return back()->with('error', 'Username/Password salah');
       }
        
    }

    public function logoutAdm(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('home');
    }
}