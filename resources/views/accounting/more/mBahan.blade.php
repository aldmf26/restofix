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
                            <a href="" class="btn btn-info float-right  btn-sm" data-target="#tambah" data-toggle="modal"><i class="fa fa-plus"></i> Merk Bahan</a>
                            {{-- <a class="btn btn-info float-right mr-1 btn-sm" id="kategoriBtn" data-target="#kategori" data-toggle="modal"><i class="fa fa-plus"></i> Kategori</a> --}}
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
                                                    <th>Merk Bahan</th>
                                                    <th>Bahan</th>
                                                    <th>Satuan</th>
                                                    <th>Kategori</th>
                                                    <th>Admin</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($merkBahan as $j)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{$j->nm_merk}}</td>
                                                    <td>{{$j->nm_bahan}}</td>
                                                    <td>{{$j->n}}</td>
                                                    <td>{{$j->nm_kategori}}</td>
                                                    <td>{{$j->admin}}</td>
                                                    <td align="center">
                                                        <a href="" id_merk_bahan="{{ $j->id_merk_bahan }}" class="btn btn-info btn-sm btnEditMbahan" data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></a>
                                                        <a onclick="return confirm('Apakah ingin dihapus ?')" href="<?= route("delMbahan", ['id_merk_bahan' => $j->id_merk_bahan]) ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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

<form action="<?= route('saveMbahan') ?>" method="post">
    @csrf
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-costume">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">Merk Bahan</label>
                            <input required type="text" class="form-control" name="nm_merk">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Nama Bahan</label>
                            <select required name="id_list_bahan" id="" class="form-control select2">
                                <option value="0">- Pilih Bahan -</option>
                                @foreach ($bahan as $b)
                                    <option value="{{ $b->id_list_bahan }}">{{ $b->nm_bahan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnSimpan" class="btn btn-primary btnSimpan">Save/Edit</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="<?= route('editMbahan') ?>" method="post">
    @csrf
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-costume">
                    <h5 class="modal-title" id="exampleModalLabel">Edit {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="konten"></div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnSimpan" class="btn btn-primary btnSimpan">Save/Edit</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $(".btnSimpan").click(function (e) { 
            $(".btnSimpan").hide()
        });

        $(".btnEditMbahan").click(function (e) { 
            var id = $(this).attr('id_merk_bahan')
            $.ajax({
                type: "GET",
                url: "{{route('getEditMbahan')}}?id_merk_bahan=" + id,
                success: function (data) {
                    $("#konten").html(data)
                }
            });
        });
        
    });
    
</script>
@endsection