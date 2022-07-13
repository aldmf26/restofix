<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $url = Str::remove('http://127.0.0.1:8000/', $request->url());
        $id_user = Auth::user()->id;
        $sub = DB::table('tb_acc_sub_menu')
                            ->where('url', $url)
                            ->first();
        $per = DB::table('tb_acc_permission')
            ->where([['id_user', $id_user], ['permission', $sub->id_sub_menu]])
            ->first();
        if(empty($per)) {
            return redirect()->route('error');
        } else {
            
        }
        
        // if(count($data_permission) > 0) {
        //     return $next($request);
        // } else {

        // }

    }
}
