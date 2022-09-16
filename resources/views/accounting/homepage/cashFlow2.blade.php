@extends('accounting.template.master')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php $i = 1; ?>
                    <!-- <a href="" class="btn btn-info btn-sm mb-2 float-right" data-target="tahun" data-toggle="modal">View Tahun</a> -->
                    <div class="card">

                        <div class="card-header">
                            <h4 class="float-left">Laporan Cash Flow</h4>
                            

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5"></div>
                                <div class="col-5"></div>
                                <div class="col-2">
                                    <label class="float-left"><input type="search" class="form-control form-control-sm" placeholder="Search.." id="search_bulanan"></label>
                                </div>
                            </div>


                            <?php
                            $t_pemasukan = 0;
                            ?>
                            <!-- <div class="table-responsive"> -->
                            <table class="table table-sm table-bordered" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th class="sticky-top th-atas-bulanan" style="background-color: rgb(175, 184, 187)">Akun</th>
                                        <?php foreach ($periode as $key => $value) : ?>
                                            <th class="sticky-top th-atas-bulanan" style="background-color: rgb(175, 184, 187)"><?= date('M-Y', strtotime($value->tgl)) ?></th>
                                        <?php endforeach ?>
                                        <th class="sticky-top th-atas-bulanan" style="background-color: rgb(175, 184, 187)">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="tb_bulanan">
                                    <tr>
                                        <td style="color: white; background-color: #435c77;" colspan="30">
                                            <dt>Pemasukan</dt>
                                        </td>
                                    </tr>
                                    <?php foreach ($akun_pendapatan as $ap) : ?>
                                        <tr>
                                            <td><?= $ap->nm_akun ?></td>
                                            <?php foreach ($periode as $pd) : ?>
                                                <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $ditutup = DB::selectOne("SELECT * FROM tb_cashflow_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year'");
                                                if(empty($ditutup->id_akun)) {
                                                    $cek = 1;
                                                    $pen = DB::selectOne("SELECT SUM(a.debit) as debit,SUM(a.kredit) as kredit  FROM `tb_jurnal` as a
                                                        LEFT JOIN tb_permission_akun as b on a.id_akun = b.id_akun
                                                        WHERE b.id_akun = '$ap->id_akun'
                                                        AND a.id_buku = '1'
                                                        AND b.id_sub_menu_akun = '21'
                                                        AND MONTH(a.tgl) = '$month'
                                                        AND YEAR(a.tgl) = '$year'");
                                                } else {
                                                    $cek = 2;
                                                    $pen = DB::selectOne("SELECT * FROM tb_cashflow_penutup as a where MONTH(a.tgl) = '$month' AND YEAR(a.tgl) = '$year' AND a.id_akun = '$ap->id_akun'");
                                                }
                                                
                                                $t_pemasukan += $pen->kredit + $pen->debit;

                                                ?>
                                                <td><a href="#" class="btn_detail2" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>"><?= number_format($pen->kredit + $pen->debit, 0) ?> {{ $cek }}</a></td>

                                            <?php endforeach; ?>
                                            <td><?= number_format($t_pemasukan, 0) ?></td>
                                        </tr>
                                    <?php endforeach ?>

                                    <tr>
                                        <td style="color: white; background-color: #435c77;"><strong>Total Pemasukan</strong></td>
                                        <?php
                                        $total_pendapatan = [];
                                        $tPemasukan = 0;
                                        foreach ($periode as $pd) : ?>
                                            <?php
                                            $month = date('m', strtotime($pd->tgl));
                                            $year = date('Y', strtotime($pd->tgl));
                                            $ttl = DB::selectOne("SELECT SUM(a.debit) as debit,SUM(a.kredit) as kredit  FROM `tb_jurnal` as a
                                                LEFT JOIN tb_permission_akun as b on a.id_akun = b.id_akun
                                                WHERE a.id_buku = '1'
                                                AND b.id_sub_menu_akun = '26'
                                                AND MONTH(a.tgl) = '$month'
                                                AND YEAR(a.tgl) = '$year'");
                                            ?>
                                            <td style="color: white; background-color: #435c77;"><strong><?= number_format($ttl->kredit - $ttl->debit, 0) ?></strong></td>
                                            <?php $total_pendapatan[] = $ttl->kredit - $ttl->debit; $tPemasukan += $ttl->kredit - $ttl->debit ?>
                                        <?php endforeach; ?>
                                        <td style="color: white; background-color: #435c77;"><?= number_format($tPemasukan, 0) ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="50">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="color: white; background-color: #435c77;"><strong>Total uang keluar</strong></td>
                                        <?php
                                        $total_pendapatan = [];
                                        $tKeluar = 0;
                                        foreach ($periode as $pd) : ?>
                                            <?php
                                            $month = date('m', strtotime($pd->tgl));
                                            $year = date('Y', strtotime($pd->tgl));
                                            $ttl = DB::selectOne("SELECT SUM(a.debit) as debit,SUM(a.kredit) as kredit  FROM `tb_jurnal` as a
                                                LEFT JOIN tb_permission_akun as b on a.id_akun = b.id_akun
                                                WHERE a.id_buku = '3'
                                                AND b.id_sub_menu_akun = '27'
                                                AND MONTH(a.tgl) = '$month'
                                                AND YEAR(a.tgl) = '$year'");
                                            ?>
                                            <td style="color: white; background-color: #435c77;"><strong><?= number_format($ttl->debit - $ttl->kredit, 0) ?></strong></td>
                                            <?php $total_pendapatan[] = $ttl->debit -  $ttl->kredit;$tKeluar += $ttl->debit -  $ttl->kredit; ?>
                                        <?php endforeach; ?>
                                        <td style="color: white; background-color: #435c77;"><?= number_format($tKeluar, 0) ?></td>
                                    </tr>

                                    <tr>
                                        <td style="color: white; background-color: #435c77;" colspan="30">
                                            <dt>Uang Keluar</dt>
                                        </td>
                                    </tr>
                                    @php
                                        $tl_saldo = 0;
                                    @endphp
                                    <?php foreach ($akun_pengeluaran as $ap) : ?>
                                        <tr>
                                            <td><?= $ap->nm_akun ?></td>
                                            @php
                                                $saldo = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where month(a.tgl) = $month and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");
                                            @endphp
                                            <?php foreach ($periode as $pd) : ?>
                                                <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $tgl_awal = date('Y-m-01', strtotime($pd->tgl));
                                                $tgl_akhir = date('Y-m-t', strtotime($pd->tgl));

                                                $jurnal = DB::selectOne("SELECT a.id_jurnal, a.id_akun , c.nm_akun, a.kd_gabungan, sum(a.debit) as debit , sum(a.kredit) as kredit
                                                        FROM tb_jurnal AS a
                                                        LEFT JOIN tb_akun AS c ON c.id_akun = a.id_akun
                                                        WHERE a.id_akun = '$ap->id_akun' and  MONTH(a.tgl) ='$month' AND YEAR(a.tgl) = '$year'
                                                        GROUP BY a.id_akun");
                                                
                                                ?>
                                                <td>
                                                    <a href="#" class="btn_detail2" data-toggle="modal" data-target="#id_akun" id_akun="<?= $ap->id_akun ?>" bulan="<?= $month ?>" tahun="<?= $year ?>">
                                                        <?= empty($jurnal->id_akun) ? 0 : number_format($jurnal->debit, 0)  ?> </a>
                                                </td>

                                                <?php
                                                    
                                                endforeach; ?>
                                                <td><?= number_format($tl_saldo, 0) ?></td>
                                            </tr>
                                        <?php
                                            
                                                // $ttl += $jurnal->debit - $jurnal->kredit;
                                            
                                        endforeach ?>
                                        <!-- BATAS -->
                                    <tr>
                                        <td style="color: white; background-color: #435c77;"><strong>Total uang keluar</strong></td>
                                        <?php
                                        $total_pendapatan = [];
                                        foreach ($periode as $pd) : ?>
                                            <?php
                                            $month = date('m', strtotime($pd->tgl));
                                            $year = date('Y', strtotime($pd->tgl));
                                            $ttl = DB::selectOne("SELECT SUM(a.debit) as debit,SUM(a.kredit) as kredit  FROM `tb_jurnal` as a
                                                LEFT JOIN tb_permission_akun as b on a.id_akun = b.id_akun
                                                WHERE a.id_buku = '3'
                                                AND b.id_sub_menu_akun = '27'
                                                AND MONTH(a.tgl) = '$month'
                                                AND YEAR(a.tgl) = '$year'");
                                             ?>
                                            <td style="color: white; background-color: #435c77;"><strong><?= number_format($ttl->debit - $ttl->kredit, 0) ?></strong></td>
                                            <?php $total_pendapatan[] = $ttl->debit -  $ttl->kredit; ?>
                                        <?php endforeach; ?>
                                        <td style="color: white; background-color: #435c77;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="50">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="color: white; background-color: #435c77;" colspan="30">
                                            <dt>liabilites (credit side)</dt>
                                        </td>
                                    </tr>
                                    <?php foreach ($liabilities as $ap) : ?>
                                        <tr>
                                            <td><?= $ap->nm_akun ?></td>
                                            <?php foreach ($periode as $pd) : ?>
                                                <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $jml = DB::selectOne("SELECT SUM(a.debit) as debit,SUM(a.kredit) as kredit  FROM `tb_jurnal` as a
                                                LEFT JOIN tb_permission_akun as b on a.id_akun = b.id_akun
                                                WHERE b.id_akun = '$ap->id_akun'
                                                AND a.id_buku = '3'
                                                AND b.id_sub_menu_akun = '28'
                                                AND MONTH(a.tgl) = '$month'
                                                AND YEAR(a.tgl) = '$year'");
                                                
                                                $debit = $jml->debit;
                                                $kredit = $jml->kredit;

                                                $jumlah_p = $kredit - $debit;

                                                if (!$jumlah_p) {
                                                    $jumlah_p = 0;
                                                }

                                                $t_pemasukan += $jumlah_p;

                                                ?>
                                                <td><?= number_format($jumlah_p, 0) ?></td>

                                            <?php endforeach; ?>
                                            <td></td>
                                        </tr>
                                    <?php endforeach ?>
                                    <tr>
                                        <td style="color: white; background-color: #435c77;"><strong>Total</strong></td>
                                        <?php
                                        $total_pendapatan = [];
                                        foreach ($periode as $pd) : ?>
                                            <?php
                                            $month = date('m', strtotime($pd->tgl));
                                            $year = date('Y', strtotime($pd->tgl));
                                            $ttl = DB::selectOne("SELECT SUM(a.debit) as debit,SUM(a.kredit) as kredit  FROM `tb_jurnal` as a
                                                LEFT JOIN tb_permission_akun as b on a.id_akun = b.id_akun
                                                WHERE a.id_buku = '3'
                                                AND b.id_sub_menu_akun = '28'
                                                AND MONTH(a.tgl) = '$month'
                                                AND YEAR(a.tgl) = '$year'");
                                            ?>
                                            <td style="color: white; background-color: #435c77;"><strong><?= number_format($ttl->kredit - $ttl->debit, 0) ?></strong></td>
                                            <?php $total_pendapatan[] = $ttl->kredit - $ttl->debit; ?>
                                        <?php endforeach; ?>
                                        <td style="color: white; background-color: #435c77;"></td>
                                    </tr>


                                </tbody>

                                <!-- end Aktiva Gantung -->


                            </table>
                            <!-- </div> -->

                        </div>

                    </div>
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

@endsection
@section('script')
<script>
    $(document).ready(function () {
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
        $("#detail").load("{{ route('getDetailLap') }}?id_akun=" + id_akun + "&bulan=" + bulan + "&tahun=" +
            tahun, "data"
            , function(response, status, request) {
                this; // dom element

            });
        });

    });
    
</script>
@endsection