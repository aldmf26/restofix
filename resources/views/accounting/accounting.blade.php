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
                                                        {{-- <th>Kode Akun</th> --}}
                                                        <th>No / Kode Akun </th>
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
                                                            {{-- <td>{{ $a->kd_akun }}</td> --}}
                                                            <td>{{ $a->no_akun }} / {{ $a->kd_akun }}</td>
                                                            <td>{{ $a->nm_akun }}</td>
                                                            <td>{{ $a->nm_kategori }}</td>
                                                            <td align="center">
                                                                <a href="#" data-toggle="modal" data-target="#edit<?= $a->id_akun ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                                <a onclick="return confirm('Dihapus ?')" href="{{ route('deleteAkun', ['id_akun' => $a->id_akun]) }}" class="btn btn-info btn-sm"><i
                                                                    class="fa fa-trash"></i></a>
                                                                <a href="#" data-toggle="modal" data-target="#akses<?= $a->id_akun ?>" class="btn btn-info btn-sm"><i class="fas fa-key"></i> Relasi akun</a>
                                                                <a href="#" data-target="#add_post_center" data-toggle="modal"
                                                                    class="btn btn-secondary btn-sm btnPs" id_lokasi="{{Request::get('acc')}}" id_akun="{{ $a->id_akun }}"><i class="fas fa-map-pin"></i> Post
                                                                    Center</a>
                                                                <a href="" data-target="#relation{{$a->id_akun}}" data-toggle="modal" class="btn btn-sm btn-secondary">Relasi Penyesuaian</a>
                                                                
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
    {{-- relasi penyesuaian --}}
    <?php foreach ($akun_relation as $d) : ?>
    <form action="<?= route('add_relation_akun') ?>" method="POST">
        @csrf
        <div class="modal fade" id="relation<?= $d->id_akun ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="exampleModalLabel">Relation Akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_lokasi" value="{{ Request::get('acc') }}">
                        <div class="row justify-content-center">
                            <input type="hidden" name="id_akun" value="<?= $d->id_akun ?>">
                            <div class="col-12">
                                <p class="text-warning">Digunakan untuk menentukan pasangan ketika melakukan penyesuaian akun</p>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="list_kategori">Akun Debit</label>
                                    <select name="id_relation_debit" class="form-control select2" required="">
                                        <?php if (!$d->id_relation_debit) : ?>
                                            <option value="">-Pilih Akun-</option>
                                        <?php endif; ?>
                                        <?php foreach ($akun as $k) : ?>
                                            <option value="<?= $k->id_akun ?>" <?= $d->id_relation_debit == $k->id_akun ? 'selected' : '' ?>><?= $k->nm_akun ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="list_kategori">Akun kredit</label>
                                    <select name="id_relation_kredit" class="form-control select2" required="">
                                        <?php if (!$d->id_relation_kredit) : ?>
                                            <option value="">-Pilih Akun-</option>
                                        <?php endif; ?>
                                        <?php foreach ($akun as $k) : ?>
                                            <option value="<?= $k->id_akun ?>" <?= $d->id_relation_kredit == $k->id_akun ? 'selected' : '' ?>><?= $k->nm_akun ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

<?php endforeach; ?>
    {{-- ------------------ --}}
    {{-- relasi akun --}}
    @foreach ($akun as $a)
    <form action="<?= route('relasiAkun') ?>" method="post">
        @csrf
        <div class="modal fade" id="akses<?= $a->id_akun ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <input type="hidden" name="kd_akun" value="<?= $a->id_akun ?>">
                <input type="hidden" name="no_akun" value="<?= $a->no_akun ?>">
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
  
    <form id="tambah_post">
        @csrf
        <div class="modal fade" id="add_post_center" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="exampleModalLabel">Post Center</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id_lokasi" id="id_lokasi" value="{{Request::get('acc')}}">
                    <input type="hidden" name="id_akun" id="id_akun" value="{{Request::get('acc')}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="list_kategori">Nama Post Center</label>
                                    <input class="form-control" type="text" id="nm_post" name="nm_post" required>
                                </div>
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
                            <div class="col-6">
                                <input type="hidden" name="id_lokasi" value="{{Request::get('acc')}}">
                                <div class="form-group">
                                    <label for="">No Akun</label>
                                    {{-- <div id="no_akun"></div> --}}
                                    <input readonly type="text" placeholder="" name="no_akun"
                                        class="form-control no_akun" id="no_akun">
                                    {{-- <span class="text-warning" style="font-size: 15px"><em>Harus sesuai kode
                                            akuntan</em></span> --}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nama Akun</label>
                                    <input type="text" name="nm_akun" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Kode Akun</label>
                                    <input type="text" name="kd_akun" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Kategori Akun</label>
                                    @php
                                        $akunk = DB::table('tb_kategori_akun')->get();
                                    @endphp
                                    <select class="form-control select katAkun" name="id_kategori">
                                        <option value="">- Pilih Akun -</option>
                                        @foreach ($akunk as $a)
                                            <option value="{{ $a->id_kategori }}">{{ $a->nm_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div id="togel"></div>
                            </div>
                            <div class="col-lg-6">
                                <div id="togelBukuKas"></div>
                            </div>
                        </div>
                        
                        <hr>
                        <div id="akunBiaya"></div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Detail Input Jurnal</label>
                                <select name="jenisAkun" id="" class="form-control select jAkun" required>
                                    <option value="0">- Pilih Detail -</option>
                                    <option value="aktiva">Aktiva</option>
                                    <option value="atk">Atk & Perlengkapan</option>
                                    <option value="peralatan">Peralatan Barang</option>
                                    <option value="persediaan">Persediaan Barang</option>
                                </select>
                            </div>
                            <div class="col-lg-6">

                                <div id="jStok"></div>
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
    <form id="addKategoriAkun">
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="list_kategori">Kategori</label>
                                    <input class="form-control" type="text" id="nm_kategori" name="nm_kategori" required>
                                </div>
                            </div>
                        </div>
                        <div id="kontenAddAkun"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Input</button>
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
                                    <input readonly type="text" value="{{$a->no_akun}}" placeholder="Cth: 1200,3" name="no_akun"
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
                    "stateSave": true,
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
    
    
    
    $(".katAkun").change(function (e) { 
        var kategori = $(".katAkun").val()
        if(kategori == 1) {
            $("#togel").show();
            $("#togelBukuKas").show();
            var html = '<div class="custom-control custom-switch"><input name="biayaDisesuaikan" value="off" type="checkbox" class="custom-control-input" id="switchBiaya"><label class="custom-control-label" for="switchBiaya">Biaya Di Sesuaikan</label></div>'
            var html2 = '<div class="custom-control custom-switch"><input name="bukuBank" value="off" type="checkbox" class="custom-control-input" id="switchBukuBank"><label class="custom-control-label" for="switchBukuBank">Kas / Buku Bank</label></div>'
            $("#togel").html(html);
            $("#togelBukuKas").html(html2);
        } else {
            $("#togel").hide();
            $("#togelBukuKas").hide();
            $("#akunBiaya").hide();
        }
        $.ajax({
            type: "GET",
            url: "{{route('getNoAkun')}}?id_kategori="+kategori,
            success: function (data) {
                $('#no_akun').val(data)
            }
        });
    });
    $(document).on('change', '#switchBiaya', function(){
        var v = $(this).val()
        if ($(this).is(':checked')) {
            $("#switchBukuBank").attr('disabled', 'true');
            $("#akunBiaya").show();
            $(this).attr('value', 'on');
            $.ajax({
                type: "GET",
                url: "{{route('getAkunBiaya')}}",
                success: function (response) {
                    $("#akunBiaya").html(response);
                }
            });
        }
        else {
            $("#akunBiaya").hide();
            $("#switchBukuBank").removeAttr("disabled");
            $(this).attr('value', 'off');
        }
    })

    $(document).on('change', '#switchBukuBank', function(){
        var v = $(this).val()
        if ($(this).is(':checked')) {
            $(this).attr('value', 'on');
            $("#switchBiaya").attr('disabled', 'true');
        }
        else {
            $(this).attr('value', 'off');
            $("#switchBiaya").removeAttr("disabled");
        }
    })

    $(".jAkun").change(function (e) { 
        var v = $(this).val()
        if(v == 'persediaan') {
            $("#jStok").show();
            var html = '<div class="col-lg-12"><label for="">Jenis Stok</label><select name="jenisStok" id="" class="form-control select jStok" required><option value="0">- Jenis Stok -</option><option value="tunggal">Tunggal</option><option value="kelompok">Kelompok</option></select></div>'
            $("#jStok").html(html);
            $('.select').select2()
        } else {
            $("#jStok").hide();
        }
    });
    // $("#switchBiaya").on('change', function() {
    // if ($(this).is(':checked')) {
    //     var v = $(this).attr('value', 'true');
    //     alert(v)
    // } else {
    //     var v = $(this).attr('value', 'false');
    //     alert(v)
    // }});

    function kat(){
        $.ajax({
            method: "GET",
            url: "{{route('katAkun')}}",
            success: function (data) {
                $("#kontenAddAkun").html(data)
            }
        });
    }
    $("#kategori").click(function (e) { 
        kat()
    });

    $("#addKategoriAkun").submit(function (e) { 
        e.preventDefault();
        var nm_kategori = $("#nm_kategori").val()
        $.ajax({
            type: "post",
            url: "{{route('addKategoriAkun')}}",
            data: {
                nm_kategori : nm_kategori,
                "_token": "{{ csrf_token() }}",
            },
            success: function (data) {
                Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Tambah Kategori berhasil'
                    });
                kat()
            }
        });
    });

    $(document).on('click', '.delKat', function(){
        var id_kategori = $(this).attr('id_kategori')
        $.ajax({
            type: "GET",
            url: "{{route('delKetAkun')}}?id_kategori="+id_kategori,
            success: function (data) {
                Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'error',
                        title: 'Hapus Kategori berhasil'
                    });
                kat()
            }
        });
    })

    
    function loadPs(id_akun){
        $.ajax({
            type: "GET",
            url: "{{route('get_data_post_center')}}?id_akun="+id_akun,
            success: function (data) {
                $('#form_post_center').html(data)
            }
        });
    }

    $('.btnPs').click(function (e) { 
        var id_akun = $(this).attr('id_akun');
        $("#id_akun").val(id_akun);
        loadPs(id_akun)
    });

    $("#tambah_post").submit(function (e) { 
        e.preventDefault();
        var nm_post = $("#nm_post").val();
        var id_akun = $("#id_akun").val();

        $.ajax({
            method: "POST",
            url: "{{route('addPostCenter')}}",
            data: {
                nm_post : nm_post,
                id_akun : id_akun,
                "_token": "{{ csrf_token() }}",
            },
            success: function (response) {
                Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Tambah Post berhasil'
                    });
                var id_akun = $("#id_akun").val();
                loadPs(id_akun)
            }
        });

    });

    $(document).on('click', '.delPost', function(){
        var id_post = $(this).attr("id_post");
        var id_akun = $(this).attr("id_akun");

        $.ajax({
            type: "GET",
            url: "{{route('delPostCenter')}}?id_post="+id_post,
            success: function (data) {
                Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'error',
                        title: 'Berhasil hapus Post Center'
                    });
                loadPs(id_akun)
            }
        });
    })
    

</script>
@endsection
