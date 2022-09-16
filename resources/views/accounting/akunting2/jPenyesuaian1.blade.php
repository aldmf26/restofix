@extends('accounting.template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                </div><!-- /.row -->
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
                                <h5 class="float-left">Jurnal Penyesuaian {{ date('d F Y', strtotime($tgl1)) }} ~
                                    {{ date('d F Y', strtotime($tgl2)) }}</h5>
                                <a href="" data-toggle="modal" data-target="#view"
                                    class="btn btn-info btn-sm float-right mr-1"><i class="fas fa-eye"></i> View</a>
                                <a href="#" data-target="#tambah" data-toggle="modal"
                                    class="btn btn-info btn-sm float-right mr-1 penyesuaian"><i class="fas fa-plus"></i>
                                    Penyesuaian</a>
                            </div>
                            <div class="card-body">
                                <div id="table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-striped dataTable no-footer" id="table"
                                                role="grid" aria-describedby="table_info">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th>No</th>
                                                        <th>Tanggal</th>
                                                        <th>No Invoice</th>
                                                        <th>No Akun</th>
                                                        <th>Nama Akun</th>
                                                        <th>Keterangan</th>
                                                        <th>Debit </th>
                                                        <th>Kredit</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($jurnal)) {
                                                        $jurnal1 = $jurnal[0];
                                                        $tgl = $jurnal1->tgl;
                                                        $kd_gabungan1 = $jurnal1->kd_gabungan;
                                                        $no = 0;
                                                        $i = 1;
                                                    }
                
                                                    foreach ($jurnal as $p) : ?>
                
                                                        <?php if ($kd_gabungan1 != $p->kd_gabungan) {
                                                            $no += 1;
                                                            $kd_gabungan1 = $p->kd_gabungan;
                                                            $tgl = $p->tgl;
                                                        }
                                                        if ($no % 2 == 0) : ?>
                                                            <tr style="background: #EEEEEE;">
                
                                                            <?php endif; ?>
                                                            <td><?= $i++ ?></td>
                                                            <?php if ($tgl != '') : ?>
                                                                <td><?= date('d-m-y', strtotime($tgl)) ?></td>
                                                            <?php else : ?>
                                                                <td></td>
                                                            <?php endif; ?>
                                                            <td><?= $p->no_nota ?></td>
                                                            <td><?= $p->no_akun ?></td>
                                                            <td><?= $p->nm_akun ?></td>
                                                            <td><?= $p->ket ?></td>
                                                            <td><?= number_format($p->debit, 0) ?> </td>
                                                            <td><?= number_format($p->kredit, 0) ?></td>
                                                            <td style="white-space: nowrap;">
                                                                <button type="button" class="btn btn-sm btn-info btn_edit" kd_gabungan='<?= $p->kd_gabungan ?>' data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
                                                                <a href="<?= route('deletePenyesuaian', ['kd_gabungan' => $p->kd_gabungan, 'tgl' => $p->tgl]) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
                                                            </td>
                                                            </tr>
                                                            <?php if ($kd_gabungan1 == $p->kd_gabungan) {
                                                                $tgl = '';
                                                            } ?>
                                                        <?php endforeach; ?>
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
    <style>
        .modal-lg-max {
            max-width: 1200px;
        }
    </style>
    {{-- modal export pertanggal --}}
    <form action="{{ route('jPenyesuaian1', ['acc' => Request::get('acc')]) }}" method="get">
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
                    <input type="hidden" name="acc" value="{{ Request::get('acc') }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Dari</label>
                                <input required type="date" name="tgl1" class="form-control mb-3">
                            </div>
                            <div class="col-md-6">
                                <label for="">Sampai</label>
                                <input required type="date" name="tgl2" class="form-control mb-3">
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

    <form action="" method="POST" id="form-jurnal">
        @csrf
        <div class="modal fade" id="tambah" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg-max" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="exampleModalLabel">Jurnal Penyesuaian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-header">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active penyesuaian2" id="pills-home-tab" data-toggle="pill"
                                    href="#pills-home" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Penyesuaian</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link atk" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                    role="tab" aria-controls="pills-contact" aria-selected="false">Atk &
                                    Perlengkapan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link daging" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                    role="tab" aria-controls="pills-contact" aria-selected="false">Daging & Ayam</a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-body">
                        <div id="form_penyesuaian">

                        </div>
                        <div id="form_penyesuaian2">

                        </div>
                        <div id="form_atk">

                        </div>
                        <div id="form_daging">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Input</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- edit jurnal --}}
    <form action="<?= route('edit_penyesuaian') ?>" method="POST">
        @csrf
        <div class="modal fade" id="edit" role="dialog">
            <div class="modal-dialog modal-lg-max">
    
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title">Edit Journal</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="get_jurnal">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Save/Edit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
    
    </form>
    {{-- ---------------- --}}
    {{-- end export pertanggal --}}
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
@endsection
@section('script')
    <script>
        $('#table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $('.btn_edit').click(function() {
            var kd_gabungan = $(this).attr("kd_gabungan");
            $("#get_jurnal").load("{{route('edit_get_jurnal')}}?kd_gabungan="+kd_gabungan, "data", function (response, status, request) {
                this; // dom element
                
            });
        });

        $(".penyesuaian").click(function(e) {
            e.preventDefault();
            $('#form_penyesuaian').load("<?= route('get_relation_akun') ?>", "data", function(response, status,
                request) {
                this; // dom element
                $('#form_atk').hide();
                $('#form_penyesuaian2').hide();
                    $('#form_penyesuaian').show();
                $("#form-jurnal").attr("action", "<?= route('add_penyesuaian_akun') ?>");
            });
        });

        $(document).on('click', '.penyesuaian2', function() {
            $('#form_penyesuaian2').load("<?= route('get_relation_akun') ?>", "data", function(response, status,
                request) {
                this; // dom element
                $('#form_penyesuaian2').show();
                    $('#form_atk').hide();
                    $('#form_daging').hide();
                    $('#form_penyesuaian').hide();
                    $('#form_aktiva').hide();
                    $('#form_peralatan').hide();
                $("#form-jurnal").attr("action", "<?= route('add_penyesuaian_akun') ?>");
            });
        });

        $(document).on('click', '.peralatan', function() {
            $('#form_peralatan').load("<?= route('get_relation_peralatan') ?>", "data", function(response, status,
                request) {
                this; // dom element
                $('#form_peralatan').show();
                    $('#form_aktiva').hide();
                    $('#form_daging').hide();
                    $('#form_penyesuaian').hide();
                    $('#form_penyesuaian2').hide();
                $("#form-jurnal").attr("action", "<?= route('add_penyesuaian_peralatan') ?>");
            });
        });

        $(document).on('click', '.atk', function() {
            $('#form_atk').load("<?= route('get_relation_atk') ?>", "data", function(response, status, request) {
                this; // dom element
                    $('#form_atk').show();
                    $('#form_daging').hide();
                    $('#form_penyesuaian').hide();
                    $('#form_penyesuaian2').hide();
                    $('#form_penyesuaian').hide();
                $("#form-jurnal").attr("action", "<?= route('add_penyesuaian_atk') ?>");
            });
        });

        $(document).on('click', '.daging', function() {
            $('#form_daging').load("<?= route('get_relation_daging') ?>", "data", function(response, status, request) {
                this; // dom element
                    $('#form_daging').show();
                    $('#form_atk').hide();
                    $('#form_penyesuaian').hide();
                    $('#form_penyesuaian2').hide();
                    $('#form_penyesuaian').hide();
                $("#form-jurnal").attr("action", "<?= route('add_penyesuaian_daging') ?>");
            });
        });

        $(document).on('keyup', '.akt', function() {
            var debit = 0;
            $(".akt").each(function() {
                debit += parseFloat($(this).val());
            });
            $('.ttl').val(debit);

        });

        $(document).on('keyup', '.qty', function() {
            var id = $(this).attr("id_atk");
            var quantity = $('.quantity' + id).val();
            var h_satuan = $('.h_satuan' + id).val();

            var ttl = parseFloat(quantity) * parseFloat(h_satuan);

            $('.ttl1' + id).val(ttl);


            var debit = 0;
            $(".ttl_op").each(function() {
                debit += parseFloat($(this).val());
            });
            $('.ttl_atk').val(debit);

        });

        $(document).on('keyup', '.qty', function() {
            var id = $(this).attr("id_atk");
            var quantity = $('.quantity' + id).val();
            var h_satuan = $('.h_satuan' + id).val();

            var ttl = parseFloat(quantity) * parseFloat(h_satuan);

            $('.ttl1' + id).val(ttl);


            var debit = 0;
            $(".ttl_op").each(function() {
                debit += parseFloat($(this).val());
            });
            $('.ttl_atk').val(debit);

        });

        $(document).on('keyup', '.daging', function() {
            var debit = 0;
            $(".akt").each(function() {
                debit += parseFloat($(this).val());
            });
            $('.ttl').val(debit);

        });
        
        $(document).on('keyup', '.qty_aktual', function() {
            var detail = $(this).attr('detail');
            var qty = $('.qty_ak' + detail).val();
            var h_satuan = $('.h_satuan' + detail).val();
            var qty_program = $('.qty_program' + detail).val();

            selisih = parseFloat(qty_program) - parseFloat(qty);
            debit = parseFloat(selisih) * parseFloat(h_satuan);

            $('.debit' + detail).val(debit);
            $('.selisih' + detail).val(selisih);
        });
        
        $(document).on('keyup', '.qty_d_aktual', function() {
            var id_list_bahan = $(this).attr('id_list_bahan');
            var qty_akt = $('.qty_ak_d' + id_list_bahan).val();
            var qty_pro = $('.qty_d_pro' + id_list_bahan).val();



            selisih = parseFloat(qty_pro) - parseFloat(qty_akt);
            $('.slsh_d' + id_list_bahan).val(selisih);

            var slsh = $('.slsh_d' + id_list_bahan).val();
            var h_satuan = $('.h_satuan_d' + id_list_bahan).val();

            total = parseFloat(slsh) * parseFloat(h_satuan)

            $('.tl_daging' + id_list_bahan).val(total);

            var debit = 0;
            $(".ttl_daging").each(function() {
                debit += parseFloat($(this).val());
            });

            $('.ttl_debit_d').val(debit);
        });
    </script>
@endsection
