@extends('accounting.template.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
               
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                  @include('accounting.template.flash')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="float-left">{{ $title }}</h5>
                        </div>
                        <div class="card-body">
                            <div id="table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-striped dataTable no-footer" id="example2" role="grid"
                                            aria-describedby="table_info">
                                            <thead>
                                                <tr class="table-info">
                                                    <th>#</th>
                                                    <th>Nama User</th>
                                                    <th>Role</th>
                                                    <th>Tanggal Input</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($user as $j)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{$j->nama}}</td>
                                                    @if ($j->username == 'aldi' || $j->username == 'nanda' || $j->username == 'herry' || $j->username == 'linda')
                                                    <td>Presiden</td>
                                                    @else
                                                    <td>Admin</td>
                                                    @endif
                                                    <td>{{ date('Y-m-d', strtotime($j->created_at)) }}</td>
                                                    <td>Aktif</td>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#akses<?= $j->id ?>" class="btn btn-info"><i class="fas fa-key"></i></a>
                                                       
                                                    </td>
                                                </tr> 
                                                @endforeach
                                            
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

{{-- hak akses --}}
<?php foreach ($user as $a) : ?>
        <form action="<?= route('accPermission') ?>" method="post">
            @csrf
            <div class="modal fade" id="akses<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <input type="hidden" name="id_user" value="<?= $a->id ?>">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title" id="exampleModalLabel">Permission</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Sub Menu</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $menu = DB::table('tb_acc_menu')->get();
                                    @endphp
                                    <?php foreach ($menu as $m) : ?>

                                        <tr>
                                            <td style="vertical-align: middle;"><?= $m->menu ?></td>
                                            <td>
                                                <?php $sub = DB::table('tb_acc_sub_menu')->where('id_menu', $m->id_menu)->get(); ?>
                                                <?php foreach ($sub as $s) : ?>
                                                    <?= $s->sub_menu ?> <br>
                                                <?php endforeach ?>
                                            </td>
                                            <td>
                                                <?php foreach ($sub as $s) : ?>
                                                    <?php $menu_p = DB::selectOne("SELECT a.permission
                                                FROM tb_acc_permission AS a
                                                WHERE a.permission = '$s->id_sub_menu' AND a.id_user = '$a->id'") ?>
                                                    <?php if (empty($menu_p)) : ?>
                                                        <input type="checkbox" name="permission[]" value="<?= $s->id_sub_menu ?>" id=""><br>
                                                    <?php else : ?>
                                                        <input type="checkbox" name="permission[]" value="<?= $s->id_sub_menu ?>" checked><br>
                                                    <?php endif ?>

                                                <?php endforeach ?>
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
    <?php endforeach ?>
@endsection