<?php
$lokasi = $id_lokasi == 1 ? 'Takemori' : 'Soondobu';
$file = "List Barang Atk dan perlengkapan $lokasi" . ".xls";
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=$file");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>
        <center>List Barang ATK dan Perlengkapan</center>
    </h3>
    <center>
        <table border="1" style="border-collapse: collapse;">
            <thead>
                <th>Nama Barang</th>
                <th>Stok sisa</th>
                <th>Satuan</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </thead>
            <tbody>
                <?php foreach ($atk as $a) : ?>
                    <?php if (($a->qty_debit - $a->qty_kredit) <= '0') : ?>
                    <?php else : ?>
                        <tr>
                            <td><?= $a->nm_barang ?></td>
                            <td><?= $a->qty_debit - $a->qty_kredit ?></td>
                            <td><?= $a->n ?></td>
                            <td><?= $a->debit_atk / $a->qty_debit  ?></td>
                            <td><?= ($a->qty_debit - $a->qty_kredit) * ($a->debit_atk / $a->qty_debit)   ?></td>
                        </tr>
                    <?php endif ?>

                <?php endforeach ?>
            </tbody>

        </table>
    </center>

</body>

</html>