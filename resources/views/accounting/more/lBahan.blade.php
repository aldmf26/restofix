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
                            <a href="" class="btn btn-info float-right  btn-sm" data-target="#tambah" data-toggle="modal"><i class="fa fa-plus"></i> Makanan</a>
                            <a class="btn btn-info float-right mr-1 btn-sm" id="kategoriBtn" data-target="#kategori" data-toggle="modal"><i class="fa fa-plus"></i> Kategori</a>
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
                                                    <th>Nama Bahan</th>
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
                                                @foreach ($lBahan as $j)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{$j->nm_bahan}}</td>
                                                    <td>{{$j->n}}</td>
                                                    <td>{{$j->nm_kategori}}</td>
                                                    <td>{{$j->admin}}</td>
                                                    <td align="center">
                                                        <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit<?= $j->id_list_bahan ?>"><i class="fas fa-edit"></i></a>
                                                        <a onclick="return confirm('Apakah ingin dihapus ?')" href="<?= route("delLbahan", ['id_list_bahan' => $j->id_list_bahan]) ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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


{{-- tambah bahan --}}
<form action="<?= route('saveLbahan') ?>" method="post">
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
                        <div class="col-lg-5">
                            <label for="">Nama Bahan</label>
                            <input type="text" name="nm_bahan" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label for="">Satuan</label>
                                @php
                                    $sat = DB::table('tb_satuan')->whereIN('id', [12,18,22,24,25,26])->get();
                                @endphp
                                <select class="form-control select" name="id_satuan">
                                <option value="">- Pilih Satuan -</option>
                                @foreach ($sat as $a)
                                    <option value="{{ $a->id }}">{{ $a->n }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Kategori</label>
                            @php
                                $kat = DB::table('tb_kategori_makanan')->where('id_lokasi', $id_lokasi)->get();
                            @endphp
                                <select class="form-control select" name="kategori">
                                    <option value="">- Pilih Kategori -</option>
                                    @foreach ($kat as $k)
                                        <option value="{{ $k->id_kategori_makanan }}">{{ $k->nm_kategori }}</option>
                                    @endforeach
                            </select>
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
{{-- edit bahan --}}
@foreach ($lBahan as $l)
<form action="<?= route('editLbahan') ?>" method="post">
    @csrf
    <div class="modal fade" id="edit{{$l->id_list_bahan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-costume">
                    <h5 class="modal-title" id="exampleModalLabel">Edit {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id_list_bahan" value="{{ $l->id_list_bahan }}">
                        <div class="col-lg-5">
                            <label for="">Nama Bahan</label>
                            <input type="text" name="nm_bahan" value="{{ $l->nm_bahan }}" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label for="">Satuan</label>
                                @php
                                    $sat = DB::table('tb_satuan')->whereIN('id', [12,18,22,24,25,26])->get();
                                @endphp
                                <select class="form-control select" name="id_satuan">
                                @foreach ($sat as $a)
                                    <option {{ $a->id == $l->id_satuan ? 'selected' : '' }} value="{{ $a->id }}">{{ $a->n }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Kategori</label>
                            @php
                                $kat = DB::table('tb_kategori_makanan')->where('id_lokasi', $id_lokasi)->get();
                            @endphp
                                <select class="form-control select" name="kategori">
                                    @foreach ($kat as $k)
                                        <option {{ $l->id_kategori_makanan == $k->id_kategori_makanan ? 'selected' : '' }} value="{{ $k->id_kategori_makanan }}">{{ $k->nm_kategori }}</option>
                                    @endforeach
                            </select>
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
@endforeach

{{-- kategori makanan --}}
<form id="addKategori">
    @csrf
    <div class="modal fade" id="kategori" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header btn-costume">
                    <h5 class="modal-title" id="exampleModalLabel">Kategori</h5>
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
                    <div id="kontenKategori"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Input</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
@section('script')
<script>
    function kat(){
        $.ajax({
            method: "GET",
            url: "{{route('getKategoriMakanan')}}",
            success: function (data) {
                $("#kontenKategori").html(data)
            }
        });
    }

    $("#kategoriBtn").click(function (e) { 
        kat()
    });

    $("#addKategori").submit(function (e) { 
        e.preventDefault();
        var nm_kategori = $("#nm_kategori").val()

        $.ajax({
            type: "post",
            url: "{{route('addKategoriMakanan')}}",
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
            url: "{{route('delKategoriMakanan')}}?id_kategori="+id_kategori,
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
</script>
@endsection