<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TblMenu extends Component
{
    public $search = '';
     
    public function render(Request $request)
    {
        $data = [
            'menu' => DB::table('tb_menu')->select('tb_menu.*', 'tb_kategori.*')->join('tb_kategori', 'tb_menu.id_kategori', '=', 'tb_kategori.kd_kategori')->where('tb_menu.lokasi', $request->id_lokasi)->where('tb_menu.nm_menu', 'like', '%'.$this->search.'%')->orderBy('tb_menu.id_menu', 'DESC')->paginate(5),
            'id_lokasi' => $request->id_lokasi,
        ];
        return view('livewire.tbl-menu',$data);
    }
}
