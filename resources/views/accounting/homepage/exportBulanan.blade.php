<?php
// $lokasi = $id_lokasi == 1 ? 'TAKEMORI' : 'SOONDOBU';
// $file = "LAPORAN BULANAN $lokasi.xls";
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=$file");
?>


{{-- ------------------------------------------------------------------------ --}}

<table class="table" border="1">
    <thead>

        <?php
        $t_pemasukan = 0;
        ?>

        <tr>
            <th class="sticky-top th-atas">Akun</th>
            <?php foreach ($periode as $key => $value) : ?>
            <?php $bulan = date('M-Y', strtotime($value->tgl)); ?>
            <th class="sticky-top th-atas"><?= $bulan ?></th>
            <?php endforeach ?>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="color: #B7AEF7;">
                <dt>Pemasukan</dt>
            </td>
        </tr>
        @php
            $jumlah_p = 0;
        @endphp
        <?php foreach ($akun_pendapatan as $ap) : ?>

        <tr>
            <td><?= $ap->nm_akun ?></td>
            <?php foreach ($periode as $pd) : ?>
            <?php
            $month = date('m', strtotime($pd->tgl));
            $year = date('Y', strtotime($pd->tgl));
            $jml = DB::selectOne("SELECT * FROM tb_neraca_saldo_penutup as a where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = $month and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");
            // $ket = $this->db->get_where(" tb_absen where nm_karyawan = '$kry->nm_kry' and tgl BETWEEN '$dt_c' AND '$dt_a' order by tgl ASC, nm_karyawan ")->result();
            $jumlah_p += empty($jml->kredit) ? '0' : $jml->kredit;
            
            ?>
            <td><?= empty($jml->kredit) ? '0' : number_format($jml->kredit, 0) ?></td>

            <?php endforeach; ?>
            <td></td>
        </tr>
        <?php endforeach ?>

        <tr>
            <td style="color: black;"><strong>Total Penjualan</strong></td>
            @php
                $total_pendapatan = 0;
            @endphp
            @foreach ($periode as $pd)
            <?php
            $month = date('m', strtotime($pd->tgl));
            $year = date('Y', strtotime($pd->tgl));
            $ttl = DB::selectOne("SELECT sum(a.kredit) as kredit_saldo FROM tb_neraca_saldo_penutup as a 
                                LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='21' ");
                                $total_pendapatan += empty($ttl->kredit_saldo) ? '0' : $ttl->kredit_saldo;
            ?>
            @endforeach
            <td style="color: black;"><strong><?= number_format($total_pendapatan, 0) ?></strong></td>
            <td></td>
        </tr>

    </tbody>

    <!-- total pengeluaran     -->
    <tbody>
        <tr>
            <td style="color: #B7AEF7;">
                <dt>Biaya Disesuaikan</dt>
            </td>
        </tr>
        @php
            $t_pengeluaran = 0;
        @endphp
        <?php foreach ($akun_pengeluaran as $ap) : ?>

        <tr>
            <td><?= $ap->nm_akun ?></td>
            <?php foreach ($periode as $pd) : ?>
            <?php
            $month = date('m', strtotime($pd->tgl));
            $year = date('Y', strtotime($pd->tgl));
            $jml = DB::selectOne("SELECT a.* FROM tb_neraca_saldo_penutup as a where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = $month and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");
                $t_pengeluaran += empty($jml->debit) ? '0' : $jml->debit;
            
            ?>
            <td><?= empty($jml->debit) ? '0' : number_format($jml->debit, 0) ?></td>

            <?php endforeach; ?>
            <td></td>
        </tr>
        <?php endforeach ?>

        <tr>
            <td style="color: black;"><strong>Total Biaya Disesuaikan</strong></td>
            @php
                $total_biaya = 0;
            @endphp
            @foreach ($periode as $pd)
            <?php
            $month = date('m', strtotime($pd->tgl));
                $year = date('Y', strtotime($pd->tgl));
                $ttl = DB::selectOne("SELECT sum(a.debit) as debit_saldo FROM tb_neraca_saldo_penutup as a 
                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                    where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='22' "); 
                                    $total_biaya += $ttl->debit_saldo;
            ?>
            @endforeach
            <td style="color: black;"><strong><?= number_format($total_biaya, 0) ?></strong></td>
            <td></td>
        </tr>

    </tbody>

    <tbody>
        <tr>
            <td style="color: #B7AEF7;">
                <dt>Biaya Utama</dt>
            </td>
        </tr>
        @php
            $t_pengeluaran = 0;
        @endphp
        <?php foreach ($akun_biaya_fix as $ap) : ?>

        <tr>
            <td><?= $ap->nm_akun ?></td>
            <?php foreach ($periode as $pd) : ?>
            <?php
            $month = date('m', strtotime($pd->tgl));
                $year = date('Y', strtotime($pd->tgl));
                $jml = DB::selectOne("SELECT a.* FROM tb_neraca_saldo_penutup as a where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = $month and YEAR(a.tgl) = '$year' and a.id_akun = '$ap->id_akun'");
                $t_pengeluaran += empty($jml->debit) ? '0' : $jml->debit;
            
            ?>
            <td><?= empty($jml->debit) ? 0 : number_format($jml->debit, 0) ?></td>

            <?php endforeach; ?>
            <td></td>
        </tr>
        <?php endforeach ?>

        <tr>
            <td style="color: black;"><strong>Total Biaya Utama</strong></td>
            @php
                $total_biaya1 = 0;
            @endphp
            @foreach ($periode as $pd)
            <?php
            $month = date('m', strtotime($pd->tgl));
                $year = date('Y', strtotime($pd->tgl));
                $ttl = DB::selectOne("SELECT sum(a.debit) as debit_saldo FROM tb_neraca_saldo_penutup as a 
                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                    where a.id_lokasi = '$id_lokasi' and month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='23' ");
                                    $total_biaya1 += empty($jml->debit_saldo) ? '0' : $jml->debit_saldo;
            ?>
            @endforeach
            <td style="color: black;"><strong><?= number_format($total_biaya1, 0) ?></strong></td>
            <td></td>
        </tr>

    </tbody>

    <tbody>
        <tr>
            <td style="color: #B7AEF7;">
                <dt>Laporan Laba Rugi</dt>
            </td>
        </tr>
        <tr>
            <td>Laba bersih sebelum pajak</td>
        </tr>
        @php
            $t_laba = 0;
        @endphp
        <?php foreach ($akun_biaya_fix as $ap) : ?>

        <tr>
            <td><?= $ap->nm_akun ?></td>
            <?php foreach ($periode as $pd) : ?>
            <?php
           $month = date('m', strtotime($pd->tgl));
                $year = date('Y', strtotime($pd->tgl));
                $ttl = DB::selectOne("SELECT sum(a.debit) as debit_saldo FROM tb_neraca_saldo_penutup as a 
                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                    where a.id_lokasi = '$id_lokasi' AND  month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='23' ");
                $ttl2 = DB::selectOne("SELECT sum(a.debit) as debit_saldo FROM tb_neraca_saldo_penutup as a 
                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                    where a.id_lokasi = '$id_lokasi' AND  month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='22' ");
                $ttl3 = DB::selectOne("SELECT sum(a.kredit) as kredit_saldo FROM tb_neraca_saldo_penutup as a 
                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                    where a.id_lokasi = '$id_lokasi' AND month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='21' ");
                                    $t_laba += $ttl3->kredit_saldo - ($ttl->debit_saldo + $ttl2->debit_saldo);
            
            ?>
            <td><?= number_format($ttl3->kredit_saldo - ($ttl->debit_saldo + $ttl2->debit_saldo), 0) ?></td>

            <?php endforeach; ?>
            <td></td>
        </tr>
        <?php endforeach ?>

        <tr>
            <td style="color: black;"><strong>Laba Bersih</strong></td>
            @php
                $total_biaya1 = 0;
            @endphp
            @foreach ($periode as $pd)
            <?php
            $month = date('m', strtotime($pd->tgl));
                $year = date('Y', strtotime($pd->tgl));
                $ttl = DB::selectOne("SELECT sum(a.debit) as debit_saldo FROM tb_neraca_saldo_penutup as a 
                                    LEFT JOIN tb_permission_akun AS b ON b.id_akun = a.id_akun
                                    where a.id_lokasi = '$id_lokasi' and month(a.tgl) = '$month' and YEAR(a.tgl) = '$year' AND b.id_sub_menu_akun ='23' ");
                                    $total_biaya1 += empty($jml->debit_saldo) ? '0' : $jml->debit_saldo;
            ?>
            @endforeach
            <td style="color: black;"><strong><?= number_format($total_biaya1, 0) ?></strong></td>
            <td></td>
        </tr>

    </tbody>

</table>
