@extends('accounting.template.master')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">

                </div>

            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('accounting.template.flash')
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Data Neraca setelah penutup Saldo ~ <?= $bulan ?>-<?= $tahun ?></h3>
                        <a href="" class="btn btn-info float-right" data-target="#view_bulan" data-toggle="modal">View bulan</a>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card-body">
                                <table class="table table-bordered table-sm mt-2" id="neraca_saldo">
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="text-align: center;">Aktiva</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <dt>Aktiva lancar</dt>
                                            </td>
                                        </tr>
                                        <?php $total_al = 0;
                                        foreach ($aktiva_lancar as $a) :
                                            $total_al += $a->debit - $a->kredit;
                                        ?>
                                            <tr>
                                                <td><?= $a->nm_akun ?></td>
                                                <td>Rp. <?= number_format($a->debit - $a->kredit, 0) ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <dt>Jumlah Aktiva Lancar</dt>
                                            </td>
                                            <td>Rp. <?= number_format($total_al, 0) ?></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <dt>Aktiva Tetap</dt>
                                            </td>
                                        </tr>
                                        <?php
                                        $total_at = 0;
                                        foreach ($aktiva_tetap as $at) :
                                            $total_at += $at->debit - $at->kredit;
                                        ?>
                                            <tr>
                                                <td><?= $at->nm_akun ?></td>
                                                <td>Rp. <?= number_format($at->debit - $at->kredit, 0) ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr>
                                            <td>
                                                <dt>Jumlah Aktiva tetap</dt>
                                            </td>
                                            <td>
                                                <dt>Rp. <?= number_format($total_at, 0) ?></dt>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <dt>Jumlah Aktiva</dt>
                                            </td>
                                            <td>
                                                <dt>Rp. <?= number_format($total_al + $total_at, 0) ?></dt>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body">
                                <table class="table table-bordered table-sm mt-2" id="neraca_saldo">
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="text-align: center;">Passiva</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <dt>Hutang</dt>
                                            </td>
                                        </tr>
                                        <?php $total_h = 0;
                                        foreach ($hutang as $a) :
                                            $total_h += $a->kredit - $a->debit;
                                        ?>
                                            <tr>
                                                <td><?= $a->nm_akun ?></td>
                                                <td>Rp. <?= number_format($a->kredit - $a->debit, 0) ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <dt>Total Kewajiban Lancar</dt>
                                            </td>
                                            <td>Rp. <?= number_format($total_h, 0) ?></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <dt>Ekuitas</dt>
                                            </td>
                                        </tr>
                                        <?php
                                        $total_m = 0;
                                        foreach ($modal as $m) :
                                            $total_m += $m->kredit - $m->debit;
                                        ?>
                                            <tr>
                                                <td><?= $m->nm_akun ?></td>
                                                <td>Rp. <?= number_format($m->kredit - $m->debit, 0) ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr>
                                            <td>
                                                <dt>Total Ekuitas</dt>
                                            </td>
                                            <td>
                                                <dt>Rp. <?= number_format($total_m, 0) ?></dt>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <dt>Jumlah Passiva</dt>
                                            </td>
                                            <td>
                                                <dt>Rp. <?= number_format($total_h + $total_m, 0) ?></dt>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>

            </div>




        </div>
    </section>
</div>


<!-- Modal Tambah -->
<form action="" method="GET">
    <div class="modal fade" id="view_bulan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Neraca Saldo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="acc" value="{{ Request::get('acc') }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">Bulan</label>
                            <select name="month" id="" class="form-control select2bs4">
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Tahun</label>
                            <select name="year" id="" class="form-control select2bs4">
                                <?php foreach ($s_tahun as $t) : ?>
                                    <?php $tanggal = $t->tgl;
                                    $explodetgl = explode('-', $tanggal); ?>
                                    <option value="<?= $explodetgl[0]; ?>"><?= $explodetgl[0]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection