<div class="row">
    <div class="col-6">
        <div class="form-group">
            @php
                $kode = DB::table('tb_akun')->where('id_kategori', 5)->orderBy('id_akun', 'DESC')->first();
                $k = $kode->no_akun + 1;
            
            @endphp
            <label for="">No Akun</label>
            {{-- <div id="no_akun"></div> --}}
            <input readonly type="text" placeholder="" value="{{ $k }}" name="no_akun2"
                class="form-control no_akun" id="no_akun">
            {{-- <span class="text-warning" style="font-size: 15px"><em>Harus sesuai kode
                    akuntan</em></span> --}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Nama Akun</label>
            <input type="text" name="nm_akun2" class="form-control">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Kode Akun</label>
            <input type="text" name="kd_akun2" class="form-control">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Kategori Akun</label>
            @php
                $akunk = DB::table('tb_kategori_akun')->get();
            @endphp
            <input type="hidden" class="form-control" value="5" readonly name="id_kategori2">
            <input type="text" class="form-control" value="Biaya" readonly>
        </div>
    </div>
</div>