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
                <div class="col-lg-10">

                    @include('accounting.template.flash')

                    <?php
                    $bulan = ['bulan', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    $bulan1 = (int)$month;
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="float-left">Laporan Laba / Rugi <?= $bulan[$bulan1] ?> <?= $year ?></h4>
                            <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#view-periode"><i class="fa fa-eye"></i> Lihat Data Perbulan</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#view-tanggal"><i class="fa fa-eye"></i> Lihat Data Pertanggal</button>
                            <a href="<?= route('printLabaRugi', ['acc' => Request::get('acc')]) ?>&month=<?= $month ?>&year=<?= $year ?>" class="btn btn-sm btn-outline-secondary float-right mr-2"><i class="fas fa-print"></i> Print</a>
                            <a href="<?= route('excelLabaRugi', ['acc' => Request::get('acc')]) ?>&month=<?= $month ?>&year=<?= $year ?>" class="btn btn-sm btn-outline-secondary float-right mr-2"><i class="fas fa-file-export"></i> Export</a>
                        </div>
                        <?php $i = 1; ?>
                        <?php $pph = 0; ?>
                        <?php $total_pendapatan_bunga = 0; ?>
                        <div class="card-body">
                            <table class="table table-sm table-sm table-bordered">
                                <tbody>
                                    <tr>
                                        <td colspan="6"><strong>URAIAN</strong></td>
                                    </tr>
                                    <tr style="border-top: 2px solid black;">
                                        <td colspan="6"><strong>PEREDARAN USAHA</strong></td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <?php $total_pendapatan = 0;
                                    foreach ($penutup as $p) :
                                        $total_pendapatan += $p->kredit;
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td colspan="2"><?= $p->nm_akun ?></td>
                                            <td>Rp</td>
                                            <td style="text-align: right;"><?= number_format($p->kredit, 0) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                    <tr style="border-bottom: 2px solid black;">
                                        <td width="10%"></td>
                                        <td colspan="2"><strong>TOTAL PENDAPATAN</strong></td>
                                        <td>Rp</td>
                                        <td style="text-align: right;"><strong><?= number_format($total_pendapatan, 0) ?></strong></td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr style="border-top: 2px solid black;">
                                        <td colspan="6"><strong>BIAYA BIAYA</strong></td>
                                    </tr>
                                    <?php $total_biaya = 0;
                                    foreach ($penutup_biaya as $p) :
                                        $total_biaya += $p->debit;
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td colspan="2"><?= $p->nm_akun ?></td>
                                            <td>Rp</td>
                                            <td style="text-align: right;"><?= number_format($p->debit, 0) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>

                                <tbody>
                                    <tr>
                                        
                                        <td colspan="3"><strong>TOTAL BIAYA</strong></td>
                                        <td>Rp</td>
                                        <td style="text-align: right;"><strong><?= number_format($total_biaya, 0) ?></strong></td>
                                       
                                    </tr>
                                    <tr>
                                        <td colspan="3"><strong>LABA BERSIH SEBELUM PAJAK</strong></td>
                                        <td>Rp</td>
                                        <td style="text-align: right;"><strong><?= number_format($total_pendapatan - $total_biaya, 0) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">PPH TERHUTANG (-)</td>
                                        <td>Rp</td>
                                        <td style="text-align: right;"><?= number_format($pph, 0) ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><strong>LABA BERSIH SETELAH PAJAK</strong></td>
                                        <td>Rp</td>
                                        <td style="text-align: right;"><strong><?= number_format($total_pendapatan - $total_biaya - $pph, 0) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">PENDAPATAN BANK (+)</td>
                                        <td>Rp</td>
                                        <td style="text-align: right;"><?= number_format($total_pendapatan_bunga, 0) ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><strong>LABA BERSIH</strong></td>
                                        <td>Rp</td>
                                        <td style="text-align: right;"><strong><?= number_format($total_pendapatan - $total_biaya - $pph + $total_pendapatan_bunga, 0) ?></strong></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>


                    </div>
                </div>
            </div>


        </div>
    </section>
</div>
<form action="{{ route('labaRugi', ['acc' => Request::get('acc')]) }}" method="GET">
    <div class="modal fade" id="view-periode" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat data perperiode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="acc" value="{{ Request::get('acc') }}">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="list_kategori">Akun</label>
                                <select name="month" class="form-control" required="">
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
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="list_kategori">Tahun</label>
                                <select name="year" class="form-control select" required="">
                                    <?php foreach ($tahun as $t) : ?>
                                        <?php $tanggal = $t->tgl;
                                        $explodetgl = explode('-', $tanggal); ?>
                                        <option value="<?= $explodetgl[0]; ?>"><?= $explodetgl[0]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Lihat</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="" method="GET">
    <div class="modal fade" id="view-tanggal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-costume">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat data perperiode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="acc" value="{{ Request::get('acc') }}">
                        <div class="form-group col-12 col-md-6">
                            <label>Dari</label>
                            <input type="date" name="tgl1" class="form-control" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>Sampai</label>
                            <input type="date" name="tgl2" class="form-control" required>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Lihat</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection