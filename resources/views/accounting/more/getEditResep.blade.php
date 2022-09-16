<input type="hidden" name="id_menu" value="{{ $id_menu }}" id="id_menu">
                    @foreach ($bahanEdit as $be)
                    <div class="row mt-2">
                        <div class="col-lg-7">
                            {{-- <label for="">Pilih Bahan</label> --}}
                            <select disabled name="id_list_bahan[]" id="" class="form-control selListBahan">
                                <option value="">- Pilih Bahan -</option>
                                @foreach ($bahan as $b)
                                    <option {{ $b->id_list_bahan == $be->id_list_bahan ? 'selected' : '' }} value="{{ $b->id_list_bahan }}">{{ $b->nm_bahan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            {{-- <label for="">Qty</label> --}}
                            <input value="{{ $be->qty }}" type="number" min="0" name="qty[]" class="form-control">
                        </div>
                        <div class="col-lg-1">
                            <button id="delResep" id_menu="{{ $id_menu }}" id_resep="{{ $be->id_resep }}" class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button>
                        </div>
                        {{-- <div class="col-lg-2">
                            <label for="">Aksi</label><br>
                            <button id="tbhResep" class="btn btn-sm btn-success" type="button"><i class="fa fa-plus"></i></button>
                        </div>         --}}
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-lg-2">
                            <label for="">Aksi</label><br>
                            <button class="btn btn-sm btn-success tbhResepE" id_menu="{{ $id_menu }}" type="button"><i class="fa fa-plus"></i></button>
                        </div>  
                    </div>
                    <div class="kontenResepE"></div>
