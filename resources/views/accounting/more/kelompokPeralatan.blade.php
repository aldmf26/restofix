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
                            <h5 class="float-left">Data Kelompok Peralatan</h5>
                        </div>
                        <div class="card-body">
                            <div id="table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-striped dataTable no-footer" id="table" role="grid"
                                            aria-describedby="table_info">
                                            <thead>
                                                <tr class="table-info">
                                                    <th>No</th>
                                                    <th>Nama Kelompok</th>
                                                    <th>Umur</th>
                                                    <th>Barang</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($query as $j)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{$j->nm_kelompok}}</td>
                                                    <td>{{$j->umur}} {{ $j->satuan }}</td>
                                                    <td>{{$j->barang_kelompok}}</td>

                                                    <td>
                                                        <a href="" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#edit{{$j->id_kelompok}}"><i class="fa fa-edit"></i></a>
                                                       
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

@foreach ($query as $j)
<form action="{{ route('editKelPeralatan') }}" method="POST">
    @csrf
    <div class="modal fade" id="edit{{$j->id_kelompok}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="id_kelompok" value="{{ $j->id_kelompok }}">
                <input type="hidden" name="id_lokasi" value="{{ Request::get('acc') }}">
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-lg-4">
                            <label for="">Nama Kelompok</label>
                            <input type="text" name="nm_kelompok" value="{{ $j->nm_kelompok }}" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label for="">Umur</label>
                            <input type="text" name="umur" value="{{ $j->umur }}" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label for="">Satuan</label>
                            <select name="satuan" id="" class="form-control">
                                <option value="">- Pilih Satuan -</option>
                                <option {{ $j->satuan == 'Tahun' ? 'selected' : '' }} value="Tahun">Tahun</option>
                                <option {{ $j->satuan == 'Bulan' ? 'selected' : '' }} value="Bulan">Bulan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <label for="">Barang</label>
                            <textarea name="barang" class="form-control" id="" cols="30" rows="5">{{ $j->barang_kelompok }}</textarea>
                        </div>
                    </div>
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
@endsection