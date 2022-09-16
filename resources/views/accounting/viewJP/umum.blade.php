<input type="hidden" value="{{ $f }}" class="form">
<div class="row">
    <div class="col-md-3">
      <div class="form-group">
        
        <label for="list_kategori">No id</label>
        <input type="text" class="form-control input_detail input_biaya" name="no_id[]" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="list_kategori">Post Center</label>
        <select name="id_post_center[]" class="form-control select2 id_post">

        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="list_kategori">Tujuan </label>
        <input type="text" class="form-control input_detail input_biaya" name="keterangan[]" required>
        
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="list_kategori">Keterangan</label>
        <input type="text" class="form-control input_detail input_biaya" name="ket2[]" required>
      </div>
    </div>
    

    <div class="col-md-2">
      <div class="form-group">
        <label for="list_kategori">Satuan</label>
        <select name="id_satuan[]" class="form-control select2 satuan input_detail input_biaya" required>
          <?php foreach ($satuan as $p) : ?>
            <option value="<?= $p->id ?>"><?= $p->n ?></option>
          <?php endforeach; ?>
        </select>

      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label for="list_kategori">Qty</label>
        <input type="text" class="form-control input_detail input_biaya qty_monitoring1" qty=1 name="qty[]" required>
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label for="list_kategori">Total Rp</label>
        <input type="text" class="form-control  input_detail input_biaya total_rp total_rp1" name="ttl_rp[]" total_rp='1' required>
      </div>
    </div>
    <div class="col-md-6">
      <label for=""><span style="font-size: 15px; color:red">(eg : talang, atap / jika tidak perlu diisi jangan diisi)</span></label>
    </div>
  </div>
  
  <div id="detail_monitoring"></div>

    <div align="right" class="mt-2">
    <button type="button" id="tambah_monitoring" class="btn-sm btn-success">Tambah</button>
    </div>