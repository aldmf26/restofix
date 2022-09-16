<ul class="nav nav-pills mb-3 custom-scrollbar-css" id="pills-tab" role="tablist">
    <?php 
    foreach ($distribusi as $d) : ?>
    <li class="nav-item">
        <?php if ($id == $d->id_distribusi) : ?>
        <?php if (empty($d->jumlah)) : ?>
        <a href="<?= route('head', ['id' => $d->id_distribusi]) ?>"
            class="nav-link active badge-notif"><strong><?= $d->nm_distribusi ?></strong></a>
        <?php else : ?>
        <a href="<?= route('head', ['id' => $d->id_distribusi]) ?>" data-badge="<?= $d->jumlah ?>"
            class="nav-link active badge-notif"><strong><?= $d->nm_distribusi ?></strong></a>
        <?php endif ?>
        <?php else : ?>
        <?php if (empty($d->jumlah)) : ?>
        <a href="<?= route('head', ['id' => $d->id_distribusi]) ?>"
            class="nav-link badge-notif"><strong><?= $d->nm_distribusi ?></strong></a>
        <?php else : ?>
        <a href="<?= route('head', ['id' => $d->id_distribusi]) ?>" data-badge="<?= $d->jumlah ?>"
            class="nav-link badge-notif"><strong><?= $d->nm_distribusi ?></strong></a>
        <?php endif ?>
        <?php endif ?>
    </li>
    <?php endforeach ?>
    <div class="float-right mr-5">
        <li nav-item>
            <button id="viewJam" data-toggle="modal" data-target="#summary" class="btn btn-sm btn-info mr-2">View 1 jam terakhir</button>
            <i class="fa fa-search"></i>
        </li>
        <li>
            <input autofocus type="search" class="form-control input-md" id="searchHead">
        </li>

        <li>
            <button type="button" id="btnSearch" class="btn btn-info btn-sm">Cari</button>
        </li>
    </div>
    <input type="hidden" id="jumlah1" value="<?= $orderan[0]->jml_order ?>">
</ul>
<style>
    .modal-lg-max2 {
        max-width: 1200px;
    }
</style>

