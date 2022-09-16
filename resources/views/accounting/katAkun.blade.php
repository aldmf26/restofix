<div class="row">
                            <div class="col-lg-12">
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
                                            $no = 1;
                                        @endphp
                                        @foreach ($ps as $p)                      
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{ $p->nm_kategori }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-outline-secondary delKat" id_kategori="{{ $p->id_kategori }}"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>