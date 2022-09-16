<div class="row">
    <input type="hidden" name="id_merk_bahan" value="{{ $merk->id_merk_bahan }}">
    <div class="col-lg-6">
        <label for="">Merk Bahan</label>
        <input value="{{ $merk->nm_merk }}" required type="text" class="form-control" name="nm_merk">
    </div>
    <div class="col-lg-6">
        <label for="">Nama Bahan</label>
        <select required name="id_list_bahan" id="" class="form-control select2">
            <option value="0">- Pilih Bahan -</option>
            @foreach ($bahan as $b)
                <option {{ $merk->id_list_bahan == $b->id_list_bahan ? 'selected' : '' }} value="{{ $b->id_list_bahan }}">{{ $b->nm_bahan }}</option>
            @endforeach
        </select>
    </div>
</div>