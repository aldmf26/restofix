<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderan extends Model
{
    use HasFactory;
    protected $table = 'tb_order';
    protected $fillable = ['no_order', 'id_harga', 'qty', 'harga', 'request', 'id_meja', 'id_distribusi', 'selesai', 'id_lokasi', 'tgl', 'admin', 'j_mulai', 'aktif', 'ongkir', 'orang', 'pengantar', 'wait', 'no_checker', 'print', 'copy_print', 'void', 'alasan', 'nm_void'];
}
