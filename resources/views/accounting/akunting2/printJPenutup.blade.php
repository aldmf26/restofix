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
        <div class="row justify-content-center mt-5">
            <div class="col-lg-12">
                <center>
                    <h3>Laporan jurnal penutup</h3>
                </center>
            </div>
            <div class="col-lg-10 mt-2">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Post Akun</th>
                            <th>Ref</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $debit = 0;
                        $kredit = 0;
                        foreach ($penutup_pendapatan as $p) :
                            $debit += $p->debit;
                            $kredit += $p->kredit
                        ?>
                            <tr>
                                <td><?= $p->tgl ?></td>
                                <td><?= $p->nm_akun ?></td>
                                <td><?= $p->no_akun ?></td>
                                <td><?= number_format($p->debit, 0) ?></td>
                                <td><?= number_format($p->kredit, 0) ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td></td>
                            <td>Ikhtisar laba rugi</td>
                            <td></td>
                            <td><?= number_format($kredit, 0) ?></td>
                            <td><?= number_format($debit, 0) ?></td>
                        </tr>
                        <?php $debit1 = 0;
                        $kredit1 = 0;
                        foreach ($penutup_biaya as $e) :
                            $debit1 += $e->debit;
                            $kredit1 += $e->kredit
                        ?>

                        <?php endforeach ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?= $e->tgl ?></td>
                            <td>Ikhtisar laba rugi</td>
                            <td></td>
                            <td><?= number_format($kredit1, 0) ?></td>
                            <td><?= number_format($debit1, 0) ?></td>
                        </tr>
                        <?php foreach ($penutup_biaya as $e) : ?>
                            <tr>
                                <td><?= $e->tgl ?></td>
                                <td><?= $e->nm_akun ?></td>
                                <td><?= $e->no_akun ?></td>
                                <td><?= number_format($e->debit, 0) ?></td>
                                <td><?= number_format($e->kredit, 0) ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?= $e->tgl ?></td>
                            <td>Ikhtisar laba rugi</td>
                            <td></td>
                            <td><?= number_format($modal->kredit, 0) ?></td>
                            <td>0</td>
                        </tr>

                        <tr>
                            <td><?= $modal->tgl ?></td>
                            <td><?= $modal->nm_akun ?></td>
                            <td><?= $modal->no_akun ?></td>
                            <td>0</td>
                            <td><?= number_format($modal->kredit, 0) ?></td>
                        </tr>


                        <?php if (empty($prive)) : ?>

                        <?php else : ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><?= $modal->tgl ?></td>
                                <td><?= $modal->nm_akun ?></td>
                                <td><?= $modal->no_akun ?></td>
                                <td><?= number_format($modal->debit, 0) ?></td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td><?= $prive->tgl ?></td>
                                <td><?= $prive->nm_akun ?></td>
                                <td><?= $prive->no_akun ?></td>
                                <td>0</td>
                                <td><?= number_format($prive->kredit, 0) ?></td>
                            </tr>
                        <?php endif ?>

                    </tbody>

                </table>
            </div>
        </div>
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