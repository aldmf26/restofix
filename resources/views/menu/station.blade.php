<div class="row">
    <div class="col-lg-12">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Station</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no =1;
                    $station = DB::table('tb_station')->where('id_lokasi',$id_lokasi)->get();
        
                @endphp
                @foreach ($station as $s)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $s->nm_station }}</td>
                        <td>
                            <a id_station="{{$s->id_station}}" data-toggle="modal" data-target="#editStation{{$s->id_station}}" class="btn btn-sm btn-warning editStation"><i class="fa fa-edit"></i></a>
                            <a id_station="{{$s->id_station}}" class="btn btn-sm btn-danger delStation"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@foreach ($station as $s)
<form id="eStation">
    <div class="modal fade" id="editStation{{$s->id_station}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-header btn-costume">
                    <h5 class="modal-title text-light" id="exampleModalLabel">Edit Station</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-group">
                    <input type="hidden" name="id_lokasi" id="id_lokasiS" value="{{ Request::get('id_lokasi') }}">
                    <label for="">Nama Station</label>
                    <input value="{{ $s->nm_station }}" type="text" id="nm_station" name="nm_station" class="form-control">
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-costume" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-costume">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endforeach