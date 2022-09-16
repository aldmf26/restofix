<div class="row">
    <input type="hidden" name="id_akun" id="id_akun" value="{{ $id_akun }}">
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
                                            $ps = DB::table('tb_post_center')->where('id_akun', $id_akun)->get();
                                        @endphp
                                        @foreach ($ps as $p)                      
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{ $p->nm_post }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-outline-secondary delPost" id_akun="{{ $id_akun }}" id_post="{{ $p->id_post }}"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>