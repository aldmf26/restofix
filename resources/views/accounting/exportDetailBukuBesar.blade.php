<?php
$lokasi = $id_lokasi == 1 ? 'Takemori' : 'Soondobu';
$file = "Detail buku besar $lokasi.xls";
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=$file");
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <title>Detail buku</title>
</head>

<body>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>Nama Akun : <?= $akun->nm_akun ?> </p>
                    <table class="table mt-2" id="example1" border="1">
                        <thead>
                            <tr>
                                <th class="sticky-top th">Id jurnal</th>
                                <th class="sticky-top th">No Nota</th>
                                <th class="sticky-top th">Tanggal</th>
                                <th class="sticky-top th">Post Center</th>
                                <th class="sticky-top th">Keterangan</th>
                                <th class="sticky-top th">Post Akun 2</th>
                                <th class="sticky-top th">Keterangan 2</th>
                                <th class="sticky-top th">Debit</th>
                                <th class="sticky-top th">Kredit</th>
                                <th class="sticky-top th">Saldo</th>

                            </tr>
                        </thead>
                        @php
                            if (empty($neraca)) {
                                $debit_saldo = 0;
                                $kredit_saldo = 0;
                            } else {
                                $debit_saldo = $neraca->debit;
                                $kredit_saldo = $neraca->kredit;
                            }
                        @endphp
                        <tbody>


                            <?php $total_debit = 0;
                            $total_kredit = 0;
                            $total_saldo = 0;
                            $saldo1 = 0;
                            $no = 1;
                            ?>

                            @if (empty($neraca))
                            @else
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td style="white-space: nowrap;"></td>
                                    <td>{{ date('d/m/Y', strtotime($neraca->tgl)) }}</td>
                                    <td></td>
                                    <td>Neraca Saldo Awal</td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right;"><?= number_format($neraca->debit, 0) ?></td>
                                    <td style="text-align: right;"><?= number_format($neraca->kredit, 0) ?></td>
                                    <td><?= number_format($debit_saldo + $kredit_saldo, 0) ?></td>
                                </tr>
                            @endif
                            @if ($id_akun == 174 || $id_akun == 175)
                                @php
                                    $dp = DB::select("SELECT *,sum(a.debit) as debitDp, SUM(a.kredit) as kreditDp FROM tb_jurnal as a left join tb_post_center as c on a.id_post = c.id_post
        LEFT JOIN(SELECT tb_jurnal.id_akun, GROUP_CONCAT(DISTINCT tb_jurnal.ket SEPARATOR ', ') as ket2,
        GROUP_CONCAT(DISTINCT b.nm_akun SEPARATOR ', ') as ket3, kd_gabungan
        FROM tb_jurnal
        LEFT JOIN tb_akun AS b ON b.id_akun = tb_jurnal.id_akun
        WHERE debit > 0 GROUP BY kd_gabungan) jurnal2 ON a.kd_gabungan = jurnal2.kd_gabungan and jurnal2.id_akun != a.id_akun
        where a.id_akun = '$id_akun' and a.tgl between '$tgl1' and '$tgl2'
        GROUP BY a.ket
        order by a.tgl DESC;");
                                @endphp
                                @foreach ($dp as $b)
                                    <?php
                                    
                                    $saldo = $b->debit - $b->kredit;
                                    $saldo1 += $saldo;
                                    $total_debit += $b->debit;
                                    $total_kredit += $b->kredit;
                                    // $total_saldo += $saldo;
                                    ?>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td style="white-space: nowrap;">{{ $b->no_nota }}</td>
                                        <td>{{ date('d/m/Y', strtotime($b->tgl)) }}</td>
                                        <td>{{ $b->nm_post }}</td>
                                        <td><?= $b->ket ?></td>
                                        <td><?= $b->ket3 ?></td>
                                        <td><?= $b->ket2 ?></td>
                                        <td style="text-align: right;"><?= number_format($b->debitDp, 0) ?></td>
                                        <td style="text-align: right;"><?= number_format($b->kreditDp, 0) ?></td>
                                        <td><?= number_format($saldo1, 0) ?></td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach ($buku as $b)
                                    <?php
                                    
                                    $saldo = $b->debit - $b->kredit;
                                    $saldo1 += $saldo;
                                    $total_debit += $b->debit;
                                    $total_kredit += $b->kredit;
                                    // $total_saldo += $saldo;
                                    ?>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td style="white-space: nowrap;">{{ $b->no_nota }}</td>
                                        <td>{{ date('d/m/Y', strtotime($b->tgl)) }}</td>
                                        <td>{{ $b->nm_post }}</td>
                                        <td><?= $b->ket ?></td>
                                        <td><?= $b->ket3 ?></td>
                                        <td><?= $b->ket2 ?></td>
                                        <td style="text-align: right;"><?= number_format($b->debit, 0) ?></td>
                                        <td style="text-align: right;"><?= number_format($b->kredit, 0) ?></td>
                                        <td><?= number_format($saldo1, 0) ?></td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                        <tfoot>
                            <tr>
                                <td style="font-weight: bold;" colspan="7">Total</td>
                                <td style="font-weight: bold;"><?= number_format($total_debit + $debit_saldo, 0) ?></td>
                                <td style="font-weight: bold;"><?= number_format($total_kredit + $kredit_saldo, 0) ?>
                                </td>
                                <td style="font-weight: bold;">
                                    <?= number_format($saldo1 + ($debit_saldo + $kredit_saldo), 0) ?></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>

</body>

</html>
