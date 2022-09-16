<?php $debit = 0;
$kredit = 0;
foreach ($jurnal as $j) :
    $debit += $j->debit;
    $kredit += $j->kredit;
?>
<?php endforeach ?>

<table class="table">
    <thead>
        
        <tr>
            <th>No</th>
            <th>Post Akun</th>
            <th>Post Center</th>
            <th>Keterangan</th>
            <th>Debit <br>(<?= number_format($debit, 0) ?>)</th>
            <th>Kredit <br>(<?= number_format($kredit, 0) ?>)</th>
        </tr>
    </thead>
    <tbody>
        @if (empty($jurnalS))
        @else
        <tr>
            <td>1</td>
            <td><?= $jurnalS->nm_akun ?></td>
                <td></td>
                <td>Neraca Saldo Awal</td>
                <td><?= number_format($jurnalS->debit, 0) ?></td>
                <td><?= number_format($jurnalS->kredit, 0) ?></td>
        </tr>
        @endif
        <?php $i = empty($jurnalS) ? 1 : 2;
        foreach ($jurnal as $j) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $j->nm_akun ?></td>
                <td><?= $j->nm_post ?></td>
                <td><?= $j->ket ?></td>
                <td><?= number_format($j->debit, 0) ?></td>
                <td><?= number_format($j->kredit, 0) ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>