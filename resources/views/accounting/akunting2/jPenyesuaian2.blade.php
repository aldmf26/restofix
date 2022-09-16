@extends('accounting.template.master')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">


            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">

                </div>
                <div class="col-12">
                    @include('accounting.template.flash')

                    <div class="card">
                        <div class="card-header">
                            <h4 class="float-left">Jurnal Penyesuaian <?= date('d-F-Y', strtotime($tgl1)) ?> ~ <?= date('d-F-Y', strtotime($tgl2)) ?></h4>
                            <button type="button" class="btn btn-sm btn-info float-right ml-2 penyesuaian" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data</button>
                            <button type="button" class="btn btn-sm btn-info float-right ml-2" data-toggle="modal" data-target="#view-proyek"><i class="fa fa-eye"></i> View Data</button>
                            <a class="btn btn-sm btn-info float-right ml-2" href="<?= route("exportJP2", ['tgl1' => $tgl1, 'tgl2' => $tgl2]) ?>">Export</a>
                            <a class="btn btn-sm btn-info float-right ml-2" data-target="#import" data-toggle="modal" href="#">Import</a>
                        </div>
                        <div class="card-body">
                            <table class="table mt-2" id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>No Nota</th>
                                        <th>No Akun</th>
                                        <th>Nama Akun</th>
                                        <th>Keterangan</th>
                                        <th>Debit</th>
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
                                                <a href="<?= route('deletePenyesuaian', ['kd_gabungan' => $p->kd_gabungan, 'tgl' => $p->tgl])?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
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
    </section>
</div>
<form action="" method="GET">
    <div class="modal fade" id="view-proyek" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">View data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="acc" value="{{ Request::get('acc') }}">
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label>Dari</label>
                            <input type="date" name="tgl1" class="form-control" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>Sampai</label>
                            <input type="date" name="tgl2" class="form-control" required>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Lihat</button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- Modal -->



<style>
    .modal-lg-max {
        max-width: 1200px;
    }
</style>

<form action="" method="POST" id="form-jurnal">
    @csrf
    <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <a class="nav-link aktiva active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Aktiva</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link peralatan" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Peralatan</a>
                        </li>

                    </ul>
                </div>
                <div class="modal-body">
                    <div id="form_aktiva">

                    </div>
                    <div id="form_peralatan">

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


<!-- =========================Modal Edit============= -->
<form action="<?= route('edit_penyesuaian') ?>" method="POST">
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

@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.btn_edit').click(function() {
            var kd_gabungan = $(this).attr("kd_gabungan");
            $("#get_jurnal").load("{{route('edit_get_jurnal')}}?kd_gabungan="+kd_gabungan, "data", function (response, status, request) {
                this; // dom element
                
            });
        });

        $(".penyesuaian").click(function(e) {
            e.preventDefault();
            $('#form_aktiva').load("<?= route('get_relation_aktiva') ?>", "data", function(response, status,
                request) {
                this; // dom element
                $('#form_penyesuaian2').hide();
                    $('#form_penyesuaian').show();
                $("#form-jurnal").attr("action", "<?= route('add_penyesuaian_aktiva') ?>");
            });
        });

        $(".aktiva").click(function(e) {
            e.preventDefault();
            $('#form_aktiva').load("<?= route('get_relation_aktiva') ?>", "data", function(response, status,
                request) {
                this; // dom element
                $('#form_aktiva').show();
                    $('#form_penyesuaian').hide();
                    $('#form_penyesuaian2').hide();
                    $('#form_peralatan').hide();
                $("#form-jurnal").attr("action", "<?= route('add_penyesuaian_aktiva') ?>");
            });
        });

        $(".peralatan").click(function(e) {
            $('#form_peralatan').load("<?= route('get_relation_peralatan') ?>", "data", function(response, status,
                request) {
                this; // dom element
                $('#form_peralatan').show();
                    $('#form_aktiva').hide();
                    $('#form_penyesuaian').hide();
                    $('#form_penyesuaian2').hide();
                $("#form-jurnal").attr("action", "<?= route('add_penyesuaian_peralatan') ?>");
            });
        });

        $(document).on('keyup', '.total_aktiva', function() {
            var total = $(this).val();
            var detail = $(this).attr("detail");
            var total2 = $('.tl_akv_debit' + detail).val();
            if (total == "") {
                var hasil = parseFloat(total2);
            } else {
                var hasil = parseFloat(total2) - parseFloat(total);
            }

            // alert(detail);
            $('.hasil' + detail).val(hasil);
            $('.total_peralatan' + detail).val(total);

        });
        $(document).on('keyup', '.peralatan', function() {
            var total = $(this).val();
            $('.peralatan').val(total);
        });

        
        $(document).on('change', '#tgl_akv', function() {
            var tgl_akv = $(this).val();
            $('#barang').load("{{route('get_aktiva')}}?tgl_akv="+tgl_akv, "data", function (response, status, request) {
                this; // dom element
                var barang2 = $('#barang2').hide();
            });
           
        });

        $(document).on('change', '#tgl_akv', function() {
            var tgl_akv = $(this).val();
            $('#barang').load("{{route('jumlah_akv')}}?tgl_akv="+tgl_akv, "data", function (response, status, request) {
                this; // dom element
                $('.ttl').val(data);
            });
           
        });

       
        $(document).on('keyup', '.kredit', function() {
            var debit = 0;
            $(".kredit").each(function() {
                debit += parseFloat($(this).val());
            });
            $('.total').val(debit);

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


    });
</script>
@endsection