<?php 
$id_akun = $id_lokasi == 1 ? 74 : 112;
$id_akunBiayaAtk = $id_lokasi == 1 ? 177 : 207;
$tgl_akhir = DB::selectOne("SELECT a.id_akun, b.id_relation_kredit, LAST_DAY(d.tgl_tua) AS tgl1, d.ttl_penyesuaian
FROM tb_akun AS a
LEFT JOIN tb_relasi_akun AS b ON a.id_akun = b.id_relation_debit
LEFT JOIN (SELECT MIN(c.tgl) AS tgl_tua , sum(c.debit) as ttl_penyesuaian, c.id_akun FROM tb_jurnal AS c WHERE c.disesuaikan != 'Y' AND c.id_buku!= '4'  GROUP BY c.id_akun ) AS d ON d.id_akun = b.id_akun
WHERE b.id_relation_kredit = '$id_akun'"); ?>

<?php $month = date('m', strtotime($tgl_akhir->tgl1)) ?>

<?php $atk = DB::select("SELECT a.tgl, a.id_atk, a.no_nota, a.nm_barang, SUM(a.qty_debit) AS qty_debit , SUM(a.qty_kredit) AS qty_kredit,
        b.n, SUM(a.debit_atk) AS debit_atk, SUM(a.kredit_atk) AS kredit_atk
        FROM tb_atk AS a
        LEFT JOIN tb_satuan AS b ON b.id = a.id_satuan
        where Month(a.tgl) <= '$month'
        GROUP BY a.no_nota"); ?>
<div class="row">
    <div class="col-lg-12">
        <a href="<?= route("excel_atk", ['id_lokasi' => $id_lokasi]) ?>" class="btn btn-sm btn-info float-right">Export</a>
        <a href="<?= route("print_atk", ['id_lokasi' => $id_lokasi]) ?>" class="btn btn-sm btn-info float-right mr-2">Print</a>
    </div>
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Tanggal </label>
            <input class="form-control" type="date" id="tgl_atk" name="tgl_atk" value="<?= $tgl_akhir->tgl1 ?>" required>
        </div>
    </div>
    <div class="mt-3 ml-1">
        <p class="mt-4 ml-2 text-warning"><strong>Db</strong></p>
    </div>
    <div class="col-sm-3 col-md-3">
        <div class="form-group">
            <label for="list_kategori">Akun</label>
            <input class="form-control" type="text" value="Biaya atk dan perlengkapan" disabled>
            <input class="form-control" type="hidden" value="{{ $id_akunBiayaAtk }}" name="id_akun1">
        </div>
    </div>
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Debit </label>
            <input type="text" class="form-control ttl_atk " name="debit_atk" value="0" readonly>
        </div>
    </div>
    <div class="mt-3 ml-1">
        <p class="mt-4 ml-2 text-warning"><strong>Cr</strong></p>
    </div>
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Akun</label>
            <input class="form-control" type="text" value="atk & perlengkapan" disabled>
            <input class="form-control" type="hidden" name="metode1" value="{{ $id_akun }}">
        </div>
    </div>
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Credit</label>
            <input type="text" class="form-control ttl_atk" name="kredit_atk" value="0" readonly>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-2">
        <label for="">Tgl perolehan </label>
    </div>
    <div class="col-lg-2">
        <label for="">Barang</label>
    </div>
    <div class="col-lg-1">
        <label for="">Stok sisa</label>
    </div>
    <div class="col-lg-1">
        <label for="">Harga Satuan</label>
    </div>
    <div class="col-lg-2">
        <label for="">Total</label>
    </div>
    <div class="col-lg-2">
        <label for="">Stok aktual</label>
    </div>
    <div class="col-lg-2">
        <label for="">Total opname</label>
    </div>
</div>



<?php foreach ($atk as $a) : ?>
    <?php if ($a->qty_debit - $a->qty_kredit <= '0') : ?>
    <?php else : ?>
        <div class="row">
            <div class="col-lg-2 mb-2">
                <input type="text" class="form-control" value="<?= $a->tgl ?>" readonly>
            </div>
            <div class="col-lg-2 mb-2">
                <input type="text" class="form-control" name="barang_atk[]" value="<?= $a->nm_barang ?>" readonly>
            </div>
            <div class="col-lg-1 mb-2">
                <input type="text" class="form-control" value="<?= $a->qty_debit - $a->qty_kredit ?>" readonly>
            </div>
            <div class="col-lg-1 mb-2">
                <input type="text" class="form-control h_satuan<?= $a->id_atk ?>" value="<?= $a->debit_atk / $a->qty_debit  ?>" readonly>
            </div>
            <div class="col-lg-2 mb-2">
                <input type="text" class="form-control" value="<?= ($a->qty_debit - $a->qty_kredit) * ($a->debit_atk / $a->qty_debit)   ?>" readonly>
            </div>
            <div class="col-lg-2 mb-2">
                <input type="number" name="qty_kredit[]" max="<?= $a->qty_debit - $a->qty_kredit ?>" id_atk="<?= $a->id_atk ?>" class="form-control qty quantity<?= $a->id_atk ?>">
            </div>
            <div class="col-lg-2 mb-2">
                <input type="text" name="kredit_atk2[]" class="form-control ttl_op ttl1<?= $a->id_atk ?>" value="0" readonly>
                <input type="hidden" name="nota[]" class="form-control " value="<?= $a->no_nota ?>" readonly>
            </div>

        </div>
    <?php endif ?>


<?php endforeach ?>