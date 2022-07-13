@extends('accounting.template.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <!-- <a href="" data-toggle="modal" data-target="#modal-akses">
            <div class="btn btn-success btn-block"> Hak Akses</div>
          </a> -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        @include('accounting.template.flash')
        <div class="content" style="background-color: white;">
            <div class="row">
                <div class="col-6">
                    <div class="card-header">
                        <h5 class="float-left">Data Menu</h5>
                        <a href="" class="btn btn-info float-right " data-target="#tambah_menu" data-toggle="modal">Tambah Menu</a>
                        <a href="" class="btn btn-info float-right mr-2" data-target="#urutan" data-toggle="modal">Urutan</a>
                    </div>
                    <div class="card-body">

                        <table id="menu1" class="table table-striped" width="100%">
                            <thead style="background-color: white;">
                                <tr>
                                    <th>#</th>
                                    <th>Icon</th>
                                    <th>Nama Menu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($menu as $d) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><i class="<?= $d->icon; ?>"></i></td>
                                        <td><?= $d->menu; ?></td>
                                        <td>
                                            <a href="" class="btn btn-info" data-toggle="modal" data-target="#edit_menu<?= $d->id_menu ?>"><i class="fas fa-edit"></i></a>
                                            <a href="<?= route("deleteAccMenu", ['id_menu' => $d->id_menu]) ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>


                </div>
                <div class="col-6">
                    <div class="card-header">
                        <h5 class="float-left">Data Sub Menu</h5>
                        <a href="" data-target="#tambah_sub_menu" data-toggle="modal" class="btn btn-info float-right ">Tambah Sub Menu</a>
                    </div>
                    <div class="card-body">
                        <table id="menu2" class="table table-striped" width="100%">
                            <thead style="background-color: white;">
                                <tr>
                                    <th>#</th>
                                    <th>Menu</th>
                                    <th>Nama Sub Menu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($sub_menu as $d) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $d->menu ?></td>
                                        <td><?= $d->sub_menu; ?></td>
                                        <td style="white-space: nowrap;">
                                            <a href="" data-toggle="modal" data-target="#edit_sub<?= $d->id_sub_menu ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            <a href="<?= route("deleteAccSubMenu", ['idSubMenu' => $d->id_sub_menu]) ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

{{-- tambah acc menu--}}
<form action="<?= route('saveAccMenu') ?>" method="post">
    @csrf
    <div class="modal fade" id="tambah_menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-costume">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_lokasi" value="{{ Request::get('acc') }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">Nama Menu</label>
                            <input type="text" name="menu" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Icon</label>
                            <input type="text" name="icon" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save/Edit</button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- urutan --}}
<form action="<?= route('saveMenuUrutan') ?>" method="post">
    @csrf
    <div class="modal fade" id="urutan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-costume">
                    <h5 class="modal-title" id="exampleModalLabel">Urutan Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Menu</th>
                                <th>Urutan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menu as $a) : ?>
                                <tr>
                                    <td><?= $a->menu ?></td>
                                    <td>
                                        <input type="hidden" class="form-control" name="id_menu[]" value="<?= $a->id_menu ?>">
                                        <input type="text" class="form-control" name="urutan[]" value="<?= $a->urutan ?>">
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>


                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save/Edit</button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- save sub menu --}}
<form action="<?= route('saveAccSubMenu') ?>" method="post">
    @csrf
    <div class="modal fade" id="tambah_sub_menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-costume">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Nama Menu</label>
                            <select name="id_menu" id="" class="select2">
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m->id_menu ?>"><?= $m->menu ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Sub Menu</label>
                            <input type="text" name="sub_menu" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label for="">Url</label>
                            <input type="text" name="url" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save/Edit</button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- edit menu --}}
<?php foreach ($menu as $m) : ?>
    <form action="<?= route('editAccMenu') ?>" method="post">
        @csrf
        <div class="modal fade" id="edit_menu<?= $m->id_menu ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header bg-costume">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Nama Menu</label>
                                <input type="hidden" name="id_menu" value="<?= $m->id_menu ?>">
                                <input type="text" name="menu" value="<?= $m->menu ?>" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Icon</label>
                                <input type="text" name="icon" value="<?= $m->icon ?>" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save/Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php endforeach ?>

{{-- edit sub menu --}}
<?php foreach ($sub_menu as $s) : ?>
    <form action="<?= route('editSubMenu') ?>" method="post">
        @csrf
        <div class="modal fade" id="edit_sub<?= $s->id_sub_menu ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-costume">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Submenu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="hidden" name="id_sub_menu" value="<?= $s->id_sub_menu ?>">
                                <label for="">Nama Menu</label>
                                <select name="id_menu" id="" class="select2">
                                    <?php foreach ($menu as $m) : ?>
                                        <?php if ($s->id_menu == $m->id_menu) : ?>
                                            <option value="<?= $m->id_menu ?>" selected><?= $m->menu ?></option>
                                        <?php else : ?>
                                            <option value="<?= $m->id_menu ?>"><?= $m->menu ?></option>
                                        <?php endif ?>

                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="">Sub Menu</label>
                                <input type="text" name="sub_menu" value="<?= $s->sub_menu ?>" class="form-control">
                            </div>
                            <div class="col-lg-4">
                                <label for="">Url</label>
                                <input type="text" name="url" value="<?= $s->url ?>" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save/Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php endforeach ?>
@endsection
@section('script')
<script>
    $('#menu1').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "stateSave": true,
                });
    $('#menu2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "stateSave": true,
                });
</script>
@endsection