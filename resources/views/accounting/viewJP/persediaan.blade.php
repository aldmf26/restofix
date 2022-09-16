<input type="hidden"  value="{{ $f }}" class="form">
    <hr>
    <div class="row">
      <div class="col-lg-3">
        <div class="form-group">
          <label for="">Biaya Penunjang</label>
          <input type="text" class="form-control input_detail input_stok" name="biaya_penunjang" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">No Id</label>
          <input type="text" class="form-control input_detail input_stok" id="noID" name="no_id[]" required>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">Keterangan</label>
          <input type="text" class="form-control input_detail input_stok" name="keterangan[]" required>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">List Bahan = Resep</label>
          <select name="id_list_bahan[]" detail="1" id="id_list_bahan1" class="id_list_bahan form-control select2 satuan input_detail input_stok listBahan" required>
            {{-- <option value="0">- PIlih Makanan -</option>
            @foreach ($lBahanDaging as $lb)
                <option value="{{ $lb->id_list_bahan }}">{{ $lb->nm_bahan }}</option>
            @endforeach --}}
          </select>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <label for="list_kategori">Satuan = Resep</label>
          <input type="hidden" id="idSatuanResep1" readonly name="id_satuan[]" class="form-control input_detail input_stok">
          <input type="text" id="satuanResep1" readonly  class="form-control input_detail input_stok">
          <span class="text-danger" style="white-space: nowrap"><em>Satuan mengikuti resep</em></span>

        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">Merk Bahan</label>
          <select name="id_merk_bahan[]" id="id_merk_bahan1" class="form-control select2 satuan input_detail input_stok merkBahan " required>
            <option value="0">- PIlih Merk -</option>
            <div id="km"></div>
          </select>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <label for="list_kategori">Qty</label>
          <input type="text" class="form-control input_detail input_stok qty_monitoring1" qty=1 name="qty[]" required>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <label for="list_kategori">Total Rp</label>
          <input type="text" class="form-control  input_detail input_stok total_rp total_rp1" name="ttl_rp[]" total_rp='1' required>
        </div>
      </div> 

    </div>


    <div id="detail_stok">

    </div>

    <div align="right" class="mt-2">
      <button type="button" id="tambah_stok" class="btn-sm btn-success">Tambah</button>
    </div>


{{-- tambah bahan --}}
<form id="modalBahan">
    @csrf
    <div class="modal fade tbhBahan" id="tbhBahan" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-costume">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">Nama Bahan</label>
                            <input type="text" name="nm_bahan" id="tbh_namaBahan" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label for="">Satuan</label>
                                @php
                                    $sat = DB::table('tb_satuan')->whereIN('id', [12,18,22,24,25,26])->get();
                                @endphp
                                <select class="form-control select" id="tbh_idSatuan" name="id_satuanTbh">
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
                                <select class="form-control select" name="kategori" id="tbh_kategori">
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
  {{-- ----------------- --}}
  
  {{-- tambah merk --}}
  <form id="modalMerk">
    @csrf
    <div class="modal fade tbhMerk" id="tbhMerk">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-costume">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Merk Bahan</h5>
                    <button type="button" class="close merkB" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">Merk Bahan</label>
                            <input required type="text" class="form-control" id="nm_merk" name="nm_merk">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Nama Bahan</label>
                            <select required name="id_list_bahan" id="id_list_bahan" class="form-control select2">
                                <option value="0">- Pilih Bahan -</option>
                                @php
                                    $bahan = DB::table('tb_list_bahan')->where('id_lokasi', $id_lokasi)->get();
                                @endphp
                                @foreach ($bahan as $b)
                                    <option value="{{ $b->id_list_bahan }}">{{ $b->nm_bahan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary merkB">Close</button>
                    <button type="submit" id="btnSimpan" class="btn btn-primary btnSimpan">Save/Edit</button>
                </div>
            </div>
        </div>
    </div>
  </form>
  {{-- -------------------- --}}

