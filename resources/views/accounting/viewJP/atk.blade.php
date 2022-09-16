<input type="hidden" value="{{ $f }}" class="form">
    <hr>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">No Id</label>
          <input type="text" class="form-control input_detail input_atk" name="no_id[]" required>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">Tujuan</label>
          <input type="text" class="form-control input_detail input_atk" name="keterangan[]" required>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">Keterangan</label>
          <input type="text" class="form-control input_detail input_atk" name="ket2[]" required>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">Post Center</label>
          <select name="id_post_center[]" class="form-control select2 id_post">

          </select>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <label for="list_kategori">Satuan</label>
          <select name="id_satuan[]" class="form-control select2 satuan input_detail input_atk" required>
            <?php foreach ($satuan as $p) : ?>
              <option value="<?= $p->id ?>"><?= $p->n ?></option>
            <?php endforeach; ?>
          </select>

        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <label for="list_kategori">Qty</label>
          <input type="text" class="form-control input_detail input_atk qty_monitoring1" qty=1 name="qty[]" required>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <label for="list_kategori">Total Rp</label>
          <input type="text" class="form-control  input_detail input_atk total_rp total_rp1" name="ttl_rp[]" total_rp='1' required>
        </div>
      </div>

    </div>


    <div id="detail_atk">

    </div>

    <div align="right" class="mt-2">
      <button type="button" id="tambah_atk" class="btn-sm btn-success">Tambah</button>
    </div>
