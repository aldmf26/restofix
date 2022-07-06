<div>
    <label style="font-weight: bold;">Pendapatan</label>
</div>
<?php if (empty($penutup)) : ?>
    <div class="row">
        <div class="col-lg-12">
            <h4 class="text-center">Data pendapatan tidak ada</h4>
            <input type="hidden" name="tgl[]" value="">
            <?php $total = 0 ?>
        </div>
    </div>
<?php else : ?>
    <?php $total = 0;
    foreach ($penutup as $d) :
        $total += $d->kredit - $d->debit
    ?>
        <div class="row">
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Tanggal </label>
                    <input class="form-control" type="date" name="tgl[]" value="<?= $d->tgl ?>">
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="list_kategori">Akun</label>
                    <input class="form-control" type="text" value="<?= $d->nm_akun ?>" disabled>
                    <input class="form-control" type="hidden" value="<?= $d->id_akun ?>" name="id_akun[]">
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Debit </label>
                    <input type="text" class="form-control total_peralatan" readonly value="<?= $d->kredit - $d->debit ?>">
                </div>
            </div>
            <div class="col-sm-2 col-md-3">
                <div class="form-group">
                    <label for="list_kategori">Akun</label>
                    <input class="form-control" type="text" value="Ikhtisar laba rugi" disabled>
                    <input class="form-control" type="hidden" name="metode[]" value="{{ $id_lokasi == '1' ? '169' : '170' }}">
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Credit</label>
                    <input type="text" class="form-control total_aktiva tl_akv" detail='' value="<?= $d->kredit - $d->debit ?>" name="kredit[]" readonly>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>
<div class="row">
    <div class="col-lg-10">
        <label for="" class="float-right">TOTAL:</label>
    </div>
    <div class="col-lg-2">
        <label for=""><?= number_format($total) ?></label>
    </div>

</div>

<hr style=" border: 1px black solid;">
<div>
    <label style="font-weight: bold;">Biaya</label>
</div>
<?php if (empty($penutup_biaya)) : ?>
    <div class="row">
        <div class="col-lg-12">
            <h4 class="text-center">Data biaya tidak ada</h4>
            <?php $total2 = 0 ?>
        </div>
    </div>
<?php else : ?>

    <?php $total2 = 0;
    foreach ($penutup_biaya as $d) :
        $total2 += $d->debit
    ?>
        <div class="row">
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Tanggal </label>
                    <input class="form-control" type="date" name="tgl2[]" value="<?= $d->tgl ?>">
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="list_kategori">Akun</label>
                    <input class="form-control" type="text" value="Ikhtisar laba rugi" disabled>
                    <input class="form-control" type="hidden" value="{{ $id_lokasi == '1' ? '169' : '170' }}" name="id_akun2[]">
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Debit </label>
                    <input type="text" class="form-control total_peralatan" readonly value="<?= $d->debit ?>">
                </div>
            </div>
            <div class="col-sm-2 col-md-3">
                <div class="form-group">
                    <label for="list_kategori">Akun</label>
                    <input class="form-control" type="text" value="<?= $d->nm_akun ?>" disabled>
                    <input class="form-control" type="hidden" name="metode2[]" value="<?= $d->id_akun ?>">
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Credit</label>
                    <input type="text" class="form-control total_aktiva" detail='' value="<?= $d->debit ?>" name="kredit2[]" readonly>
                </div>
            </div>

        </div>
    <?php endforeach ?>
<?php endif ?>
<div class="row">
    <div class="col-lg-10">
        <label for="" class="float-right">TOTAL:</label>
    </div>
    <div class="col-lg-2">
        <label for=""><?= number_format($total2) ?></label>
    </div>


</div>
<hr style=" border: 1px black solid;">
<?php $laba = round($total - $total2) ?>

<div class="row">

    <div class="col-lg-2">
        <label for="">Pendapatan</label>
        <h5 style="font-weight: bold;"><?= number_format($total) ?></h5>
    </div>
    <div class="col-lg-3">
        <label for="">Biaya</label>
        <h5 style="font-weight: bold;">- &nbsp;&nbsp;<?= number_format($total2) ?></h5>
    </div>
    <div class="col-lg-3">
        <label for="">Total</label>
        <h5 style="font-weight: bold;">= &nbsp;&nbsp; <?= number_format($laba) ?></h5>
    </div>
</div>
<?php if (empty($modal)) : ?>
    <?php if ($laba > 0) : ?>
        <div class="row">
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Tanggal </label>
                    <input class="form-control" type="date" name="tgl3" value="<?= $d->tgl ?>">
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="list_kategori">Akun</label>
                    <input class="form-control" type="text" value="Ikhtisar laba rugi" disabled>
                    <input class="form-control" type="hidden" value="{{ $id_lokasi == '1' ? '169' : '170' }}" name="id_akun3">
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Debit </label>
                    <input type="text" class="form-control total_peralatan" readonly value="<?= $laba ?>">
                </div>
            </div>
            <div class="col-sm-2 col-md-3">
                <div class="form-group">
                    <label for="list_kategori">Akun</label>
                    <input class="form-control" type="text" value="<?= $neraca->nm_akun ?>" disabled>
                    <input class="form-control" type="hidden" name="metode3" value="<?= $neraca->id_akun ?>">
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Credit</label>
                    <input type="text" class="form-control total_aktiva" detail='' value="<?= $laba ?>" name="kredit3" readonly>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="row">
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Tanggal </label>
                    <input class="form-control" type="date" name="tgl3" value="<?= $d->tgl ?>">
                </div>
            </div>
            <div class="col-sm-2 col-md-3">
                <div class="form-group">
                    <label for="list_kategori">Akun</label>
                    <input class="form-control" type="text" value="<?= $neraca->nm_akun ?>" disabled>
                    <input class="form-control" type="hidden" name="id_akun3" value="<?= $neraca->id_akun ?>">
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Debit </label>
                    <input type="text" class="form-control total_peralatan" readonly value="<?= $laba * -1 ?>">
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="list_kategori">Akun</label>
                    <input class="form-control" type="text" value="Ikhtisar laba rugi" disabled>
                    <input class="form-control" type="hidden" value="{{ $id_lokasi == '1' ? '169' : '170' }}" name="metode3">
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Credit</label>
                    <input type="text" class="form-control total_aktiva" detail='' value="<?= $laba * -1 ?>" name="kredit3" readonly>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php else : ?>
    <?php if ($laba > 0) : ?>
        <div class="row">
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Tanggal </label>
                    <input class="form-control" type="date" name="tgl3" value="<?= $d->tgl ?>">
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="list_kategori">Akun</label>
                    <input class="form-control" type="text" value="Ikhtisar laba rugi" disabled>
                    <input class="form-control" type="hidden" value="{{ $id_lokasi == '1' ? '169' : '170' }}" name="id_akun3">
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Debit </label>
                    <input type="text" class="form-control total_peralatan" readonly value="<?= $laba ?>">
                </div>
            </div>
            <div class="col-sm-2 col-md-3">
                <div class="form-group">
                    <label for="list_kategori">Akun</label>
                    <input class="form-control" type="text" value="<?= $modal->nm_akun ?>" disabled>
                    <input class="form-control" type="hidden" name="metode3" value="<?= $modal->id_akun ?>">
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Credit</label>
                    <input type="text" class="form-control total_aktiva" detail='' value="<?= $laba ?>" name="kredit3" readonly>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="row">
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Tanggal </label>
                    <input class="form-control" type="date" name="tgl3" value="<?= $d->tgl ?>">
                </div>
            </div>
            <div class="col-sm-2 col-md-3">
                <div class="form-group">
                    <label for="list_kategori">Akun</label>
                    <input class="form-control" type="text" value="<?= $modal->nm_akun ?>" disabled>
                    <input class="form-control" type="hidden" name="id_akun3" value="<?= $modal->id_akun ?>">
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Debit </label>
                    <input type="text" class="form-control total_peralatan" readonly value="<?= $laba * -1 ?>">
                </div>
            </div>

            <div class="col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="list_kategori">Akun</label>
                    <input class="form-control" type="text" value="Ikhtisar laba rugi" disabled>
                    <input class="form-control" type="hidden" value="{{ $id_lokasi == '1' ? '169' : '170' }}" name="metode3">
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label for="list_kategori">Credit</label>
                    <input type="text" class="form-control total_aktiva" detail='' value="<?= $laba * -1 ?>" name="kredit3" readonly>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php endif ?>


<div class="row">
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Tanggal </label>
            <input class="form-control" type="date" name="tgl4" value="<?= $d->tgl ?>">
        </div>
    </div>
    <div class="col-sm-3 col-md-3">
        <div class="form-group">
            <label for="list_kategori">Akun</label>
            <input class="form-control" type="text" value="Modal" disabled>
            <input class="form-control" type="hidden" value="{{ $id_lokasi == '1' ? '147' : '168' }}" name="id_akun4">
        </div>
    </div>
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Debit </label>
            <input type="text" class="form-control  prive" value="">
        </div>
    </div>
    <div class="col-sm-2 col-md-3">
        <div class="form-group">
            <label for="list_kategori">Akun</label>
            <input class="form-control" type="text" value="Prive" disabled>
            <input class="form-control" type="hidden" name="metode4" value="{{ $id_lokasi == '1' ? '171' : '172' }}">
        </div>
    </div>
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            <label for="list_kategori">Credit</label>
            <input type="text" class="form-control  prive" detail='' value="" name="kredit4">
        </div>
    </div>
</div>
