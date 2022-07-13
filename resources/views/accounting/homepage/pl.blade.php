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
                            <h4 class="float-left">Laporan Profit & Loss</h4>
                            

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
                                            <dt>Peredaran usaha</dt>
                                        </td>
                                    </tr>
                                    <?php foreach ($akun_pendapatan as $ap) : ?>
                                        <tr>
                                            <td><?= $ap->nm_akun ?></td>
                                            <?php foreach ($periode as $pd) : ?>
                                                <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $jml = DB::selectOne("SELECT SUM(a.debit) as debit,SUM(a.kredit) as kredit  FROM `tb_jurnal` as a
                                                LEFT JOIN tb_permission_akun as b on a.id_akun = b.id_akun
                                                WHERE b.id_akun = '$ap->id_akun'
                                                AND a.id_buku != '5'
                                                AND b.id_sub_menu_akun = '13'
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
                                        <td style="color: white; background-color: #435c77;"><strong>Total Pendapatan</strong></td>
                                        <?php
                                        $total_pendapatan = [];
                                        foreach ($periode as $pd) : ?>
                                            <?php
                                            $month = date('m', strtotime($pd->tgl));
                                            $year = date('Y', strtotime($pd->tgl));
                                            $ttl = DB::selectOne("SELECT SUM(a.debit) as debit,SUM(a.kredit) as kredit  FROM `tb_jurnal` as a
                                                LEFT JOIN tb_permission_akun as b on a.id_akun = b.id_akun
                                                WHERE a.id_buku != '5'
                                                AND b.id_sub_menu_akun = '13'
                                                AND MONTH(a.tgl) = '$month'
                                                AND YEAR(a.tgl) = '$year'");
                                            ?>
                                            <td style="color: white; background-color: #435c77;"><strong><?= number_format($ttl->kredit - $ttl->debit, 0) ?></strong></td>
                                            <?php $total_pendapatan[] = $ttl->kredit - $ttl->debit; ?>
                                        <?php endforeach; ?>
                                        <td style="color: white; background-color: #435c77;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="50">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="color: white; background-color: #435c77;"><strong>Total Pengeluaran</strong></td>
                                        <?php
                                        $total_pendapatan = [];
                                        foreach ($periode as $pd) : ?>
                                            <?php
                                            $month = date('m', strtotime($pd->tgl));
                                            $year = date('Y', strtotime($pd->tgl));
                                            $ttl = DB::selectOne("SELECT SUM(a.debit) as debit,SUM(a.kredit) as kredit  FROM `tb_jurnal` as a
                                                LEFT JOIN tb_permission_akun as b on a.id_akun = b.id_akun
                                                WHERE a.id_buku != '5'
                                                AND b.id_sub_menu_akun = '14'
                                                AND MONTH(a.tgl) = '$month'
                                                AND YEAR(a.tgl) = '$year'");
                                             ?>
                                            <td style="color: white; background-color: #435c77;"><strong><?= number_format($ttl->debit - $ttl->kredit, 0) ?></strong></td>
                                            <?php $total_pendapatan[] = $ttl->debit -  $ttl->kredit; ?>
                                        <?php endforeach; ?>
                                        <td style="color: white; background-color: #435c77;"></td>
                                    </tr>

                                    <tr>
                                        <td style="color: white; background-color: #435c77;" colspan="30">
                                            <dt>Biaya-biaya</dt>
                                        </td>
                                    </tr>
                                    <?php foreach ($akun_pengeluaran as $ap) : ?>
                                        <tr>
                                            <td><?= $ap->nm_akun ?></td>
                                            <?php foreach ($periode as $pd) : ?>
                                                <?php
                                                $month = date('m', strtotime($pd->tgl));
                                                $year = date('Y', strtotime($pd->tgl));
                                                $jml = DB::selectOne("SELECT SUM(a.debit) as debit,SUM(a.kredit) as kredit  FROM `tb_jurnal` as a
                                                LEFT JOIN tb_permission_akun as b on a.id_akun = b.id_akun
                                                WHERE b.id_akun = '$ap->id_akun'
                                                AND a.id_buku != '5'
                                                AND b.id_sub_menu_akun = '14'
                                                AND MONTH(a.tgl) = '$month'
                                                AND YEAR(a.tgl) = '$year'");
                                                
                                                $debit = $jml->debit;
                                                $kredit = $jml->kredit;

                                                $jumlah_p = $debit - $kredit;

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
                                        <td style="color: white; background-color: #435c77;"><strong>Laba bersih</strong></td>
                                        <?php
                                        foreach ($periode as $pd) : ?>
                                            <?php
                                            $month = date('m', strtotime($pd->tgl));
                                            $year = date('Y', strtotime($pd->tgl));
                                            $ttl_pendapatan = DB::selectOne("SELECT SUM(a.debit) as debit,SUM(a.kredit) as kredit  FROM `tb_jurnal` as a
                                                LEFT JOIN tb_permission_akun as b on a.id_akun = b.id_akun
                                                WHERE b.id_akun = '$ap->id_akun'
                                                AND a.id_buku != '5'
                                                AND b.id_sub_menu_akun = '13'
                                                AND MONTH(a.tgl) = '$month'
                                                AND YEAR(a.tgl) = '$year'");
                                            
                                            $ttl_pengeluaran = DB::selectOne("SELECT SUM(a.debit) as debit,SUM(a.kredit) as kredit  FROM `tb_jurnal` as a
                                                LEFT JOIN tb_permission_akun as b on a.id_akun = b.id_akun
                                                WHERE b.id_akun = '$ap->id_akun'
                                                AND a.id_buku != '5'
                                                AND b.id_sub_menu_akun = '14'
                                                AND MONTH(a.tgl) = '$month'
                                                AND YEAR(a.tgl) = '$year'");
                                             ?>
                                            <td style="color: white; background-color: #435c77;"><strong><?= number_format(($ttl_pendapatan->kredit - $ttl_pendapatan->debit) - ($ttl_pengeluaran->debit - $ttl_pengeluaran->kredit), 0) ?></strong></td>
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
@endsection
@section('script')
<script>
$("#search_bulanan").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tb_bulanan tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
</script> 
@endsection