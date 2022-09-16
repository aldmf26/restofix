<style>
    .table1 {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
  background-color: transparent;
}

.table1 th,
.table1 td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}

.table1 thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}

.table1 tbody + tbody {
  border-top: 2px solid #dee2e6;
}

.table1-sm th,
.table1-sm td {
  padding: 0.3rem;
}
</style>
<div class="row">
    <div class="col-12">
        <table class="table1" id="tableJam">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No Order</th>
                    <th>Table</th>
                    <th>Menu</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Time Order</th>
                    <th>Server</th>
                    <th>Koki</th>
                    <th>Waitress</th>
                    <th>Time Delay</th>
                    <th>Status</th>
                    <th>Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
            foreach ($tb_order as $t) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $t->no_order ?></td>
                    <td><?= $t->nm_meja ?></td>
                    <td><?= $t->nm_menu ?></td>
                    <td><?= $t->qty ?></td>
                    <td><?= number_format($t->qty * $t->harga, 0) ?></td>
                    <?php $waktu1 = new DateTime($t->j_mulai); ?>
                    <?php $waktu2 = new DateTime($t->j_selesai); ?>
                    <td><?= $waktu1->format('h.i A') ?></td>
                    <td><?= $t->admin ?></td>
                    <td style="white-space: nowrap;">
                        <?= $t->koki1 ?>,<?= $t->koki2 ?>,<?= $t->koki3 ?></td>
                    <td><?= $t->pengantar ?></td>
                    <td><?= number_format($t->selisih, 0) ?></td>
                    <td><?= $t->selesai ?></td>
                    <td><?= $t->admin ?></td>
                    
                </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
</div>
