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
                            <a href="" class="btn btn-info float-right btn-sm plusResep" data-target="#tambah" data-toggle="modal"><i class="fa fa-plus"></i> Resep</a>
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
                                                    <th>Nama Menu</th>
                                                    <th>Kategori</th>
                                                    <th>Admin</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($resep as $j)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{$j->nm_menu}}</td>
                                                    <td>{{$j->kategori}}</td>
                                                    <td>{{$j->admin}}</td>
                                                    <td align="center">
                                                        {{-- <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#view<?= $j->id_menu ?>"><i class="fas fa-eye"></i></a> --}}
                                                        <a href="" class="btn btn-info btn-sm editBtn" id_menu="{{ $j->id_menu }}" data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></a>
                                                        <a onclick="return confirm('Apakah ingin dihapus ?')" href="<?= route("delResep", ['id_menu' => $j->id_menu]) ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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

{{-- save --}}
<form action="{{ route('saveResep') }}" method="post">
    @csrf
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-costume">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Pilih Menu</label>
                            <select name="id_menu" id="" class="form-control select">
                                <option value="">- Pilih Menu -</option>
                                @foreach ($menu as $m)
                                    <option value="{{ $m->id_menu }}">{{ $m->nm_menu }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-7">
                            <label for="">Pilih Bahan</label>
                            <select name="id_list_bahan[]" id="" class="form-control">
                                <option value="">- Pilih Bahan -</option>
                                @foreach ($bahan as $b)
                                    <option value="{{ $b->id_list_bahan }}">{{ $b->nm_bahan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label for="">Qty</label>
                            <input type="number" min="0" name="qty[]" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Aksi</label><br>
                            <button class="btn btn-sm btn-success tbhResep" type="button"><i class="fa fa-plus"></i></button>
                        </div>        
                    </div>
                    <div class="kontenResep"></div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save/Edit</button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- view detail bahan --}}
<form id="formEditResep">
    @csrf
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-costume">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div id="kontenEditResep"></div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary editEnable">Save/Edit</button>
                </div>
            </div>
        </div>
    </div>
</form>  

@endsection
@section('script')
<script>
    var count = 1
    $(".tbhResep").click(function (e) { 
        var html = "<div id='row_count"+count+"' class='row mt-2'>"
            html += "<div class='col-lg-7'>"
            html += "<select name='id_list_bahanT[]' id='' class='form-control'>"
            html += "<option value=''>- Pilih Bahan -</option>"
            html += "@foreach ($bahan as $b)<option value='{{ $b->id_list_bahan }}'>{{ $b->nm_bahan }}</option>@endforeach"
            html += "</select></div>"
            html += "<div class='col-lg-3'>"
            html += "<input type='number' min='0' name='qtyT[]' class='form-control'></div>"
            html += "<div class='col-lg-2'><button type='button' name='remove' data-row='row_count"+count+"' class='btn btn-danger btn-sm remove_monitoring'>-</button></div></div>"

            $('.kontenResep').append(html);
            $('.select').select2()
            count++
    });

    $(document).on('click', '.remove_monitoring', function() {
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });  

    var countE = 1
    $("body").on('click', '.tbhResepE', function(){
        var id_menu = $(this).attr('id_menu')
     
        countE = countE + 1
        var html = "<div id='row_countE"+countE+"' class='row mt-2 bungkus'>"
            html += "<div class='col-lg-7'>"
            html += "<select name='id_list_bahanT[]' id='' class='form-control'>"
            html += "<option value=''>- Pilih Bahan -</option>"
            html += "@foreach ($bahan as $b)<option value='{{ $b->id_list_bahan }}'>{{ $b->nm_bahan }}</option>@endforeach"
            html += "</select></div>"
            html += "<div class='col-lg-3'>"
            html += "<input type='number' min='0' name='qtyT[]' class='form-control'></div>"
            html += "<div class='col-lg-2'><button type='button' name='remove' count='row_countE"+countE+"' class='btn btn-danger btn-sm remove_monitoringE'>-</button></div></div>"

            $('.kontenResepE').append(html);
            $('.select').select2()
    })
    // $(".tbhResepE").click(function (e) { 
        
           
    // });

    $(document).on('click', '.remove_monitoringE', function() {
        var delete_row = $(this).attr("count");
        $('#' + delete_row).remove();
    });

    $("#formEditResep").submit(function (e) { 
        e.preventDefault();
        var id_menu = $("#id_menu").val()
        var datas = $("#formEditResep").serialize();
        $.ajax({
            type: "POST",
            url: "{{route('editResep')}}",
            data: datas,
            success: function (data) {
                Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Save resep berhasil'
                    });
                getEditResep(id_menu)
            }
        });
    });

    function getEditResep(id_menu) {
        $.ajax({
            type: "GET",
            url: "{{route('getEditResep')}}?id_menu="+id_menu,
            success: function (data) {
                $("#kontenEditResep").html(data)
            }
        });
    }
    $(".editBtn").click(function (e) { 
        var id_menu = $(this).attr('id_menu')
        getEditResep(id_menu)
    });
    // $(".editBtn, .plusResep").click(function (e) { 
    //     $('.kontenResep').empty();
    //     $('.kontenResepE').empty();
    //     $(".selListBahan").attr("disabled", "true");
    // });

    $(".editEnable").click(function (e) { 
        $(".selListBahan").removeAttr("disabled");
    });

    $(document).on('click', '#delResep', function(){
        var id_resep = $(this).attr('id_resep')
        var id_menu = $(this).attr('id_menu')
        $.ajax({
            type: "GET",
            url: "{{route('delEditResep')}}?id_resep="+id_resep,
            success: function (data) {
                Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'error',
                        title: 'Hapus resep berhasil'
                    });
                getEditResep(id_menu)
            }
        });
        
    })

</script>
@endsection