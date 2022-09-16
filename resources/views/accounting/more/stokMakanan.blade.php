@extends('accounting.template.master')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2"> 
                    @foreach ($lBahan as $l)
                    @php
                        $t = DB::selectOne("SELECT sum(a.debit_makanan - a.kredit_makanan) as ttl, b.nm_bahan, c.n FROM `tb_stok_makanan` as a
                            LEFT JOIN tb_list_bahan as b on a.id_list_bahan = b.id_list_bahan
                            LEFT JOIN tb_satuan as c on b.id_satuan = c.id
                            WHERE a.tgl BETWEEN '$dari' and '$sampai' AND a.id_lokasi = '$id_lokasi' AND b.id_list_bahan = '$l->id_list_bahan'
                            GROUP BY a.id_list_bahan");

                    @endphp
                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                          {{-- <span class="info-box-icon bg-danger elevation-1"></span> --}}
                          <div class="info-box-content text-center">
                            <span class="info-box-text">{{ $l->nm_bahan }}</span>
                            <span class="info-box-number">{{ empty($t->ttl) ? '0 ' : $t->ttl . ' ' . ucwords(Str::lower($t->n)) }} </span>
                          </div>
                          <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                      </div>
                      <!-- /.col -->  
                    @endforeach
                  </div>
                  
                  <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
     
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        @include('accounting.template.flash')
                        <div class="card">
                            <div class="card-header">
                                <h5 class="float-left">{{ $title }} {{ date('d F Y', strtotime($dari)); }} ~ {{ date('d F Y', strtotime($sampai)); }}</h5>
                                <a href="" data-toggle="modal" data-target="#view"
                                    class="btn btn-info btn-sm float-right mr-1"><i class="fas fa-eye"></i> View</a>
                                <a href="" data-toggle="modal" data-target="#tambah"
                                    class="btn btn-info btn-sm float-right mr-1"><i class="fas fa-plus"></i> Stok</a>
                                {{-- <a href="" class="btn btn-info float-right " data-target="#tambah" data-toggle="modal"><i class="fa fa-plus"></i> Makanan</a>
                            <a class="btn btn-info float-right mr-1" id="kategoriBtn" data-target="#kategori" data-toggle="modal"><i class="fa fa-plus"></i> Kategori</a> --}}
                            </div>
                            <div class="card-body">
                                <div id="table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-striped dataTable no-footer" id="example2"
                                                role="grid" aria-describedby="table_info">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th>#</th>
                                                        <th>Tanggal</th>
                                                        <th>Bahan</th>
                                                        <th>Merk</th>
                                                        <th>Debit</th>
                                                        <th>Kredit</th>
                                                        <th>Kategori</th>
                                                        <th>Admin</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach ($stok as $j)
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td>{{ $j->tglStok }}</td>
                                                            <td>{{ $j->nm_bahan }}</td>
                                                            <td>{{ $j->nm_merk }}</td>
                                                            <td>{{ $j->debit_makanan }} {{ ucwords(Str::lower($j->n)) }}
                                                            </td>
                                                            <td>{{ $j->kredit_makanan }} {{ ucwords(Str::lower($j->n)) }}
                                                            </td>
                                                            <td>{{ $j->nm_kategori }}</td>
                                                            <td>{{ $j->adminStok }}</td>
                                                            <td align="center">
                                                                <a onclick="return confirm('Apakah ingin dihapus ?')"
                                                                    href="<?= route('delStokMakanan', ['kd_gabungan' => $j->kd_gabungan, 'dari' => $dari, 'sampai' => $sampai]) ?>"
                                                                    class="btn btn-danger btn-sm"><i
                                                                        class="fas fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <form action="" method="get">
        <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md-6" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View Pertanggal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="acc" value="{{ Request::get('acc') }}">
                            <div class="col-md-6">
                                <label for="">Dari</label>
                                <input required type="date" name="dari" class="form-control mb-3">
                            </div>
                            <div class="col-md-6">
                                <label for="">Sampai</label>
                                <input required type="date" name="sampai" class="form-control mb-3">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="simpan" value="Simpan" id="tombol" class="btn btn-primary mt-3">
                            <button type="button" class="btn btn-secondary  mt-3" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <style>
        .modal-lg-max {
            max-width: 800px;
        }

    </style>
    {{-- add akun --}}

    <form action="{{ route('addjStok') }}" method="post" id="form-jurnal">
    @csrf
    <div class="modal fade" id="tambah" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg-max" role="document">
            <div class="modal-content">
                <div class="modal-header bg-costume">
                  <h5 class="modal-title" id="exampleModalLabel">Jurnal Pengeluaran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="id_lokasi" value="{{Request::get('acc')}}">
                  <div class="row">
        
                    <div class="col-sm-3 col-md-3">
                      <div class="form-group">
                        <label for="list_kategori">Tanggal</label>
                        <input class="form-control" type="date" name="tgl" id="tgl_peng" value="<?= date('Y-m-d') ?>" required>
        
                      </div>
                    </div>
                    <div class="mt-3 ml-1">
                      <p class="mt-4 ml-2 text-warning"><strong>Db</strong></p>
                    </div>
                    <div class="col-sm-4 col-md-4">
                      <div class="form-group">
                        <label for="list_kategori">Akun</label>
                        <select name="id_akun" id="id_pilih" class="form-control select2 id_dipilih" required="">
                          <option value="">- Pilih Akun -</option>
                          @foreach ($akun as $ak)
                              <option value="{{ $ak->id_akun }}">{{ $ak->nm_akun }}</option>
                          @endforeach
                        </select>
                         
                      </div>
                    </div>
        
                    <div class="col-sm-2 col-md-2">
                      <div class="form-group">
                        <label for="list_kategori">Debit</label>
                        <input type="number" class="form-control total " id="total" name="total" readonly>
                      </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                      <div class="form-group">
                        <label for="list_kategori">Kredit</label>
                        <input type="number" class="form-control" readonly="">
                      </div>
                    </div>
        
                    <div class="col-sm-3 col-md-3">
                      <!-- <div class="form-group">
                        <input class="form-control" type="text" name="no_urutan" placeholder="Nomor id" required>
                      </div> -->
                    </div>
        
                    <div class="mt-1">
                      <p class="mt-1 ml-3 text-warning"><strong>Cr</strong></p>
                    </div>
        
                    <div class="col-sm-4 col-md-4">
                      <div class="form-group">
                        <select name="metode" id="metode" class="form-control select2" required="">
                          <option value="" data-select2-id="13">-Pilih Akun-</option> 
                          @foreach ($akun2 as $a)
                              <option value="{{$a->id_akun}}">{{$a->nm_akun}}</option>
                          @endforeach                                       
                        </select>                      
                      </div>
                    </div>       
                    <div class="col-sm-2 col-md-2">
                      <div class="form-group">
                        <input type="number" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                      <div class="form-group">
        
                        <input type="number" class="form-control total" id="total1" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <h2 class="text-danger" id="testing"></h2>
                  </div>
                  <div class="modal-body detail" id="biayaUtama">
                  <div id="stok" class="detail">
                    <hr>
                    <div class="row">
                        <input type="hidden" name="stokMakanan" value="Y">
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
                          <input type="text" class="form-control input_detail input_stok" name="no_id[]" required>
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
        
                  </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary pen" id="save_btn">Edit/save</button>
                </div>
              </div>
        </div>
    </div>
</form>

{{-- tambah bahan --}}
<form id="modalBahan">
    @csrf
    <div class="modal fade tbhBahan" id="tbhBahan" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-costume">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Bahan</h5>
                    <button type="button" class="close merkB" aria-label="Close">
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
                                <select class="form-control select" id="tbh_idSatuan" name="id_satuan">
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
                    <button type="button" class="btn btn-secondary merkB">Close</button>
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

@endsection
@section('script')
<script>
    $(document).ready(function () {

        $("body").on("keyup", ".total_rp", function() {
            var debit = 0;
            $(".total_rp:not([disabled=disabled]").each(function() {
                debit += parseFloat($(this).val());
            });
            $('.total').val(debit);
        });

        $(".merkB").click(function (e) { 
            $('.tbhMerk').modal('hide')
            $('.tbhBahan').modal('hide')
        });

        var count = 1;
          $('#tambah_stok').click(function() {

            count = count + 1
      var html_code = "<div class='row' id='row_monitoring" + count + "'>";
              
          html_code += '<div class="col-md-3"><div class="form-group"><input type="text" class="form-control input_detail input_monitoring" name="no_id[]" required></div></div>';

          html_code += '<div class="col-md-3"><div class="form-group"><input type="text" class="form-control input_detail input_monitoring" name="keterangan[]" required></div></div>';


          html_code += '<div class="col-md-3"><div class="form-group"><select name="id_list_bahan[]" id="id_list_bahan'+count+'" detail="'+count+'" class="form-control select listBahan"></select></div></div>';

          html_code += '<div class="col-md-2"><div class="form-group"><input type="hidden" id="idSatuanResep'+count+'" readonly name="id_satuan[]" class="form-control input_detail input_stok"><input type="text" id="satuanResep'+count+'" readonly  class="form-control input_detail input_stok"></div></div>';

          html_code += '<div class="col-md-3"><div class="form-group"><select name="id_merk_bahan[]" id="id_merk_bahan'+count+'" class="form-control select satuan input_detail input_stok merkBahan" required><div class="km"></div></select></div></div>';
          html_code += '<div class="col-md-2"><div class="form-group"><input type="text" class="form-control input_detail input_monitoring qty_monitoring' + count + '" rp_satuan="' + count + '" name="qty[]" required></div></div>';


          html_code += '<div class="col-md-2"><div class="form-group"><input type="text" class="form-control  input_detail input_monitoring total_rp total_rp' + count + '" name="ttl_rp[]" total_rp="' + count + '" required></div></div>';

          html_code += ' <div class="col-md-1"><button type="button" name="remove" data-row="row_monitoring' + count + '" class="btn btn-danger btn-sm remove_stok">-</button></div>';
          
          
          html_code += "</div>";
          
          $('#detail_stok').append(html_code);
          $('.select').select2()
          loadBahan(count)
        });

        $(document).on('click', '.remove_stok', function() {
          var delete_row = $(this).data("row");
          $('#' + delete_row).remove();
        });
        loadBahan(1)
        
        function loadBahan(detail) {
          $("#id_list_bahan"+detail).load("{{route('getLbahan')}}", "data", function (response, status, request) {
          this; // dom element
          
        });
        }
        
        $(document).on('change', '.merkBahan', function(){
          var vMerk = $(this).val()
          if(vMerk == 'tbhM') {
            $('.tbhMerk').modal('show')
          }
        })

        $("#modalBahan").submit(function (e) { 
          e.preventDefault();
          var tbh_namaBahan = $("#tbh_namaBahan").val()
          var tbh_idSatuan = $("#tbh_idSatuan").val()
          var tbh_kategori = $("#tbh_kategori").val()

          $.ajax({
            type: "POST",
            url: "{{route('saveLbahan')}}",
            data: {
              nm_bahan : tbh_namaBahan,
              id_satuan : tbh_idSatuan,
              kategori : tbh_kategori,
              jp : 'Y',
              "_token" : "{{ csrf_token() }}"
            },
            success: function (data) {
              Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Tambah Bahan berhasil'
                    });

              $('#tbhBahan').modal('toggle');
              loadBahan(1)
            }
          });
        });

        $("#modalMerk").submit(function (e) { 
          e.preventDefault();
          var nm_merk = $("#nm_merk").val()
          var id_list_bahan = $("#id_list_bahan").val()

          $.ajax({
            type: "POST",
            url: "{{route('saveMbahan')}}",
            data: {
              nm_merk : nm_merk,
              id_list_bahan : id_list_bahan,
              "_token" : "{{ csrf_token() }}"
            },
            success: function (data) {
              Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Tambah Merk berhasil'
                    });

              $('#tbhMerk').modal('toggle');
              loadBahan(1)
            }
          });
        });

        function loadMerk(id_list_bahan,detail) {
          $.ajax({
            type: "GET",
            url: "{{route('getMerkBahan')}}?id_list_bahan="+id_list_bahan,

            success: function (d) {
              $("#id_merk_bahan"+detail).html(d);
              if(id_list_bahan == 'tbh') {
                $('.tbhBahan').modal('show')
              } else if(id_list_bahan == 0) {
                $(".merkLoop").hide()
              } 
            }
          });
        }

        $(document).on('change', '.listBahan', function(){
          var id_list_bahan = $(this).val()
          var detail = $(this).attr("detail");
         
          $.ajax({
            type: "GET",
            url: "{{route('getSatuanResep')}}?id_list_bahan="+id_list_bahan,
            dataType: "json",
            success: function (data) {
              $("#satuanResep"+detail).val(data.satuan)
              $("#idSatuanResep"+detail).val(data.id_satuan)
            }
          });
          loadMerk(id_list_bahan,detail)
          
        })

        $('.modal').on('hidden.bs.modal', function() {
            //If there are any visible
            if ($(".modal:visible").length > 0) {
                //Slap the class on it (wait a moment for things to settle)
                setTimeout(function() {
                    $('body').addClass('modal-open');
                }, 200)
            }
        });
    });
</script>
@endsection
