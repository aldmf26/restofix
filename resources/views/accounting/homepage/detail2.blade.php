<?php $debit = 0;
$kredit = 0;
foreach ($jurnal as $j) :
    $debit += $j->debit;
    $kredit += $j->kredit;
?>
<?php endforeach ?>
<h5><?= $akun->nm_akun ?></h5>
<br>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>No nota</th>
            <th>Post Akun</th>
            <th>Post Center</th>
            <th>Keterangan</th>
            <th>Debit <br>
                (<?= number_format($debit, 0)  ?>)
            </th>
            <th>Kredit <br>
                (<?= number_format($kredit, 0)   ?>)
            </th>
        </tr>
    </thead>
    <tbody>
        <?php $i =  1;
        foreach ($jurnal as $j) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= date('d/m/Y', strtotime($j->tgl)) ?></td>
                <td><?= $j->no_nota ?></td>
                <td><?= $j->akun2 ?></td>
                <td><?= $j->nm_post ?></td>
                <td><?= $j->ket ?></td>
                <td><?= number_format($j->debit, 0) ?></td>
                <td><?= number_format($j->kredit, 0) ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>