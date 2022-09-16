@php
    $id_akun = $id_lokasi == 1 ? '228' : '229';
    $b_id_akun = $id_lokasi == 1 ? '230' : '231';
    $tgl_last = DB::selectOne("SELECT max(a.tgl) as tgl FROM tb_jurnal as a where a.id_buku = '4' and a.id_akun = '$id_akun'");
    $bulan = date('Y-m-t', strtotime('last day of next month', strtotime($tgl_last->tgl)));
@endphp

<div class="row">
    <div class="col-lg-2">
        <label for="">Tanggal</label>
        <input type="date" name="tgl_daging" class="form-control" id="" value="<?= $bulan ?>">
    </div>
    <div class="col-lg-3">
        <label for="">Akun</label>
        <input type="text" name="" value="Biaya Persediaan Daging & Ayam" class="form-control" id="" readonly>
        <input type="hidden" name="id_akun_daging" value="{{ $b_id_akun }}" class="form-control" id="" readonly>
    </div>
    <div class="col-lg-2">
        <label for="">Debit</label>
        <input type="text" name="debit_daging" class="form-control ttl_debit_d" id="" readonly>
    </div>
    <div class="col-lg-3">
        <label for="">Akun</label>
        <input type="text" name="" value="Persediaan Daging & Ayam" class="form-control" id="" readonly>
        <input type="hidden" name="id_akun_kredit_daging" value="{{ $id_akun }}" class="form-control" id="" readonly>
    </div>
    <div class="col-lg-2">
        <label for="">Kredit</label>
        <input type="text" name="kredit_daging" class="form-control ttl_debit_d" id="" readonly>
    </div>
</div>

<br>
<br>
<div class="row justify-content-center">
    <div class="col-lg-2">
        <label for="">Nama Daging</label>
    </div>
    <div class="col-lg-2">
        <label for="">Qty Program</label>
    </div>
    <div class="col-lg-2">
        <label for="">Qty aktual</label>
    </div>
    <div class="col-lg-1">
        <label for="">Satuan</label>
    </div>
    <div class="col-lg-1">
        <label for="">Selisih</label>
    </div>
    <div class="col-lg-2">
        <label for="">Harga satuan</label>
    </div>
    <div class="col-lg-2">
        <label for="">Total</label>
    </div>
    <?php
    foreach ($daging as $p) : ?>
        <?php $harga_satuan = DB::selectOne("SELECT a.h_satuan
            FROM tb_stok_makanan AS a
            WHERE a.id_list_bahan = '$p->id_list_bahan' 
            ORDER BY a.id_stok_makanan DESC LIMIT 1
            "); ?>
        <div class="col-lg-2 mb-2">
            <input type="text" class="form-control" value="<?= $p->nm_bahan ?>" readonly>
            <input type="hidden" name="id_list_bahan[]" class="form-control" value="<?= $p->id_list_bahan ?>" readonly>
        </div>
        <div class="col-lg-2">
            <input type="text" class="form-control qty_d_pro<?= $p->id_list_bahan ?>" value="<?= round($p->debit_daging - $p->kredit_daging, 0) ?>" readonly>
        </div>
        <div class="col-lg-2">
            <input type="text" name="qty_daging[]" class="form-control qty_d_aktual qty_ak_d<?= $p->id_list_bahan ?>" id_list_bahan="<?= $p->id_list_bahan ?>" value="0">
        </div>
        <div class="col-lg-1">
            <input type="text" name="" readonly class="form-control" value="{{ $p->n }}">
        </div>
        <div class="col-lg-1">
            <input type="text" value="0" name="selisih_daging[]" class="form-control slsh_d<?= $p->id_list_bahan ?>" readonly>
        </div>
        <div class="col-lg-2">
            <input type="text" name="h_satuan_daging[]" value="<?= $harga_satuan->h_satuan ?>" class="form-control h_satuan_d<?= $p->id_list_bahan ?>" readonly>
        </div>
        <div class="col-lg-2">
            <input type="text" class="form-control ttl_daging tl_daging<?= $p->id_list_bahan ?>" value="0" readonly>
        </div>


    <?php endforeach ?>
</div>