
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Print Laporan</title>
</head>

<body>
    <div class="container">
        <?php
                        $date = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                        $bulan = ['bulan', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        $bulan1 = (int)$month;
                        ?>
        <?php $i = 1; ?>
                            <?php $pph = 0; ?>
                            <?php $total_pendapatan_bunga = 0; ?>
                            <table class="table table-sm">
                                <tbody>
                                    <tr class="text-center">
                                        <th></th>
                                        <th colspan="3">AGRILARAS</th>
                                        <th colspan="2"></th>
                                    </tr>
                                    <tr class="text-center">
                                        <th></th>
                                        <th colspan="3">LAPORAN LABA RUGI</th>
                                        <th colspan="2"></th>
                                    </tr>
                                    <tr class="text-center">
                                        <th></th>
                                        <th colspan="3">PER <?= $date ?> <?= $bulan[$bulan1] ?> <?= $year ?></th>
                                        <th colspan="2"></th>
                                    </tr>
                                </tbody>
                            </table>
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
                                        $total_pendapatan += $p->kredit - $p->debit;
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td colspan="2"><?= $p->nm_akun ?></td>
                                            <td>Rp</td>
                                            <td style="text-align: right;"><?= number_format($p->kredit - $p->debit, 0) ?></td>
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
                                        $total_biaya += $p->debit - $p->kredit;
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td colspan="2"><?= $p->nm_akun ?></td>
                                            <td>Rp</td>
                                            <td style="text-align: right;"><?= number_format($p->debit - $p->kredit, 0) ?></td>
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
    


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        window.print();
    </script>
</body>

</html>

