<input type="hidden" value="{{ $f }}" class="form">
    <hr>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">No id</label>
          <input type="text" name="no_id[]" class="form-control input_detail input_peralatan">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">Barang</label>
          <input type="text" name="nm_barang[]" class="form-control input_detail input_peralatan">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">Penangung Jawab</label>
          <select name="id_penanggung[]" class="form-control select2 satuan input_detail input_peralatan" required>
            <option>--Pilih penanggung jawab--</option>
            <?php foreach ($nm_penanggung as $n) : ?>
              <option value="<?= $n->id_penanggung ?>"><?= $n->nm_penanggung ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">Lokasi</label>
          <select name="id_lokasi[]" class="form-control select2 satuan input_detail input_peralatan" required>
            <option selected value="{{Request::get('acc') == 1 ? '1' : '2'}}" disabled>{{Request::get('acc') == 1 ? 'TAKEMORI' : 'SOONDOBU'}}</option>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="list_kategori">Satuan Barang</label>
          <select name="id_satuan[]" class="form-control select2 satuan input_detail input_peralatan" required>
            <?php foreach ($satuan as $p) : ?>
              <option value="<?= $p->id ?>"><?= $p->n ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="list_kategori">Qty</label>
          <input type="text" class="form-control input_detail input_peralatan qty_monitoring1" qty=1 name="qty[]" required>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <label for="list_kategori">Total Rp</label>
          <input type="text" class="form-control  input_detail input_peralatan total_rp total_rp1" name="ttl_rp[]" total_rp='1' required>
        </div>
      </div>

      <div class="col-lg-6">
        <table class="table table-bordered table-sm" width="100%">
          <thead style="text-align: center;">
            <tr>
              <th></th>
              <th width="15%">Nama Kelompok</th>
              <th width="15%">Umur</th>
              <th width="70%">Barang</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($peralatan as $a) : ?>
              <tr>
                <td><input type="checkbox" name="id_kelompok[]" id="" value="<?= $a->id_kelompok ?>"></td>
                <td><?= $a->nm_kelompok ?></td>
                <td><?= $a->umur ?> <?= $a->satuan ?></td>
                <td><?= $a->barang_kelompok ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>




    <div id="detail_peralatan">

    </div>

    <div align="right" class="mt-2">
      <button type="button" id="tambah_peralatan" class="btn-sm btn-success">Tambah</button>
    </div>