<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Atk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <h3>
        <center>List Barang ATK dan Perlengkapan</center>
    </h3>
    <br>
    <br>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <table class="table table-bordered">
                <thead style="text-align: center;">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Stok sisa</th>
                        <th>Satuan</th>
                        <th>Harga Satuan</th>
                        <th>Total</th>
                        <th>Stok Aktual</th>
                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($atk as $a) : ?>
                        <tr>
                            <?php if (($a->qty_debit - $a->qty_kredit) <= '0') : ?>
                            <?php else : ?>

                                <td style="text-align: center;"><?= $a->nm_barang ?></td>
                                <td style="text-align: right;"><?= $a->qty_debit - $a->qty_kredit ?></td>
                                <td style="text-align: center;"><?= $a->n ?></td>
                                <td style="text-align: right;"><?= $a->debit_atk / $a->qty_debit  ?></td>
                                <td style="text-align: right;"><?= ($a->qty_debit - $a->qty_kredit) * ($a->debit_atk / $a->qty_debit)   ?></td>
                                <td></td>
                            <?php endif ?>
                        </tr>

                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>




</body>

<script>
    window.print()
</script>

</html>