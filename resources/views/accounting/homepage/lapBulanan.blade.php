@extends('accounting.template.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="float-left">Laporan Perbulan</h4>
                            <a class="btn btn-sm btn-outline-secondary float-right ml-2" href="<?= route('excelLapBulanan', ['id_lokasi' => Request::get('acc')]) ?>"><i class="fas fa-file-export"></i> Export</a>
                            <a data-toggle="modal" data-target="#Export_all" class="btn btn-sm btn-outline-secondary float-right ml-2" href="#"><i class="fas fa-file-export"></i> Export All</a>
                            <a class="btn btn-sm btn-outline-secondary float-right ml-2" data-target="#import" data-toggle="modal" href="#">Import Pemasukan</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5"></div>
                                <div class="col-5"></div>
                                <div class="col-2">
                                    <label class="float-left"><input type="search" class="form-control form-control-sm" placeholder="Search.." id="search_bulanan"></label>
                                </div>
                            </div>

                            <style>
                                .scroll {
                                    overflow-x: auto;
                                    height: 450px;
                                    overflow-y: scroll;
                                }

                            </style>
                            <style>
                                .modal {
                                    position: fixed;
                                    top: 0;
                                    left: 0;
                                    z-index: 1050;
                                    display: none;
                                    width: 100%;
                                    height: 100%;
                                    overflow: hidden;
                                    outline: 0;
                                }

                            </style>

                            <div class="scroll">
                                <table class="table table-sm table-bordered" style="font-size: 12px;">
                                    <thead>
                                        <tr style="">
                                            <th style="position: sticky; top:0; left: 0; z-index: 1030; background-color: rgb(175, 184, 187)">
                                                Akun</th>
                                            <?php foreach ($periode as $key => $value) : ?>
                                           
                                            <th class="sticky-top th-atas-bulanan" style="background-color: rgb(175, 184, 187)">
                                                <?= date('M-Y', strtotime($value->tgl)) ?>
                                            </th>
                                            <?php endforeach ?>
                                            <th class="sticky-top th-atas-bulanan" style="background-color: rgb(175, 184, 187)">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tb_bulanan">
                                        <tr>
                                            <td style="color: white; background-color: #435c77;position: sticky; left: 0; z-index: 1020;">
                                                <dt>Pemasukan</dt>
                                            </td>
                                            <td colspan="30" style="color: white; background-color: #435c77;"></td>
                                        </tr>
                                        <?php foreach ($akun_pendapatan as $ap) : ?>
                                        <tr>
                                            <td style="position: sticky; left: 0; z-index: 1020; background-color: #FFFFFF;">
                                                <?= $ap->nm_akun ?>
                                            </td>
                                            <?php $t_pemasukan = 0;
                                        foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $neraca_pendapatan = DB::select("SELECT * FROM tb_laba_rugi_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_lokasi = '$id_lokasi'");
                                                $nmTbl = count($neraca_pendapatan) < 1 ? 'tb_jurnal' : 'tb_laba_rugi_penutup';
                                               
                                                $sum = $nmTbl == 'tb_jurnal' ? "SUM(debit) as debit, SUM(kredit) as kredit" : '*';
                                                $pen = DB::selectOne("SELECT SUM(a.debit) AS debit , SUM(a.kredit) AS kredit FROM $nmTbl as a where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = $month and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");
                                                // if(count($neraca_pendapatan) < 1) {
                                                //     $pen = DB::select("SELECT SUM(a.debit) AS debit_saldo , SUM(a.kredit) AS kredit_saldo
                                                //         FROM tb_jurnal AS a
                                                //         WHERE a.id_akun = '$ap->id_akun' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' 
                                                //         GROUP BY a.id_akun");
                                                // } else {
                                                //     $pen = DB::selectOne("SELECT * FROM tb_laba_rugi_penutup as a where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = $month and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");
                                                // }
                                                
                                                $t_pemasukan += empty($pen->kredit) ? '0' : $pen->kredit;
                                                ?>
                                            <td><a href="#" class="btn_detail" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>">
                                                    <?= empty($pen->kredit) ? '0' : number_format($pen->kredit, 0) ?>
                                                </a></td>

                                            <?php endforeach; ?>
                                            <td>
                                                <?= number_format($t_pemasukan, 0) ?>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>

                                        <tr>
                                            <td style="color: white; background-color: #435c77; position: sticky; left: 0; z-index: 999;">
                                                <strong>Total Penjualan</strong>
                                            </td>
                                            <?php
                $total_pendapatan = 0;
                foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $neraca_pendapatan = DB::select("SELECT * FROM tb_laba_rugi_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_lokasi = '$id_lokasi'");
                                                $nmTbl = count($neraca_pendapatan) < 1 ? 'tb_jurnal' : 'tb_laba_rugi_penutup';
                                                $ttl = DB::selectOne("SELECT sum(a.kredit) as kredit_saldo FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='21' ");
                                                ?>
                                            <td style="color: white; background-color: #435c77;"><strong>
                                                    <?= empty($ttl->kredit_saldo) ? '0' : number_format($ttl->kredit_saldo, 0) ?>
                                                </strong></td>

                                            <?php $total_pendapatan += empty($ttl->kredit_saldo) ? '0' : $ttl->kredit_saldo;
                                            endforeach; ?>
                                            <td style="color: white; background-color: #435c77;">
                                                <?= number_format($total_pendapatan, 0) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="30"></td>
                                        </tr>
                                        <tr>
                                            <td style="color: white; background-color: #435c77; position: sticky; left: 0; z-index: 1020;">
                                                <dt>Biaya disesuaikan </dt>
                                            </td>
                                            <td colspan="30" style="color: white; background-color: #435c77;"></td>
                                        </tr>

                                        <?php foreach ($akun_pengeluaran as $ap) : ?>
                                        <tr>

                                            <td style="width:10%;position: sticky; left: 0; z-index: 1020; background-color: #FFFFFF;">
                                                <?= $ap->nm_akun ?>
                                            </td>
                                            <?php $t_pengeluaran = 0;
                    foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $neraca_pendapatan = DB::select("SELECT * FROM tb_laba_rugi_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_lokasi = '$id_lokasi'");
                                                $nmTbl = count($neraca_pendapatan) < 1 ? 'tb_jurnal' : 'tb_laba_rugi_penutup';
                                                $sum = $nmTbl == 'tb_jurnal' ? "a.id_akun, sum(a.debit - a.kredit) as debit, sum(a.kredit) as kredit" : '*';
                                                $jml = DB::selectOne("SELECT $sum FROM $nmTbl as a where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = $month and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");
                                                
                                                $t_pengeluaran += empty($jml->debit) ? '0' : $jml->debit;
                                                ?>
                                                @if (empty($jml))
                                                <td><?= empty($jml->debit) ? '0' : number_format($jml->debit, 0) ?> </td>
                                                @else
                                                <td><a href="#" class="btn_detail" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>">
                                                        <?= empty($jml->debit) ? '0' : number_format($jml->debit, 0) ?> 
                                                    </a></td>
                                                @endif

                                            <?php endforeach; ?>
                                            <td>
                                                <?= number_format($t_pengeluaran, 0) ?>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                        <tr>
                                            <td style="color: white; background-color: #435c77; white-space: nowrap; position: sticky; left: 0; z-index: 1020;">
                                                <strong>Total Biaya disesuaiakan</strong>
                                            </td>
                                            <?php $total_biaya = 0;
                foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $neraca_pendapatan = DB::select("SELECT * FROM tb_laba_rugi_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_lokasi = '$id_lokasi'");
                                                $nmTbl = count($neraca_pendapatan) < 1 ? 'tb_jurnal' : 'tb_laba_rugi_penutup';
                                                $sum = $nmTbl == 'tb_jurnal' ? "sum(a.debit - a.kredit) as debit_saldo" : 'sum(a.debit) as debit_saldo';
                                                $ttl = DB::selectOne("SELECT $sum FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='22' "); ?>
                                            <td style="color: white; background-color: #435c77;">
                                                <?= number_format($ttl->debit_saldo, 0) ?>
                                            </td>
                                            <?php $total_biaya += $ttl->debit_saldo;
                endforeach ?>
                                            <td style="color: white; background-color: #435c77;">
                                                <?= number_format($total_biaya, 0) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="30"></td>
                                        </tr>
                                        <tr>
                                            <td style="color: white; background-color: #435c77;position: sticky; left: 0; z-index: 1020;">
                                                <dt>Biaya Utama</dt>
                                            </td>
                                            <td style="color: white; background-color: #435c77;" colspan="30"></td>
                                        </tr>

                                        <?php foreach ($akun_biaya_fix as $ap) :
            ?>
                                        <tr>
                                            <td style="width:10%;position: sticky; left: 0; z-index: 1020; background-color: #FFFFFF;">
                                                <?= $ap->nm_akun ?>
                                            </td>
                                            <?php $t_pengeluaran = 0;
                    foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $neraca_pendapatan = DB::select("SELECT * FROM tb_laba_rugi_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_lokasi = '$id_lokasi'");
                                                $nmTbl = count($neraca_pendapatan) < 1 ? 'tb_jurnal' : 'tb_laba_rugi_penutup';
                                                $sum = $nmTbl == 'tb_jurnal' ? "a.id_akun, SUM(a.debit - a.kredit) as debit" : 'a.*';
                                                $jml = DB::selectOne("SELECT $sum FROM $nmTbl as a where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = $month and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");
                                           
                                                $t_pengeluaran += empty($jml->debit) ? '0' : $jml->debit;
                                                ?>
                                            <td>
                                                <a href="#" class="btn_detail" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>">
                                                    <?= empty($jml->debit) ? 0 : number_format($jml->debit, 0) ?>
                                                </a>
                                            </td>

                                            <?php endforeach; ?>
                                            <td>
                                                <?= number_format($t_pengeluaran, 0) ?>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>


                                        <tr>
                                            <td style="color: white; background-color: #435c77; white-space: nowrap;position: sticky; left: 0; z-index: 1020;">
                                                <strong>Total Biaya Utama</strong>
                                            </td>
                                            <?php $total_biaya1 = 0;
                foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $neraca_pendapatan = DB::select("SELECT * FROM tb_laba_rugi_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_lokasi = '$id_lokasi'");
                                                $nmTbl = count($neraca_pendapatan) < 1 ? 'tb_jurnal' : 'tb_laba_rugi_penutup';
                                                $sum = $nmTbl == 'tb_jurnal' ? "sum(a.debit - a.kredit) as debit_saldo" : 'sum(a.debit) as debit_saldo';
                                                $ttl = DB::selectOne("SELECT $sum FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' and month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='23' "); ?>
                                                                   
                                            <td style="color: white; background-color: #435c77;">
                                                <?= number_format($ttl->debit_saldo, 0) ?>
                                            </td>
                                            <?php $total_biaya1 += empty($ttl->debit_saldo) ? '0' : $ttl->debit_saldo;
                endforeach ?>
                                            <td style="color: white; background-color: #435c77;">
                                                <?= number_format($total_biaya1, 0) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="30"></td>
                                        </tr>
                                        <tr>
                                            <td style="color: white; background-color: #435c77; white-space: nowrap;position: sticky; left: 0; z-index: 1020;">
                                                <dt>Laporan Laba Rugi</dt>
                                            </td>
                                            <td colspan="30" style="color: white; background-color: #435c77;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:10%;position: sticky; left: 0; z-index: 1020; background-color: #FFFFFF;">
                                                Laba bersih sebelum pajak</td>
                                            <?php $t_laba = 0;
                foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $neraca_pendapatan = DB::select("SELECT * FROM tb_laba_rugi_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_lokasi = '$id_lokasi'");
                                                $nmTbl = count($neraca_pendapatan) < 1 ? 'tb_jurnal' : 'tb_laba_rugi_penutup';
                                                $sumDebit = $nmTbl == 'tb_jurnal' ? "sum(a.debit - a.kredit) as debit_saldo" : 'sum(a.debit) as debit_saldo';
                                                $sumKredit = $nmTbl == 'tb_jurnal' ? "sum(a.kredit - a.debit) as kredit_saldo" : 'sum(a.kredit) as kredit_saldo';
                                                $ttl = DB::selectOne("SELECT $sumDebit FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' AND  month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='23' ");
                                                $ttl2 = DB::selectOne("SELECT $sumDebit FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' AND  month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='22' ");
                                                $ttl3 = DB::selectOne("SELECT $sumKredit FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='21' "); ?>
                                            <?php $t_laba += $ttl3->kredit_saldo - ($ttl->debit_saldo + $ttl2->debit_saldo); ?>
                                            <td>
                                                <?= number_format($ttl3->kredit_saldo - ($ttl->debit_saldo + $ttl2->debit_saldo), 0) ?>
                                            </td>
                                            <?php endforeach ?>
                                            <td>
                                                <?= number_format($t_laba, 0) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:10%;position: sticky; left: 0; z-index: 1020; background-color: #FFFFFF;">
                                                PPH Terhutang(-)</td>
                                            <?php

                $pph_hutang = []; 
                foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $neraca_pendapatan = DB::select("SELECT * FROM tb_laba_rugi_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_lokasi = '$id_lokasi'");
                                                $nmTbl = 'tb_jurnal';
                                                $jml = DB::selectOne("SELECT sum(a.debit) as debit, SUM(a.kredit) as kredit FROM $nmTbl as a
                                                                            LEFT JOIN tb_akun as b ON a.id_akun = b.id_akun
                                                                            WHERE a.id_lokasi = '$id_lokasi' AND b.ppn_hutang = 'Y' and b.id_kategori != '7' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");
                                                $pph_hutang[] = $jml->debit - $jml->kredit;
                                                $jml_pph = $jml->debit - $jml->kredit;
                                                ?>

                                            <?php endforeach; ?>
                                            <?php $pph = 0;
                foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $neraca_pendapatan = DB::select("SELECT * FROM tb_laba_rugi_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_lokasi = '$id_lokasi'");
                                                $nmTbl = 'tb_jurnal';
                                                $ttl = DB::selectOne("SELECT sum(a.debit) as debit, SUM(a.kredit) as kredit FROM $nmTbl as a
                                                                                LEFT JOIN tb_permission_akun as b ON a.id_akun = b.id_akun
                                                                                WHERE a.id_lokasi = '$id_lokasi' AND  b.id_sub_menu_akun = '23' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");

                                                $ttl2 = DB::selectOne("SELECT sum(a.debit) as debit, SUM(a.kredit) as kredit FROM $nmTbl as a LEFT JOIN tb_permission_akun as b ON a.id_akun = b.id_akun WHERE a.id_lokasi = '$id_lokasi' AND  b.id_sub_menu_akun = '21' AND a.id_buku = '1' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");

                                                $ttl3 = DB::selectOne("SELECT sum(a.debit) as debit, SUM(a.kredit) as kredit FROM $nmTbl as a LEFT JOIN tb_permission_akun as b ON a.id_akun = b.id_akun WHERE a.id_lokasi = '$id_lokasi' AND  b.id_sub_menu_akun = '22' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");
                                                
                                                ?>
                                            <td>0</td>
                                            <?php endforeach ?>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td style="width:10%;position: sticky; left: 0; z-index: 1020; background-color: #FFFFFF;">
                                                Laba bersih setelah pajak</td>
                                            <?php $laba = 0;
                foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $neraca_pendapatan = DB::select("SELECT * FROM tb_laba_rugi_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_lokasi = '$id_lokasi'");
                                                $nmTbl = count($neraca_pendapatan) < 1 ? 'tb_jurnal' : 'tb_laba_rugi_penutup';
                                                $sumDebit = $nmTbl == 'tb_jurnal' ? "sum(a.debit - a.kredit) as debit_saldo" : 'sum(a.debit) as debit_saldo';
                                                $sumKredit = $nmTbl == 'tb_jurnal' ? "sum(a.kredit - a.debit) as kredit_saldo" : 'sum(a.kredit) as kredit_saldo';
                                                $ttl = DB::selectOne("SELECT $sumDebit FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' AND  month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='23' ");
                                                $ttl2 = DB::selectOne("SELECT $sumDebit FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' AND  month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='22' ");
                                                $ttl3 = DB::selectOne("SELECT $sumKredit FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' AND  month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='21' "); 
                                                                    $laba += $ttl3->kredit_saldo - ($ttl->debit_saldo + $ttl2->debit_saldo);
                                                            ?>
                                            <td>
                                                <?= number_format($ttl3->kredit_saldo - ($ttl->debit_saldo + $ttl2->debit_saldo), 0) ?>
                                            </td>
                                            <?php endforeach ?>
                                            <td>
                                                <?= number_format($laba, 0) ?> 
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="width:10%;position: sticky; left: 0; z-index: 1020; background-color: #FFFFFF;">
                                                Pendapatan Bank(+)</td>
                                            <?php
                $pendapatan_bank = [];
                foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $jml = DB::selectOne("SELECT sum(a.debit) as debit, SUM(a.kredit) as kredit FROM `tb_jurnal` as a
                                                                    LEFT JOIN tb_akun as b ON a.id_akun = b.id_akun
                                                                    WHERE a.id_lokasi = '$id_lokasi' AND b.pendapatan_bank = 'Y' AND b.id_kategori != '7' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");
                                                
                                                $pendapatan_bank[] = $jml->debit - $jml->kredit;
                                                $jml_pph = $jml->debit - $jml->kredit;
                                                ?>
                                            <td>
                                                <?= number_format($jml_pph, 0) ?>
                                            </td>
                                            <?php endforeach; ?>
                                            <td>0</td>
                                        </tr>
                                        <tr>

                                            <td style="color: white; background-color: #435c77; white-space: nowrap;position: sticky; left: 0; z-index: 1020;">
                                                <strong>Laba bersih</strong>
                                            </td>
                                            <?php $laba_bersih = 0;
                foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $neraca_pendapatan = DB::select("SELECT * FROM tb_laba_rugi_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_lokasi = '$id_lokasi'");
                                                $nmTbl = count($neraca_pendapatan) < 1 ? 'tb_jurnal' : 'tb_laba_rugi_penutup';
                                                $sumDebit = $nmTbl == 'tb_jurnal' ? "sum(a.debit - a.kredit) as debit_saldo" : 'sum(a.debit) as debit_saldo';
                                                $sumKredit = $nmTbl == 'tb_jurnal' ? "sum(a.kredit - a.debit) as kredit_saldo" : 'sum(a.kredit) as kredit_saldo';

                                                $ttl = DB::selectOne("SELECT $sumDebit FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='23'");
                                                $ttl2 = DB::selectOne("SELECT $sumDebit FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='22' ");
                                                $ttl3 = DB::selectOne("SELECT $sumKredit FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='21' "); 
                                                                    
                                                                    ?>
                                            <td style="color: white; background-color: #435c77; white-space: nowrap;">
                                                <?= number_format($ttl3->kredit_saldo - ($ttl->debit_saldo + $ttl2->debit_saldo), 0) ?>
                                            </td> 
                                            @php
                                                $laba = $laba == 0 ? $ttl3->kredit_saldo - ($ttl->debit_saldo + $ttl2->debit_saldo) : $laba;   
                                            @endphp
                                            <?php endforeach ?>
                                            <td style="color: white; background-color: #435c77; white-space: nowrap;">
                                                <?= number_format($laba, 0) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="30"></td>
                                        </tr>
                                        <tr>
                                            <td style="color: white; background-color: #435c77; position: sticky; left: 0; z-index: 1020;">
                                                <dt>Asset</dt>
                                            </td>
                                            <td colspan="30" style="color: white; background-color: #435c77;"></td>
                                        </tr>
                                        <?php

            foreach ($akun_aktiva as $ap) :
                $jumlah_aktiva = 0;
            ?>
                                        <tr>
                                            <td style="width:10%;position: sticky; left: 0; z-index: 1020; background-color: #FFFFFF;">
                                                <?= $ap->nm_akun ?>
                                            </td>
                                            <?php
                    foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $tgl_akhir = date('Y-m-t', strtotime($pd->tgl));

                                                $neraca_pendapatan = DB::select("SELECT * FROM tb_neraca_saldo_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_lokasi = '$id_lokasi'");
                                                $nmTbl = count($neraca_pendapatan) < 1 ? 'tb_jurnal' : 'tb_neraca_saldo_penutup';
                                                $sum = $nmTbl == 'tb_jurnal' ? "SUM(debit) as debit, SUM(kredit) as kredit" : '*';

                                                $saldo = DB::selectOne("SELECT $sum FROM $nmTbl as a where a.id_lokasi = '$id_lokasi' AND  month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");

                                                $saldo_prev = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where a.id_lokasi = '$id_lokasi' AND  month(a.tgl) < '$month' and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun' ORDER BY a.tgl DESC LIMIT 1");

                                                $saldoSebelum = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where a.id_lokasi = '$id_lokasi' AND  month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun' ORDER BY a.tgl DESC LIMIT 1");
                                                ?>
                                            <td>
                                                @php
                                                    $jurnal = DB::selectOne("SELECT a.id_akun, b.nm_akun, SUM(a.debit) AS debit , SUM(a.kredit) AS kredit 
                                                            FROM tb_jurnal AS a
                                                            LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
                                                            LEFT JOIN tb_permission_akun AS c ON c.id_akun = a.id_akun
                                                            WHERE a.id_akun = '$ap->id_akun' and  a.tgl BETWEEN '2022-01-01' AND '$tgl_akhir' AND c.id_sub_menu_akun ='25'
                                                            GROUP BY a.id_akun");
                                                @endphp
                                                <?php if (empty($saldo)) : ?>
                                                
                                                <a href="#" class="btn_detail" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>">
                                                    <?= empty($jurnal->id_akun) ? 0 : number_format($jurnal->debit - $jurnal->kredit, 0)  ?> </a>
                                                <?php else : ?>
                                                @php
                                                $tot = $saldo->debit - $saldo->kredit;
                                                @endphp
                                                <a href="#" class="btn_detail" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>">
                                                    <?= empty($saldo->debit)  ? 0 : number_format($jurnal->debit - $jurnal->kredit, 0) ?>
                                                </a>
                                                <?php endif ?>

                                            </td>

                                            <?php
                                                $tl_saldo = 0;
                                                $jumlah_aktiva = empty($saldo_prev->debit) ? 0 : $saldo_prev->debit - $saldo_prev->kredit;
                                        endforeach; ?>

                                        <?php if (empty($saldo)) : ?>
                                        <?php $tl_saldo += empty($jurnal->id_akun) ? 0 : $jurnal->debit - $jurnal->kredit; ?>
                                        <?php else : ?>
                                        <?php $tl_saldo +=  empty($saldo->debit_saldo) ? 0 : $saldo->debit_saldo -  $saldo->kredit_saldo ?>
                                        <?php endif ?>
                                        <td><strong><?= number_format($tl_saldo, 0); ?></strong></td>
                                        </tr>
                                        <?php endforeach ?>

                                        <tr>
                                            <td style="color: white; background-color: #435c77; position: sticky; left: 0; z-index: 1020;">
                                                <strong>Total Asset</strong>
                                            </td>

                                            <?php
                $sum_aktiva = 0;
                foreach ($periode as $pd) : ?>
                                            <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $month2 = date('m', strtotime('-1 months', strtotime($pd->tgl)));
                                                
                                                $year = date('Y', strtotime($pd->tgl));
                                                $neraca_pendapatan = DB::select("SELECT * FROM tb_neraca_saldo_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_lokasi = '$id_lokasi'");
                                                $nmTbl = count($neraca_pendapatan) < 1 ? 'tb_jurnal' : 'tb_neraca_saldo_penutup';
                                                $sum = $nmTbl == 'tb_jurnal' ? "sum(a.debit) as debit_saldo,sum(a.kredit) as kredit_saldo" : "sum(a.debit) as debit_saldo,sum(a.kredit) as kredit_saldo";
                                                // dd($nmTbl);
                                                $saldo = DB::selectOne("SELECT $sum FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' AND  month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='25' ");
                                            
                                                $saldo_prev = DB::selectOne("SELECT $sum FROM $nmTbl as a 
                                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                                    where a.id_lokasi = '$id_lokasi' AND  month(a.tgl) = '$month2' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='25' ORDER BY a.tgl ");
                                                
                                                ?>
                                            <?php if (empty($saldo->debit_saldo) || $saldo->debit_saldo == 0) : ?>
                                            <td style="color: white; background-color: #435c77;"><strong>
                                                    <?= number_format($saldo_prev->debit_saldo - $saldo_prev->kredit_saldo, 0) ?>
                                                </strong></td>
                                            <?php else : ?>
                                            <td style="color: white; background-color: #435c77;"><strong>
                                                    <?= number_format($saldo->debit_saldo - $saldo->kredit_saldo, 0) ?>
                                                </strong></td>
                                            <?php endif ?>


                                            <?php
                    $jumlah_aktiva2 = empty($saldo_prev->debit_saldo) ? $saldo->debit_saldo - $saldo->kredit_saldo : $saldo_prev->debit_saldo - $saldo_prev->kredit_saldo;
                endforeach; ?>
                                            <td style="color: white; background-color: #435c77;"><strong>
                                                    <?= number_format($jumlah_aktiva2, 0) ?>
                                                </strong></td>
                                        </tr>


                                    </tbody>

                                    <!-- end Aktiva Gantung -->


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<style>
    .modal-lg-max {
        max-width: 900px;
    }

</style>

<div class="modal fade" id="id_akun" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg-max" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Detail Jurnal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detail"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="id_akun2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg-max" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Detail pemasukan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detail2"></div>
            </div>
        </div>
    </div>
</div>

<form method="get" action="<?= route('lapExportAll') ?>">
    <div class="modal fade" id="Export_all" role="dialog" aria-labelledby="Export_all" aria-hidden="true">
        <div class="modal-dialog modal-lg-max" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Detail pemasukan</h5>
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
                    <button type="submit" class="btn btn-info btn-sm">Import</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('script')
<script>
    $("#search_bulanan").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tb_bulanan tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(".btn_detail").click(function(e) {
        var id_akun = $(this).attr("id_akun");
        var bulan = $(this).attr("bulan");
        var tahun = $(this).attr("tahun");

        $("#detail").load("{{ route('getDetailLap') }}?id_akun=" + id_akun + "&bulan=" + bulan + "&tahun=" +
            tahun, "data"
            , function(response, status, request) {
                this; // dom element

            });
    });

    // $(".").click(function(e) {
    //     var id_akun = $(this).attr("id_akun");
    //     var bulan = $(this).attr("bulan");
    //     var tahun = $(this).attr("tahun");

    //     $("#detail").load("{{ route('getDetailLap2') }}?id_akun="+id_akun+"&bulan="+bulan+"&tahun="+tahun, "data", function (response, status, request) {
    //         this; // dom element

    //     });
    // });

</script>
@endsection
