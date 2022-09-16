<div class="row">
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Tanggal </label>
            <input class="form-control" type="date" name="tgl" value="<?= $debit->tgl ?>">

        </div>
    </div>
    <div class="mt-3 ml-1">
        <p class="mt-4 ml-2 text-warning"><strong>Db</strong></p>
    </div>
    <div class="col-sm-3 col-md-3">
        <div class="form-group">
            <label for="list_kategori">Akun</label>
            <select name="" id="" class="form-control" disabled>
                <?php foreach ($akun as $a) : ?>
                    <?php if ($a->id_akun == $debit->id_akun) : ?>
                        <option value="" selected><?= $a->nm_akun ?></option>
                    <?php else : ?>
                        <option value=""><?= $a->nm_akun ?></option>
                    <?php endif ?>
                <?php endforeach ?>

            </select>

        </div>
    </div>
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Debit </label>
            <input type="hidden" name="id_jurnal1" value="<?= $debit->id_jurnal ?>">
            <input type="number" class="form-control  peralatan" name="debit" value="<?= $debit->debit ?>" readonly>
        </div>
    </div>
    <div class="mt-3 ml-1">
        <p class="mt-4 ml-2 text-warning"><strong>Cr</strong></p>
    </div>
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Akun</label>
            <select name="" id="" class="form-control" disabled>
                <?php foreach ($akun as $a) : ?>
                    <?php if ($a->id_akun == $kredit->id_akun) : ?>
                        <option value="" selected><?= $a->nm_akun ?></option>
                    <?php else : ?>
                        <option value=""><?= $a->nm_akun ?></option>
                    <?php endif ?>
                <?php endforeach ?>

            </select>
        </div>
    </div>
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Credit</label>
            <input type="hidden" name="id_jurnal2" value="<?= $kredit->id_jurnal ?>">
            <input type="number" class="form-control  peralatan" name="kredit" value="<?= $kredit->kredit ?>">
        </div>
    </div>

</div>