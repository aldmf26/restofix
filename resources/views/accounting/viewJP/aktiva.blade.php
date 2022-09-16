<input type="hidden" value="{{ $f }}" class="form">
    <hr>

    <!-- testing aktiva -->
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">No id</label>
          <input type="text" name="no_id" class="form-control input_detail input_aktiva" placeholder="No id">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">Post Center</label>
          <select name="id_post" id="id_post" class="form-control select2 input_detail input_aktiva">

          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">Keterangan</label>
          <input type="text" class="form-control" name="ket">
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <label for="list_kategori">Satuan</label>
          <select name="id_satuan" class="form-control select2 satuan input_detail input_aktiva" required>
            <?php foreach ($satuan as $p) : ?>
              <option value="<?= $p->id ?>"><?= $p->n ?></option>
            <?php endforeach; ?>
          </select>

        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label for="list_kategori">Qty</label>
          <input type="text" class="form-control input_detail input_aktiva qty_aktiva qty_monitoring1" name="qty" id="txt3" onkeyup="sum();" value="1" required>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="list_kategori">Rp/Satuan</label>
          <input type="text" name="rp_satuan" class="form-control ttlp total_penyesuaian rp_satuan_aktiva  input_detail input_aktiva " id="ttlp" onkeyup="sum();" required>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="list_kategori">PPN</label>
          <input type="text" class="form-control input_detail total_rp_new1 input_aktiva total_rp_new" name="ppn" id="txt2" onkeyup="sum();">
        </div>
      </div>


      <div class="col-md-2">
        <div class="form-group">
          <label for="list_kategori">Rp + Pajak</label>
          <input type="text" class="form-control total_penyesuaian  input_detail input_aktiva pajak_aktiva" id="total2" name="ttl_rp" required>
        </div>
      </div>
    </div>


    <hr>
    <div class="row justify-content-center">
      <div class="col-lg-12">
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
            <?php foreach ($aktiva as $a) : ?>
              <tr>
                <td><input type="radio" name="id_kelompok" id="" value="<?= $a->id_kelompok ?>"></td>
                <td><?= $a->nm_kelompok ?></td>
                <td><?= $a->umur ?> Tahun</td>
                <td><?= $a->barang_kelompok ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>