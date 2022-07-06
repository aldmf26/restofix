@extends('accounting.template.master')
@section('content')
<style>
    .modal-lg-max {
        max-width: 800px;
    }
    .modal-mds {
        max-width: 700px;
    }

</style>
    <!-- Content Wrapper. Contains page content -->
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
                                <h5 class="float-left">Data Akun</h5>
                                <a href="" data-toggle="modal" data-target="#import"
                                    class="btn btn-info btn-sm float-right mr-1"><i class="fas fa-file-import"></i> Import
                                    Akun</a>
                                <a href="{{ route('exportAkun', ['id_lokasi' => Request::get('acc')]) }}"
                                    class="btn btn-info btn-sm float-right mr-1"><i class="fas fa-file-export"></i> Export
                                    Excel</a>
                                <a href="" data-toggle="modal" data-target="#tambah"
                                    class="btn btn-info btn-sm float-right mr-1"><i class="fas fa-plus"></i> Tambah
                                    Akun</a>
                                <a href="" data-toggle="modal" data-target="#kategori"
                                    class="btn btn-info btn-sm float-right mr-1">Kategori
                                    Akun</a>
                            </div>
                            <div class="card-body">
                                <div id="table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table dataTable no-footer" id="table1" role="grid"
                                                aria-describedby="table_info">
                                                <thead>
                                                    <tr role="row" class="table-info">
                                                        <th>#</th>
                                                        <th>No Akun</th>
                                                        <th>Akun</th>
                                                        <th>Kategori</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach ($akun as $a)
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td>{{ $a->no_akun }}</td>
                                                            <td>{{ $a->nm_akun }}</td>
                                                            <td>{{ $a->nm_kategori }}</td>
                                                            <td align="center">
                                                                <a href="#" data-toggle="modal" data-target="#edit<?= $a->id_akun ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                                <a href="#" data-toggle="modal" data-target="#akses<?= $a->id_akun ?>" class="btn btn-info btn-sm"><i class="fas fa-key"></i> Relasi akun</a>
                                                                <a href="#" data-target="#add_post_center{{$a->id_akun}}" data-toggle="modal"
                                                                    class="btn btn-secondary btn-sm btnPs" id_lokasi="{{Request::get('acc')}}" id_akun="{{ $a->id_akun }}"><i class="fas fa-map-pin"></i> Post
                                                                    Center</a>
                                                                {{-- <a href="#" data-toggle="modal" data-target="#edit{{$a->id_akun}}" class="btn btn-sm btn-outline-secondary"><i
                                                                        class="fa fa-edit"></i></a> --}}
                                                                <a href="" class="btn btn-sm btn-secondary">Relation</a>
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
    <style>
        .modal-lg-max {
            max-width: 1000px;
        }

    </style>

    {{-- relasi akun --}}
    @foreach ($akun as $a)
    <form action="<?= route('relasiAkun') ?>" method="post">
        @csrf
        <div class="modal fade" id="akses<?= $a->id_akun ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <input type="hidden" name="kd_akun" value="<?= $a->id_akun ?>">
                <input type="hidden" name="id_lokasi" value="<?= Request::get('acc') ?>">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="exampleModalLabel">Relasi akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>
                            <dt>Relasi akun : <?= $a->nm_akun ?> </dt>
                        </h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Menu Akun</th>
                                    <th>Sub Menu Akun</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($menu_akun as $m) : ?>
                                    <tr>
                                        <td><?= $m->nm_menu_akun ?></td>
                                        <td>
                                            <?php $sub = DB::table('sub_menu_akun')->where('id_menu_akun', $m->id_menu_akun)->get(); ?>
                                            <?php foreach ($sub as $s) : ?>
                                                <?= $s->sub_menu_akun ?> <br>
                                            <?php endforeach ?>
                                        </td>
                                        <td>
                                            <?php foreach ($sub as $s) : ?>
                                                <?php $menu_p = DB::selectOne("SELECT a.id_sub_menu_akun
                                                    FROM tb_permission_akun AS a
                                                    WHERE a.id_sub_menu_akun = '$s->id_sub_akun' AND a.id_akun = '$a->id_akun'") ?>
                                                <?php if (empty($menu_p)) : ?>
                                                    <input type="checkbox" name="id_sub_menu_akun[]" value="<?= $s->id_sub_akun ?>" id=""><br>
                                                <?php else : ?>
                                                    <input type="checkbox" name="id_sub_menu_akun[]" value="<?= $s->id_sub_akun ?>" checked><br>
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
    @endforeach
    {{-- -------------------- --}}

    {{-- add post center --}}
    @foreach ($akun as $a)
    <form action="{{ route('addPostCenter') }}" method="post">
        @csrf
        <div class="modal fade" id="add_post_center{{$a->id_akun}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="exampleModalLabel">Post Center</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id_lokasi" id="id_lokasi" value="{{Request::get('acc')}}">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id_akun" id="id_akun_post" value="{{$a->id_akun}}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="list_kategori">Nama Post Center</label>
                                    <input class="form-control" type="text" name="nm_post" required>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table data-table table-striopped" id="tb_post1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Post center</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                            $ps = DB::table('tb_post_center')->where('id_akun', $a->id_akun)->get();
                                        @endphp
                                        @foreach ($ps as $p)                      
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{ $p->nm_post }}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div id="form_post_center"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Input</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endforeach
    {{-- add --}}
    {{-- add akun --}}
    <form action="{{ route('addAkun') }}" method="post" accept-charset="utf-8">
        @csrf
        <div class="modal fade" id="tambah" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header btn-costume">
                        <h5 class="modal-title text-light" id="exampleModalLabel">tambah Akun</h5>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" name="id_lokasi" value="{{Request::get('acc')}}">
                                <div class="form-group">
                                    <label for="">No Akun</label>
                                    <input type="text" autofocus placeholder="Cth: 1200,3" name="no_akun"
                                        class="form-control">
                                    <span class="text-warning" style="font-size: 15px"><em>Harus sesuai kode
                                            akuntan</em></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Nama Akun</label>
                                    <input type="text" name="nm_akun" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Kode Akun</label>
                                    <input type="text" name="kd_akun" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Kategori Akun</label>
                                    @php
                                        $akunk = DB::table('tb_kategori_akun')->get();
                                    @endphp
                                    <select class="form-control select" name="id_kategori" id="">
                                        @foreach ($akunk as $a)
                                            <option value="{{ $a->id_kategori }}">{{ $a->nm_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- ------------------------ --}}

    {{-- kategori akun --}}
    <form action="{{ route('addKategoriAkun') }}" method="post" accept-charset="utf-8">
        @csrf
        <div class="modal fade" id="kategori" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header btn-costume">
                        <h5 class="modal-title" id="exampleModalLabel">Kategori Akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table" id="katAkun">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Kategori Akun</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $katakun = DB::table('tb_kategori_akun')->get();
                                    $no = 1;
                                @endphp
                                <tr>
                                    <td></td>
                                    <input type="hidden" name="id_lokasi" value="{{Request::get('acc')}}">
                                    <td><input autofocus type="text" class="form-control" name="nm_kategori"></td>
                                    <td><button type="submit" class="btn btn-success">Save</button></td>
                                </tr>
                                @foreach ($katakun as $k)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $k->nm_kategori }}</td>
                                        <td>
                                            <a href="{{ route('delKetAkun', ['id_kategori' => $k->id_kategori, 'id_lokasi' => Request::get('acc')]) }}" class="btn btn-sm btn-outline-secondary"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- -------------------------- --}}

    {{-- edit akun --}}
    @foreach ($akun as $a)

    <form action="{{ route('editAkun') }}" method="post" accept-charset="utf-8">
        @csrf
        @method('patch')
        <div class="modal fade" id="edit{{$a->id_akun}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header btn-costume">
                        <h5 class="modal-title text-light" id="exampleModalLabel">tambah Akun</h5>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id_lokasi" value="{{Request::get('acc')}}">
                            <input type="hidden" name="id_akun" value="{{$a->id_akun}}">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">No Akun</label>
                                    <input type="text" value="{{$a->no_akun}}" autofocus placeholder="Cth: 1200,3" name="no_akun"
                                        class="form-control">
                                    <span class="text-warning" style="font-size: 15px"><em>Harus sesuai kode
                                            akuntan</em></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Nama Akun</label>
                                    <input type="text" value="{{$a->nm_akun}}" name="nm_akun" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Kode Akun</label>
                                    <input type="text" name="kd_akun" value="{{$a->kd_akun}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Kategori Akun</label>
                                    @php
                                        $akunk = DB::table('tb_kategori_akun')->get();
                                    @endphp
                                    <select class="form-control select" name="id_kategori" id="">
                                        @foreach ($akunk as $b)
                                            <option {{$a->id_kategori == $b->id_kategori ? 'selected' : ''}} value="{{ $b->id_kategori }}">{{ $b->nm_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endforeach
    {{-- ------------------------ --}}

    {{-- import --}}
    <form action="{{ route('importAkun') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="modal fade" id="import" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-mds" role="document">
                <div class="modal-content ">
                    <div class="modal-header btn-costume">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Import Produk</h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <table>
                                <input type="hidden" name="id_lokasi" value="{{Request::get('acc')}}">
                                <tr>
                                <td width="100" class="pl-2">
                                    <img width="80px" src="{{ asset('assets') }}/img/1.png" alt="">
                                </td>
                                <td>
                                    <span style="font-size: 20px;"><b> Download Excel template</b></span><br>
                                    File ini memiliki kolom header dan isi yang sesuai dengan data produk
                                </td>
                                <td>
                                    <a href="{{ route('exportAkun') }}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> DOWNLOAD TEMPLATE</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td width="100" class="pl-2">
                                    <img width="80px" src="{{ asset('assets') }}/img/2.png" alt="">
                                </td>
                                <td>
                                    <span style="font-size: 20px;"><b> Upload Excel template</b></span><br>
                                    Setelah mengubah, silahkan upload file.
                                </td>
                                <td>
                                    <input type="file" name="file" class="form-control">
                                </td>
                            </tr>
                            </table>
                            
                        </div>
                        <div class="row">
                            <div class="col-12">
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit / Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- -------------------------------- --}}
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
@endsection
@section('script')
<script>
    $('#table1').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
    $('#katAkun').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
</script>
    <script>
                var id_akun = $(this).attr("id_akun");
        
        
                var id_akun = $(this).attr("id_akun");  
                document(ready).on('click', '.btnPs', function(){
                    alert(1)
                })I
        $('#form_post_center').load("route('get_data_post_center')?id_akun="+id_akun, "data", function (response, status, request) {
            this; // dom element
            $('#tb_post1').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
        });
                $(document).on('click', '.btnPs', function() {
                    alert(1)
                    var id_akun = $(this).attr("id_akun");
                    var id_lokasi = $(this).attr("id_lokasi");
                    $('#id_akun_post').val(id_akun);
                    var url = "{{ route('get_data_post_center') }}?id_akun="+id_akun
                    $('#form_post_center').load(url, "data", function (response, status, request) {
                        this; // dom element
                        
                    });
                    $.ajax({
                        url: "{{route('get_data_post_center')}}?id_akun="+id_akun
                        method: "GET",
                        success: function(data) {
                            $('#form_post_center').html(data);
                        }
                    });

                });        
    </script>
@endsection
