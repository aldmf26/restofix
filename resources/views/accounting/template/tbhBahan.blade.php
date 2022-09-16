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