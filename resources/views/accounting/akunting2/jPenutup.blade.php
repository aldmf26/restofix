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
                            <h4 class="float-left">Jurnal Penutup <?= date('d-F-Y', strtotime($tgl1)) ?> ~ <?= date('d-F-Y', strtotime($tgl2)) ?></h4>
                            <button type="button" class="btn btn-sm btn-info float-right ml-2 penutup" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data</button>
                            <button type="button" class="btn btn-sm btn-info float-right ml-2" data-toggle="modal" data-target="#view-proyek"><i class="fa fa-eye"></i> View Data</button>
                            <a class="btn btn-sm btn-info float-right ml-2" href="<?= route("printJPenutup", ['tgl1' => $tgl1]) ?>"><i class="fas fa-print"></i> Laporan Jurnal Penutup</a>
                            <a class="btn btn-sm btn-info float-right ml-2" href="<?= route("excelJPenutup", ['tgl1' => $tgl1, 'tgl2' => $tgl2]) ?>"><i class="fas fa-download"></i> Export</a>
                            <a class="btn btn-sm btn-info float-right ml-2" href="#" data-target="#import" data-toggle="modal"><i class="fas fa-upload"></i> Import</a>

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
                                        <!--<th>Aksi</th>-->
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

{{-- view data --}}
<form action="{{ route('jPenutup', ['acc' => Request::get('acc')]) }}" method="GET">
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
                    <div class="row">
                        <input type="hidden" name="acc" value="{{ Request::get('acc') }}">
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
{{-- - --}}

{{-- import j penutup --}}
<form action="<?= route('importJPenutup') ?>" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="import" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12 col-md-12">
                            <label>Input File</label>
                            <input type="file" name="jurnal" class="form-control">
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
{{--  --}}

<style>
    .modal-lg-max {
        max-width: 1200px;
    }
</style>

{{-- add penutup --}}
<form action="<?= route("addJPenutup") ?>" method="POST">
    @csrf
    <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg-max" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Jurnal Penutup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="form_penutup">

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
{{-- -- --}}
@endsection
@section('script')
<script>
    $(document).on('click', '.penutup', function() {
        $("#form_penutup").load("{{route('get_akun_penutup')}}", "data", function (response, status, request) {
            this; // dom element
            $(".prive").keyup(function (e) { 
                var v = $('.prive').val()
                $('.prive').val(v)
            });
        });

        });
</script>
@endsection