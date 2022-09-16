
<div>
    <label style="font-weight: bold;"> Aktiva</label>
</div>
<?php if (date("Y-m-d") < $tgl_max) : ?>
    <?php $ttl2 = '0' ?>
<?php else : ?>
    <?php $ttl2 = 0;
    foreach ($aktiva as $a) :
        if (number_format(($a->debit_aktiva - $a->kredit2), 0) > '0') {
            $ttl2 += $a->b_penyusutan;
        } else {
        }
    ?>
    <?php endforeach ?>
<?php endif ?>
<div class="row">
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Tanggal </label>
            <input class="form-control" type="date" id="tgl_akv" name="tgl_akv" value="<?= $tgl_max ?>" required>
        </div>
    </div>
    <div class="mt-3 ml-1">
        <p class="mt-4 ml-2 text-warning"><strong>Db</strong></p>
    </div>
    <div class="col-sm-3 col-md-3">
        <div class="form-group">
            <label for="list_kategori">Akun</label>
            <input class="form-control" type="text" value="Beban Depresiasi penyusutan aktiva" disabled>
            <input class="form-control" type="hidden" value="{{ $id_akunBDPA }}" name="id_akun1">
        </div>
    </div>
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Debit </label>
            <input type="text" class="form-control ttl " name="debit_akv" value="<?= $ttl2 ?>" readonly>
        </div>
    </div>
    <div class="mt-3 ml-1">
        <p class="mt-4 ml-2 text-warning"><strong>Cr</strong></p>
    </div>
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Akun</label>
            <input class="form-control" type="text" value="Akumulasi penyusutan aktiva" disabled>
            <input class="form-control" type="hidden" name="metode1" value="{{ $id_akunAPP }}">
        </div>
    </div>
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Credit</label>
            <input type="text" class="form-control ttl" name="kredit_akv" value="<?= $ttl2 ?>" readonly>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-3">
        <label for="">Tanggal perolehan </label>
    </div>
    <div class="col-lg-3">
        <label for="">Barang</label>
    </div>
    <div class="col-lg-3">
        <label for="">Nilai Buku</label>
    </div>
    <div class="col-lg-3">
        <label for="">Biaya Penyusutan </label>
    </div>
</div>

<div id="barang"></div>
<div id="barang2">
    <?php if (date("Y-m-d") < $tgl_max) : ?>
    <?php else : ?>
        <?php foreach ($aktiva as $a) : ?>
            <?php if (number_format(($a->debit_aktiva - $a->kredit2), 0) > '0') : ?>

                <div class="row">
                    <div class="col-lg-2 mb-2">
                        <input type="date" class="form-control" value="<?= $a->tgl ?>" readonly>
                    </div>
                    <div class="col-lg-3 mb-2">
                        <input type="text" name="nm_barang[]" class="form-control" value="<?= $a->barang ?>" readonly>
                        <input type="hidden" name="barang[]" class="form-control" value="<?= $a->nota ?>">
                    </div>
                    <div class="col-lg-3 mb-2">
                        <input type="text" class="form-control" value="<?= $a->debit_aktiva - $a->kredit2 ?>" readonly>
                    </div>
                    <div class="col-lg-3 mb-2">
                        <input type="text" name="biaya_akv[] " class="form-control akt" value="<?= $a->b_penyusutan ?>">
                    </div>
                </div>
            <?php else : ?>
            <?php endif ?>
        <?php endforeach ?>
    <?php endif ?>
</div>