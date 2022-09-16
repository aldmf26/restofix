@extends('accounting.template.master')
@section('content')
<style>
    .input-kecil {
        height: 30px;
        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;
    }
</style>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('accounting.template.flash')
                    <?php $i = 1; ?>
                    <!-- <a href="" class="btn btn-info btn-sm mb-2 float-right" data-target="tahun" data-toggle="modal">View Tahun</a> -->
                    <form action="<?= route('save_budget') ?>" method="post">
                        @csrf   
                        <div class="card">

                            <div class="card-header">
                                <h4 class="float-left">Laporan Cash Flow </h4>
                                <a href="#" data-toggle="modal" data-target="#view_bulan" class="btn btn-info float-right btn-sm"><i class="fas fa-search"></i> View</a>
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
                                        height: 350px;
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

                                    <table class="table table-sm table-bordered" style="font-size: 12px; ">
                                        <thead style="text-align: center;">
                                            <tr>
                                                <th style="color: white; background-color: #435c77;position: sticky; top:0; left: 0; z-index: 1030;">Akun</th>
                                                <?php $c = 3;
                                                foreach ($periode as $key => $value) :
                                                    $c += 1;
                                                ?>
                                                    <th style="color: white; background-color: #435c77" class="sticky-top th-atas-bulanan"><?= date('M-Y', strtotime($value->tgl)) ?></th>
                                                <?php endforeach ?>

                                                <th style="color: white; background-color: #435c77" width="10%" class="sticky-top th-atas-bulanan">
                                                    <center>Budgeting </center>
                                                </th>

                                                <?php foreach ($periode2 as $p) : ?>

                                                    <th style="color: white; background-color: #435c77" class="sticky-top th-atas-bulanan"><?= date('M-Y', strtotime($p->tgl)) ?></th>
                                                <?php endforeach ?>
                                                
                                                <th style="color: white; background-color: #435c77" class="sticky-top th-atas-bulanan">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tb_bulanan">
                                            <tr>
                                                <td style="color: white; background-color: #435c77;position: sticky; left: 0; z-index: 1020;">
                                                    <dt>Pemasukan</dt>
                                                </td>
                                                <td colspan="<?= $c ?>" style="color: white; background-color: #435c77;"></td>
                                            </tr>
                                            <?php foreach ($akun_pendapatan as $ap) : ?>
                                                <tr>
                                                    <td style="position: sticky; left: 0; z-index: 1020; background-color: #FFFFFF;"><?= $ap->nm_akun ?></td>
                                                    <?php $t_pemasukan = 0;
                                                    foreach ($periode as $pd) : ?>
                                                        <?php
                                                        $month = date('m', strtotime($pd->tgl));
                                                        $year = date('Y', strtotime($pd->tgl));
                                                        $neraca_pendapatan = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");
                                                        if (empty($neraca_pendapatan->id_neraca_saldo)) {
                                                            $pen = DB::selectOne("SELECT SUM(a.debit) AS debit_saldo , SUM(a.kredit) AS kredit_saldo
                                                        FROM tb_jurnal AS a
                                                        WHERE a.id_akun = '$ap->id_akun' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' 
                                                        GROUP BY a.id_akun");
                                                        } else {
                                                            $pen = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where month(a.tgl) = $month and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");
                                                        }
                                                        $t_pemasukan += empty($pen->kredit_saldo) ? '0' : $pen->kredit_saldo;

                                                        ?>
                                                        <td style="text-align: right;"><a href="#" class="btn_detail2" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>"><?= empty($pen->kredit_saldo) ? '0' :  number_format($pen->kredit_saldo, 0) ?></a></td>

                                                    <?php endforeach; ?>    
                                                    <?php $t_pemasukan2 = 0;
                                                    foreach ($periode2 as $pd) : ?>
                                                        <?php
                                                        $month = date('m', strtotime($pd->tgl));
                                                        $year = date('Y', strtotime($pd->tgl));
                                                        $neraca_pendapatan = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");
                                                        if (empty($neraca_pendapatan->id_neraca_saldo)) {
                                                            $pen = DB::selectOne("SELECT SUM(a.debit) AS debit_saldo , SUM(a.kredit) AS kredit_saldo
                                                        FROM tb_jurnal AS a
                                                        WHERE a.id_akun = '$ap->id_akun' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' 
                                                        GROUP BY a.id_akun");
                                                        } else {
                                                            $pen = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where month(a.tgl) = $month and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");
                                                        }
                                                        $t_pemasukan2 += empty($pen->kredit_saldo) ? '0' : $pen->kredit_saldo;
                                                     
                                                        ?>
                                                        <td>
                                                            <!-- <input type="number" class="form-control" style="font-size: 10px;"> -->
                                                        </td>
                                                        <td style="text-align: right;"><a href="#" class="btn_detail2" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>"><?= empty($pen->kredit_saldo) ? '0' :  number_format($pen->kredit_saldo, 0) ?></a></td>
                                                        
                                                    <?php endforeach; ?>
                                                    <td style="text-align: right;"><?= number_format($t_pemasukan + $t_pemasukan2, 0) ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                                
                                            <tr>
                                                <td style="color: white; background-color: #435c77; position: sticky; left: 0; z-index: 999;"><strong>Total Pemasukan</strong></td>
                                                <?php
                                                $total_pendapatan = 0;
                                                $c = 1;
                                                foreach ($periode as $pd) : ?>
                                                    <?php
                                                    $c += 1;
                                                    $month = date('m', strtotime($pd->tgl));
                                                    $year = date('Y', strtotime($pd->tgl));
                                                    $neraca_pendapatan = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");
                                                    if (empty($neraca_pendapatan->id_neraca_saldo)) {
                                                        $ttl = DB::selectOne("SELECT sum(a.kredit) as kredit_saldo FROM tb_jurnal as a 
                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                    where month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='26' ");
                                                    } else {
                                                        $ttl = DB::selectOne("SELECT sum(a.kredit_saldo) as kredit_saldo FROM tb_neraca_saldo_penutup as a 
                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                    where month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='26' ");
                                                    }
                                                    ?>
                                                    <td style="color: white; background-color: #435c77; text-align: right;"><strong><?= empty($ttl->kredit_saldo) ? '0' : number_format($ttl->kredit_saldo, 0) ?></strong></td>

                                                <?php $total_pendapatan += empty($ttl->kredit_saldo) ? '0' : $ttl->kredit_saldo;
                                                endforeach; ?>
                                                <?php
                                                $total_pendapatan2 = 0;
                                                $c = 3;
                                                foreach ($periode2 as $pd) : ?>
                                                    <?php
                                                    $c += 1;
                                                    $month = date('m', strtotime($pd->tgl));
                                                    $year = date('Y', strtotime($pd->tgl));
                                                    $neraca_pendapatan = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");
                                                    if (empty($neraca_pendapatan->id_neraca_saldo)) {
                                                        $ttl = DB::selectOne("SELECT sum(a.kredit) as kredit_saldo FROM tb_jurnal as a 
                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                    where month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='26' ");
                                                    } else {
                                                        $ttl = DB::selectOne("SELECT sum(a.kredit_saldo) as kredit_saldo FROM tb_neraca_saldo_penutup as a 
                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                                    where month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='26' ");
                                                    }
                                                    ?>
                                                    <td style="color: white; background-color: #435c77; text-align: right;"></td>
                                                    <td style="color: white; background-color: #435c77; text-align: right;"><strong><?= empty($ttl->kredit_saldo) ? '0' : number_format($ttl->kredit_saldo, 0) ?></strong></td>

                                                <?php $total_pendapatan2 += empty($ttl->kredit_saldo) ? '0' : $ttl->kredit_saldo;
                                                endforeach; ?>
                                                <td style="color: white; background-color: #435c77; text-align: right;"><strong><?= number_format($total_pendapatan + $total_pendapatan2, 0) ?> </strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="<?= $c ?>"></td>
                                            </tr>
                                            <tr>

                                                <td style="color: white; background-color: #435c77; position: sticky; left: 0; z-index: 999;"><strong>Total uang keluar</strong></td>

                                                <?php $ttl_uang = 0;
                                                $c = 3;
                                                foreach ($periode as $pd) :
                                                    $c += 1;
                                                ?>
                                                    <?php
                                                    $bulan = date('m', strtotime($pd->tgl));
                                                    $tahun = date('Y', strtotime($pd->tgl));
                                                    ?>
                                                    <?php
                                                    $saldo = DB::selectOne("SELECT a.id_akun, c.nm_akun, a.tgl, sum(a.saldo_cash) as debit, a.kd_gabungan, b.id_sub_menu_akun
                                                    FROM tb_cashflow_penutup AS a
                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun ='27'
                                                    LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                    WHERE b.id_sub_menu_akun = '27' and MONTH('tgl') = '$bulan' and YEAR('tgl') = $tahun
                                                    ");

                                                    if (empty($saldo)) {
                                                        $jurnal = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                        sum(a.kredit) as kredit
                                                        FROM tb_jurnal AS a
                                                        LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '27'
                                                        WHERE MONTH(a.tgl) ='$bulan' AND YEAR(a.tgl) = '$tahun' AND b.id_sub_menu_akun = '27' 
                                                        ");

                                                        $jurnal_saldo = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                        sum(a.kredit) as kredit , d.id_akun
                                                        FROM tb_jurnal AS a
                                                        LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '30'
                                                        
                                                        LEFT JOIN(SELECT a.id_akun,  kd_gabungan 
                                                        FROM tb_jurnal AS a
                                                        LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
                                                        WHERE a.debit = 0
                                                        GROUP BY kd_gabungan) d ON a.kd_gabungan = d.kd_gabungan and d.id_akun != a.id_akun
                                                        
                                                        WHERE MONTH(a.tgl) ='$bulan' AND YEAR(a.tgl) = '$tahun' AND b.id_sub_menu_akun = '30' AND (d.id_akun = '24' OR d.id_akun IS NULL)
                                                        ");
                                                    } else {
                                                        $jurnal = DB::selectOne("SELECT a.id_akun, c.nm_akun, a.tgl, sum(a.saldo_cash) as debit, a.kd_gabungan, b.id_sub_menu_akun
                                                    FROM tb_cashflow_penutup AS a
                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun ='27'
                                                    LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                    WHERE b.id_sub_menu_akun = '27' and MONTH(a.tgl) = '$bulan' and YEAR(a.tgl) = '$tahun'
                                                    ");

                                                        $jurnal_saldo = DB::selectOne("SELECT a.id_akun, c.nm_akun, a.tgl, sum(a.saldo_cash) as debit, a.kd_gabungan, b.id_sub_menu_akun
                                                    FROM tb_cashflow_penutup AS a
                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun ='30'
                                                    LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                    WHERE b.id_sub_menu_akun = '30' and MONTH(a.tgl) = '$bulan' and YEAR(a.tgl) = '$tahun'
                                                    ");
                                                    }



                                                    ?>
                                                    <td style="color: white; background-color: #435c77; text-align: right;">
                                                        <strong><?= number_format(($jurnal->debit + $jurnal_saldo->debit), 0) ?> </strong>
                                                    </td>


                                                <?php $ttl_uang += ($jurnal->debit + $jurnal_saldo->debit);
                                                endforeach ?>
                                                <?php $ttl_uang2 = 0;
                                                $i = 1;
                                                foreach ($periode2 as $pd) :
                                                    $i += 1;
                                                ?>
                                                    <?php
                                                    $bulan = date('m', strtotime($pd->tgl));
                                                    $tahun = date('Y', strtotime($pd->tgl));
                                                    ?>
                                                    <?php
                                                    $jurnal = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                sum(a.kredit) as kredit
                                                FROM tb_jurnal AS a
                                                LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '27'
                                                WHERE MONTH(a.tgl) ='$bulan' AND YEAR(a.tgl) = '$tahun' AND b.id_sub_menu_akun = '27' 
                                                ");

                                                    $jurnal_saldo = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                sum(a.kredit) as kredit , d.id_akun
                                                FROM tb_jurnal AS a
                                                LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '30'
                                                
                                                LEFT JOIN(SELECT a.id_akun,  kd_gabungan 
                                                FROM tb_jurnal AS a
                                                LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
                                                WHERE a.debit = 0
                                                GROUP BY kd_gabungan) d ON a.kd_gabungan = d.kd_gabungan and d.id_akun != a.id_akun
                                                
                                                WHERE MONTH(a.tgl) ='$bulan' AND YEAR(a.tgl) = '$tahun' AND b.id_sub_menu_akun = '30' AND (d.id_akun = '24' OR d.id_akun IS NULL)
                                                ");
                                                    ?>
                                                    <td style="color: white; background-color: #435c77; text-align: right;"></td>
                                                    <td style="color: white; background-color: #435c77; text-align: right;"><strong><?= number_format(($jurnal->debit + $jurnal_saldo->debit), 0) ?></strong></td>
                                                <?php $ttl_uang2 += ($jurnal->debit + $jurnal_saldo->debit);
                                                endforeach ?>
                                                <td style="color: white; background-color: #435c77; text-align: right;"><strong><?= number_format($ttl_uang + $ttl_uang2, 0) ?></strong></td>

                                            </tr>
                                            <tr>
                                                <td style="color: white; background-color: #435c77;position: sticky; left: 0; z-index: 1020;">
                                                    <dt>Uang Keluar</dt>
                                                </td>
                                                <td colspan="<?= $c ?>" style="color: white; background-color: #435c77;"></td>
                                            </tr>
                                            <?php
                                            $ttl = 0;
                                            foreach ($akun_pengeluaran as $ap) : ?>
                                                <tr>
                                                    <td style="position: sticky; left: 0; z-index: 1020; background-color: #FFFFFF;"><?= $ap->nm_akun ?></td>
                                                    <?php
                                                    $tl_saldo = 0;
                                                    foreach ($periode as $pd) :
                                                    ?>
                                                        <?php
                                                        $month = date('m', strtotime($pd->tgl));
                                                        $year = date('Y', strtotime($pd->tgl));
                                                        $tgl_awal = date('Y-m-01', strtotime($pd->tgl));
                                                        $tgl_akhir = date('Y-m-t', strtotime($pd->tgl));

                                                        ?>

                                                        <td style="text-align: right; vertical-align: middle;">
                                                            <?php
                                                            $saldo =DB::selectOne("SELECT * FROM tb_cashflow_penutup as a 
                                                            where month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' 
                                                            group BY MONTH(a.tgl) , YEAR(a.tgl)");


                                                            if (empty($saldo)) {
                                                                $jurnal =DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                                sum(a.kredit) as kredit 
                                                                FROM tb_jurnal AS a
                                                                LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                                LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '27'
                                                                WHERE a.id_akun = '$ap->id_akun' AND MONTH(a.tgl) ='$month' AND YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun = '27' 
                                                                ");
                                                            } else {
                                                                $jurnal =DB::selectOne("SELECT a.id_akun, c.nm_akun, a.tgl, sum(a.saldo_cash) as debit, a.kd_gabungan, b.id_sub_menu_akun
                                                                FROM tb_cashflow_penutup AS a
                                                                LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun ='27'
                                                                LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                                WHERE b.id_sub_menu_akun = '27' and MONTH(a.tgl) = '$month' and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'
                                                                GROUP BY a.id_akun");
                                                            }


                                                            ?>

                                                            <a href="#" class="btn_detail2" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>">
                                                                <?= empty($jurnal->id_akun) ? 0 : number_format($jurnal->debit, 0)  ?>
                                                                <a>
                                                        </td>
                                                    <?php
                                                        $tl_saldo += empty($jurnal->id_akun) ? 0 : $jurnal->debit;
                                                    endforeach; ?>

                                                    <!-- inputan -->

                                                    <?php foreach ($periode3 as $p) : ?>
                                                        <?php
                                                        $month = date('m', strtotime($p->tgl));
                                                        $year = date('Y', strtotime($p->tgl));
                                                        $tgl_awal = date('Y-m-01', strtotime($p->tgl));
                                                        $tgl_akhir = date('Y-m-t', strtotime($p->tgl));




                                                        $jurnal_saldo = DB::selectOne("SELECT *
                                                        FROM budgeting AS a
                                                        WHERE a.id_akun ='$ap->id_akun' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");
                                                        $id_budget = empty($jurnal_saldo->id_budgeting) ? '' : $jurnal_saldo->id_budgeting;
                                                        ?>
                                                        <td>
                                                            <input type="text" class="form-control input-kecil rupiah rupiah<?= $id_budget ?>" id_buget="<?= $id_budget ?>" style="font-size: 12px; text-align: right;" value="<?= empty($jurnal_saldo->buget) ? 0 : $jurnal_saldo->buget ?>">
                                                            <input type="hidden" name="budget[]" class="form-control input-kecil rupiah2<?= $id_budget ?>" style="font-size: 12px; text-align: right;" value="<?= empty($jurnal_saldo->buget) ? 0 : $jurnal_saldo->buget ?>">
                                                            <input type="hidden" name="id_budget[]" value="<?= empty($jurnal_saldo->id_budgeting) ? '' : $jurnal_saldo->id_budgeting ?>">
                                                        </td>
                                                    <?php endforeach ?>

                                                    <!-- inputan -->



                                                    <?php
                                                    $tl_saldo2 = 0;
                                                    foreach ($periode2 as $pd) :
                                                    ?>
                                                        <?php
                                                        $month = date('m', strtotime($pd->tgl));
                                                        $year = date('Y', strtotime($pd->tgl));
                                                        $tgl_awal = date('Y-m-01', strtotime($pd->tgl));
                                                        $tgl_akhir = date('Y-m-t', strtotime($pd->tgl));
                                                        ?>


                                                        <td style="text-align: right; vertical-align: middle;">
                                                            <?php
                                                            $jurnal = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                        sum(a.kredit) as kredit 
                                                        FROM tb_jurnal AS a
                                                        LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '27'
                                                        WHERE a.id_akun = '$ap->id_akun' AND MONTH(a.tgl) ='$month' AND YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun = '27' 
                                                     ");
                                                            ?>
                                                            <a href="#" class="btn_detail2" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>">
                                                                <?= empty($jurnal->id_akun) ? 0 : number_format($jurnal->debit, 0)  ?> </a>
                                                        </td>
                                                    <?php
                                                        $tl_saldo2 += empty($jurnal->id_akun) ? 0 : $jurnal->debit;
                                                    endforeach; ?>
                                                    <td style="text-align: right;"><?= number_format($tl_saldo + $tl_saldo2, 0) ?></td>
                                                </tr>
                                            <?php
                                                $ttl +=  empty($jurnal->id_akun) ? 0 : $jurnal->debit;
                                            endforeach ?>
                                            <?php
                                            $ttl = 0;
                                            foreach ($akun_pengeluaran_saldo as $ap) : ?>
                                                <tr>
                                                    <td style="position: sticky; left: 0; z-index: 1020; background-color: #FFFFFF;"><?= $ap->nm_akun ?></td>
                                                    <?php
                                                    $tl_saldo = 0;
                                                    foreach ($periode as $pd) :
                                                    ?>
                                                        <?php
                                                        $month = date('m', strtotime($pd->tgl));
                                                        $year = date('Y', strtotime($pd->tgl));
                                                        $tgl_awal = date('Y-m-01', strtotime($pd->tgl));
                                                        $tgl_akhir = date('Y-m-t', strtotime($pd->tgl));

                                                        $saldo = DB::selectOne("SELECT * FROM tb_cashflow_penutup as a 
                                                            where month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' 
                                                            group BY MONTH(a.tgl) , YEAR(a.tgl)");
                                                        ?>

                                                        <td style="text-align: right;">
                                                            <?php
                                                            if (empty($saldo)) {
                                                                $jurnal_saldo = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                                sum(a.kredit) as kredit , d.id_akun
                                                                FROM tb_jurnal AS a
                                                                LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                                LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '30'
                                                                
                                                                LEFT JOIN(SELECT a.id_akun,  kd_gabungan 
                                                                FROM tb_jurnal AS a
                                                                LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
                                                                WHERE a.debit = 0
                                                                GROUP BY kd_gabungan) d ON a.kd_gabungan = d.kd_gabungan and d.id_akun != a.id_akun
                                                                
                                                                WHERE a.id_akun ='$ap->id_akun' and MONTH(a.tgl) ='$month' AND YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun = '30' AND (d.id_akun = '24' OR d.id_akun IS NULL)
                                                                ");
                                                            } else {
                                                                $jurnal_saldo = DB::selectOne("SELECT a.id_akun, c.nm_akun, a.tgl, sum(a.saldo_cash) as debit, a.kd_gabungan, b.id_sub_menu_akun
                                                                FROM tb_cashflow_penutup AS a
                                                                LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun ='30'
                                                                LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                                WHERE b.id_sub_menu_akun = '30' and MONTH(a.tgl) = '$month' and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'
                                                                GROUP BY a.id_akun");
                                                            }
                                                            ?>
                                                            <a href="#" class="btn_detail2" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>">
                                                                <?= empty($jurnal_saldo->id_akun) ? 0 : number_format($jurnal_saldo->debit, 0)  ?> </a>
                                                        </td>

                                                    <?php
                                                        $tl_saldo += empty($jurnal_saldo->id_akun) ? 0 : $jurnal_saldo->debit;
                                                    endforeach; ?>

                                                    <!-- inputan -->
                                                    <?php foreach ($periode3 as $p) : ?>
                                                        <?php
                                                        $month = date('m', strtotime($p->tgl));
                                                        $year = date('Y', strtotime($p->tgl));
                                                        $tgl_awal = date('Y-m-01', strtotime($p->tgl));
                                                        $tgl_akhir = date('Y-m-t', strtotime($p->tgl));




                                                        $jurnal_saldo = DB::selectOne("SELECT *
                                                        FROM budgeting AS a
                                                        WHERE a.id_akun ='$ap->id_akun' AND MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");


                                                        ?>
                                                        <td>
                                                            <input type="text" name="budget[]" class="form-control input-kecil" style="font-size: 12px; text-align: right;" value="<?= empty($jurnal_saldo->buget) ? 0 : $jurnal_saldo->buget ?>">

                                                            <input type="hidden" name="id_budget[]" value="<?= empty($jurnal_saldo->id_budgeting) ? '' : $jurnal_saldo->id_budgeting ?>">
                                                        </td>
                                                    <?php endforeach ?>

                                                    <!-- inputan -->

                                                    <?php
                                                    $tl_saldo2 = 0;
                                                    foreach ($periode2 as $pd) :
                                                    ?>
                                                        <?php
                                                        $month = date('m', strtotime($pd->tgl));
                                                        $year = date('Y', strtotime($pd->tgl));
                                                        $tgl_awal = date('Y-m-01', strtotime($pd->tgl));
                                                        $tgl_akhir = date('Y-m-t', strtotime($pd->tgl));

                                                        $saldo = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where month(a.tgl) = $month and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");
                                                        ?>

                                                        <td style="text-align: right;">
                                                            <?php
                                                            $jurnal_saldo = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                        sum(a.kredit) as kredit , d.id_akun
                                                        FROM tb_jurnal AS a
                                                        LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '30'
                                                        
                                                        LEFT JOIN(SELECT a.id_akun,  kd_gabungan 
                                                        FROM tb_jurnal AS a
                                                        LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
                                                        WHERE a.debit = 0
                                                        GROUP BY kd_gabungan) d ON a.kd_gabungan = d.kd_gabungan and d.id_akun != a.id_akun
                                                        
                                                        WHERE a.id_akun ='$ap->id_akun' and MONTH(a.tgl) ='$month' AND YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun = '30' AND (d.id_akun = '24' OR d.id_akun IS NULL)
                                                     ");
                                                            ?>
                                                            <a href="#" class="btn_detail2" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>">
                                                                <?= empty($jurnal_saldo->id_akun) ? 0 : number_format($jurnal_saldo->debit, 0)  ?> </a>
                                                        </td>

                                                    <?php
                                                        $tl_saldo2 += empty($jurnal_saldo->id_akun) ? 0 : $jurnal_saldo->debit;
                                                    endforeach; ?>
                                                    <td style="text-align: right;"><?= number_format($tl_saldo + $tl_saldo2, 0) ?> </td>
                                                </tr>
                                            <?php
                                                $ttl +=  empty($jurnal->id_akun) ? 0 : $jurnal->debit - $jurnal->kredit;
                                            endforeach ?>

                                            <tr>

                                                <td style="color: white; background-color: #435c77; position: sticky; left: 0; z-index: 999;"><strong>Total uang keluar</strong></td>

                                                <?php $ttl_uang = 0;
                                                $c = 3;
                                                foreach ($periode as $pd) :
                                                    $c += 1;
                                                ?>
                                                    <?php
                                                    $bulan = date('m', strtotime($pd->tgl));
                                                    $tahun = date('Y', strtotime($pd->tgl));
                                                    ?>
                                                    <?php
                                                    $saldo = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where month(a.tgl) = $month and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");

                                                    if (empty($saldo)) {
                                                        $jurnal = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                        sum(a.kredit) as kredit
                                                        FROM tb_jurnal AS a
                                                        LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '27'
                                                        WHERE MONTH(a.tgl) ='$bulan' AND YEAR(a.tgl) = '$tahun' AND b.id_sub_menu_akun = '27' 
                                                        ");

                                                        $jurnal_saldo = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                        sum(a.kredit) as kredit , d.id_akun
                                                        FROM tb_jurnal AS a
                                                        LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '30'
                                                        
                                                        LEFT JOIN(SELECT a.id_akun,  kd_gabungan 
                                                        FROM tb_jurnal AS a
                                                        LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
                                                        WHERE a.debit = 0
                                                        GROUP BY kd_gabungan) d ON a.kd_gabungan = d.kd_gabungan and d.id_akun != a.id_akun
                                                        
                                                        WHERE MONTH(a.tgl) ='$bulan' AND YEAR(a.tgl) = '$tahun' AND b.id_sub_menu_akun = '30' AND (d.id_akun = '24' OR d.id_akun IS NULL)
                                                        ");
                                                    } else {
                                                        $jurnal = DB::selectOne("SELECT a.id_akun, c.nm_akun, a.tgl, sum(a.saldo_cash) as debit, a.kd_gabungan, b.id_sub_menu_akun
                                                        FROM tb_cashflow_penutup AS a
                                                        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun ='27'
                                                        LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                        WHERE b.id_sub_menu_akun = '27' and MONTH(a.tgl) = '$bulan' and YEAR(a.tgl) = '$tahun'
                                                        ");

                                                        $jurnal_saldo = DB::selectOne("SELECT a.id_akun, c.nm_akun, a.tgl, sum(a.saldo_cash) as debit, a.kd_gabungan, b.id_sub_menu_akun
                                                        FROM tb_cashflow_penutup AS a
                                                        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun ='30'
                                                        LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                        WHERE b.id_sub_menu_akun = '30' and MONTH(a.tgl) = '$bulan' and YEAR(a.tgl) = '$tahun'
                                                        ");
                                                    }



                                                    ?>
                                                    <td style="color: white; background-color: #435c77; text-align: right;">
                                                        <strong><?= number_format(($jurnal->debit + $jurnal_saldo->debit), 0) ?></strong>
                                                    </td>

                                                <?php $ttl_uang += ($jurnal->debit + $jurnal_saldo->debit);
                                                endforeach ?>

                                                <?php foreach ($periode3 as $p) : ?>

                                                    <?php
                                                    $bulan = date('m', strtotime($p->tgl));
                                                    $tahun = date('Y', strtotime($p->tgl));
                                                    $saldo = DB::selectOne("SELECT SUM(a.buget) as budget
                                                        FROM budgeting AS a
                                                        WHERE  MONTH(a.tgl) = '$bulan' AND YEAR(a.tgl) = '$tahun'") ?>
                                                    <td style="color: white; background-color: #435c77; text-align: right;">
                                                        <strong><?= number_format($saldo->budget, 0) ?></strong>
                                                    </td>
                                                <?php endforeach ?>

                                                <?php $ttl_uang2 = 0;
                                                $i = 1;
                                                foreach ($periode2 as $pd) :
                                                    $i += 1;
                                                ?>
                                                    <?php
                                                    $bulan = date('m', strtotime($pd->tgl));
                                                    $tahun = date('Y', strtotime($pd->tgl));
                                                    ?>
                                                    <?php
                                                    $jurnal = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                    sum(a.kredit) as kredit
                                                    FROM tb_jurnal AS a
                                                    LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '27'
                                                    WHERE MONTH(a.tgl) ='$bulan' AND YEAR(a.tgl) = '$tahun' AND b.id_sub_menu_akun = '27' 
                                                    ");

                                                    $jurnal_saldo = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                    sum(a.kredit) as kredit , d.id_akun
                                                    FROM tb_jurnal AS a
                                                    LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '30'

                                                    LEFT JOIN(SELECT a.id_akun,  kd_gabungan 
                                                    FROM tb_jurnal AS a
                                                    LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
                                                    WHERE a.debit = 0
                                                    GROUP BY kd_gabungan) d ON a.kd_gabungan = d.kd_gabungan and d.id_akun != a.id_akun

                                                    WHERE MONTH(a.tgl) ='$bulan' AND YEAR(a.tgl) = '$tahun' AND b.id_sub_menu_akun = '30' AND (d.id_akun = '24' OR d.id_akun IS NULL)
                                                    ");
                                                    ?>

                                                    <td style="color: white; background-color: #435c77; text-align: right;"><strong><?= number_format(($jurnal->debit + $jurnal_saldo->debit), 0) ?></strong></td>
                                                <?php $ttl_uang2 += ($jurnal->debit + $jurnal_saldo->debit);
                                                endforeach ?>
                                                <td style="color: white; background-color: #435c77; text-align: right;"><strong><?= number_format($ttl_uang + $ttl_uang2, 0) ?></strong></td>

                                            </tr>
                                            <tr>
                                                <td colspan="<?= $i ?>"></td>
                                            </tr>
                                            <tr>

                                                <td style="color: white; background-color: #435c77; position: sticky; left: 0; z-index: 999;"><strong>liabilites (credit side)</strong></td>

                                                <?php $ttl_uang = 0;
                                                $count = 1;
                                                foreach ($periode as $pd) :
                                                    $c = $count++
                                                ?>
                                                    <?php
                                                    $bulan = date('m', strtotime($pd->tgl));
                                                    $tahun = date('Y', strtotime($pd->tgl));
                                                    ?>

                                                    <?php
                                                    $saldo = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where month(a.tgl) = $month and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");

                                                    if (empty($saldo)) {
                                                        $jurnal = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                        sum(a.kredit) as kredit
                                                        FROM tb_jurnal AS a
                                                        LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                        LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '28'
    
                                                        LEFT JOIN(SELECT a.id_akun,  kd_gabungan 
                                                        FROM tb_jurnal AS a
                                                        LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
                                                        WHERE a.debit != 0
                                                        GROUP BY kd_gabungan) d ON a.kd_gabungan = d.kd_gabungan and d.id_akun != a.id_akun
    
                                                        WHERE MONTH(a.tgl) ='$bulan' and  d.id_akun != '63' AND YEAR(a.tgl) = '$tahun' AND b.id_sub_menu_akun = '28' 
                                                        ");
                                                    } else {
                                                        $jurnal = DB::selectOne("SELECT a.id_akun, c.nm_akun, a.tgl, sum(a.saldo_cash) as kredit, a.kd_gabungan, b.id_sub_menu_akun
                                                       FROM tb_cashflow_penutup AS a
                                                       LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun ='28'
                                                       LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                       WHERE b.id_sub_menu_akun = '28' and MONTH(a.tgl) = '$bulan' and YEAR(a.tgl) = '$tahun'
                                                       GROUP BY a.id_akun");
                                                    }
                                                    ?>
                                                    <td style="color: white; background-color: #435c77; text-align: right;"><strong><?= empty($jurnal) ? 0 : number_format(($jurnal->kredit), 0) ?></strong></td>
                                                <?php $ttl_uang += empty($jurnal) ? 0 : $jurnal->kredit;
                                                endforeach ?>
                                                <?php $ttl_uang2 = 0;
                                                $count = 1;
                                                foreach ($periode2 as $pd) :
                                                    $c = $count++
                                                ?>
                                                    <?php
                                                    $bulan = date('m', strtotime($pd->tgl));
                                                    $tahun = date('Y', strtotime($pd->tgl));
                                                    ?>

                                                    <?php
                                                    $jurnal = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , 
                                                sum(a.kredit) as kredit
                                                FROM tb_jurnal AS a
                                                LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun AND b.id_sub_menu_akun = '28'

                                                LEFT JOIN(SELECT a.id_akun,  kd_gabungan 
                                                FROM tb_jurnal AS a
                                                LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
                                                WHERE a.debit != 0
                                                GROUP BY kd_gabungan) d ON a.kd_gabungan = d.kd_gabungan and d.id_akun != a.id_akun

                                                WHERE MONTH(a.tgl) ='$bulan' and  d.id_akun != '63' AND YEAR(a.tgl) = '$tahun' AND b.id_sub_menu_akun = '28' 
                                                ");
                                                    ?>
                                                    <td style="color: white; background-color: #435c77; text-align: right;"></td>
                                                    <td style="color: white; background-color: #435c77; text-align: right;"><strong><?= number_format(($jurnal->kredit), 0) ?></strong></td>
                                                <?php $ttl_uang2 += ($jurnal->kredit);
                                                endforeach ?>
                                                <td style="color: white; background-color: #435c77; text-align: right;"><strong><?= number_format($ttl_uang + $ttl_uang2, 0) ?></strong></td>

                                            </tr>

                                            <?php foreach ($liabilities as $ap) : ?>
                                                <tr>
                                                    <td style="position: sticky; left: 0; z-index: 1020; background-color: #FFFFFF;"><?= $ap->nm_akun ?></td>
                                                    <?php $t_iribilitas = 0;
                                                    foreach ($periode as $pd) : ?>
                                                        <?php
                                                        $month = date('m', strtotime($pd->tgl));
                                                        $year = date('Y', strtotime($pd->tgl));
                                                        $neraca_pendapatan = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");

                                                        $jml = DB::selectOne("SELECT a.id_akun , sum(a.kredit) as kredit_saldo , d.id_akun
                                                    FROM tb_jurnal as a 
                                                    
                                                    LEFT JOIN(SELECT a.id_akun,  kd_gabungan 
                                                    FROM tb_jurnal AS a
                                                    LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
                                                    WHERE a.debit != 0
                                                    GROUP BY kd_gabungan) d ON a.kd_gabungan = d.kd_gabungan and d.id_akun != a.id_akun
                                                    
                                                    where month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun' AND d.id_akun != '63' ");

                                                        $t_iribilitas += empty($jml->kredit_saldo) ? '0' : $jml->kredit_saldo
                                                        ?>
                                                        <td style="text-align: right;">
                                                            <a href="#" class="btn_detail2" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>"><?= empty($jml->kredit_saldo) ? 0 : number_format($jml->kredit_saldo, 0) ?></a>
                                                        </td>

                                                    <?php endforeach; ?>
                                                    <?php $t_iribilitas2 = 0;
                                                    foreach ($periode2 as $pd) : ?>
                                                        <?php
                                                        $month = date('m', strtotime($pd->tgl));
                                                        $year = date('Y', strtotime($pd->tgl));
                                                        $neraca_pendapatan = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");

                                                        $jml = DB::selectOne("SELECT a.id_akun , sum(a.kredit) as kredit_saldo , d.id_akun
                                                    FROM tb_jurnal as a 
                                                    
                                                    LEFT JOIN(SELECT a.id_akun,  kd_gabungan 
                                                    FROM tb_jurnal AS a
                                                    LEFT JOIN tb_akun AS b ON b.id_akun = a.id_akun
                                                    WHERE a.debit != 0
                                                    GROUP BY kd_gabungan) d ON a.kd_gabungan = d.kd_gabungan and d.id_akun != a.id_akun
                                                    
                                                    where month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun' AND d.id_akun != '63' ");

                                                        $t_iribilitas += empty($jml->kredit_saldo) ? '0' : $jml->kredit_saldo
                                                        ?>
                                                        <td></td>
                                                        <td style="text-align: right;">
                                                            <a href="#" class="btn_detail2" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>"><?= empty($jml->kredit_saldo) ? 0 : number_format($jml->kredit_saldo, 0) ?></a>
                                                        </td>

                                                    <?php endforeach; ?>
                                                    <td style="text-align: right;"><?= number_format($t_iribilitas + $t_iribilitas2, 0) ?></td>
                                                </tr>
                                            <?php endforeach ?>



                                        </tbody>

                                        <!-- end Aktiva Gantung -->


                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info float-right btn-sm mr-4"><i class="far fa-check-square"></i> Save Budgeting</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .modal-lg-max {
        max-width: 900px;
    }
</style>

<form action="" method="get">
    <div class="modal fade" id="view_bulan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg-max" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">View</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="acc" value="{{ Request::get('acc') }}">
                        <div class="col-lg-3 col-3">
                            <label for="">Bulan</label>
                            <select name="bulan1" id="" class="form-control select2">
                                <?php foreach ($s_bulan as $b) : ?>
                                    <option value="0<?= $b->n_bulan ?>"><?= $b->bulan ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-lg-2 col-2">
                            <label for="">Tahun</label>
                            <select name="tahun1" id="" class="form-control select2">
                                <?php foreach ($s_tahun as $t) : ?>
                                    <?php $tanggal = $t->tgl;
                                    $explodetgl = explode('-', $tanggal); ?>
                                    <option value="<?= $explodetgl[0]; ?>"><?= $explodetgl[0]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <br>
                            <center>
                                <h2>
                                    <dt>~</dt>
                                </h2>
                            </center>
                        </div>
                        <div class="col-lg-3 col-3">
                            <label for="">Bulan</label>
                            <select name="bulan2" id="" class="form-control select2" readonly>
                                <?php foreach ($s_bulan as $b) : ?>
                                    <option value="0<?= $b->n_bulan ?>" <?= $b->n_bulan == date('m') ? 'selected' : ''   ?>><?= $b->bulan ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-lg-2 col-2">
                            <label for="">Tahun</label>
                            <select name="tahun2" id="" class="form-control select2">
                                <?php foreach ($s_tahun as $t) : ?>
                                    <?php $tanggal = $t->tgl;
                                    $explodetgl = explode('-', $tanggal); ?>
                                    <option value="<?= $explodetgl[0]; ?>" <?= $explodetgl[0] == date('Y') ? 'selected' : ''   ?>><?= $explodetgl[0]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info ">View</button>
                </div>
            </div>
        </div>
    </div>
</form>

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
<form method="get" action="<?= route('export_all') ?>">
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
    $(function() {
        $('.select').select2()

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });

    $(document).ready(function() {
        $("#search_bulanan").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tb_bulanan tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        
        $(".btn_detail2").click(function(e) {
        var id_akun = $(this).attr("id_akun");
        var bulan = $(this).attr("bulan");
        var tahun = $(this).attr("tahun");
        $("#detail").load("{{ route('get_detail2') }}?id_akun=" + id_akun + "&bulan=" + bulan + "&tahun=" +
            tahun, "data"
            , function(response, status, request) {
                this; // dom element

            });
        });
        

        $(document).on('keyup', '.rupiah', function() {
            var id_buget = $(this).attr("id_buget");
            var angka = $('.rupiah' + id_buget).val();

            var x = angka.replace(/\D/g, "");
            var x2 = x.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $(".rupiah" + id_buget).val(x2);

            var a = x2.replace(/\,/g, ''); // 1125, but a string, so convert it to number
            var a = parseInt(a, 10);

            $(".rupiah2" + id_buget).val(a);

        });

    });
    
</script>
@endsection