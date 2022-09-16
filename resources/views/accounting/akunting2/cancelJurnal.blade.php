@extends('accounting.template.master')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">

                    </div>

                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @include('accounting.template.flash')
                <div class="row ">

                    <div class="col-md-6">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="float-left">Cancel Jurnal</h5>
                            </div>
                            <form action="<?= route('saveCancel') ?>" method="post">
                                @csrf
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Bulan-Tahun</th>
                                                <th>Penyesuaian</th>
                                                <th>Penutup</th>
                                            </tr>
                                        </thead>
                                        @if (empty($tgl))
                                        @else
                                        <tbody>
                                            <?php
                                        foreach ($tgl as $t) :
                                        ?>
                                            <?php $penyesuaian = DB::selectOne("SELECT MONTH(a.tgl) as bulan2 FROM tb_jurnal as a where MONTH(a.tgl) = '$t->bulan' and YEAR(a.tgl) = '$t->tahun' and a.id_buku = '4' and a.id_lokasi = '$id_lokasi' GROUP BY MONTH(a.tgl) "); ?>

                                            <?php $penutup = DB::selectOne("SELECT MONTH(a.tgl) as bulan2 FROM tb_jurnal as a where MONTH(a.tgl) = '$t->bulan' and YEAR(a.tgl) = '$t->tahun' and a.id_buku = '5' and a.id_lokasi = '$id_lokasi' GROUP BY MONTH(a.tgl) "); ?>
                                            <tr>
                                                <td><?= $t->bulan ?> - <?= $t->tahun ?> </td>
                                                <td>

                                                        <?php if (empty($penyesuaian)) : ?>
                                                            <input type="checkbox" class="form-checkbox1" id_checkbox="<?= $t->id_jurnal ?>" name="penyesuaian[]" id="" value="">
                                                        <?php else : ?>
                                                            <input type="checkbox" class="form-checkbox1" id_checkbox="<?= $t->id_jurnal ?>" name="penyesuaian[]" id="" value="<?= $t->bulan ?>" checked>
                                                        <?php endif ?>
                                                    </td>
                                                <td>
                                                    <input type="hidden" name="bulan[]" class="bulan<?= $t->id_jurnal ?>"
                                                        value="<?= $t->bulan ?>">
                                                    <input type="hidden" name="id_jurnal[]" value="<?= $t->id_jurnal ?>">
                                                    <input type="hidden" name="tahun[]" class="tahun<?= $t->id_jurnal ?>"
                                                        value="<?= $t->tahun ?>">
                                                    <?php if (empty($penutup)) : ?>
                                                    <input type="checkbox" class="form-checkbox2"
                                                        id_checkbox_pen="<?= $t->id_jurnal ?>" name="penutup[]"
                                                        id="" value="2">
                                                    <?php else : ?>
                                                    <input type="checkbox" class="form-checkbox2"
                                                        id_checkbox_pen="<?= $t->id_jurnal ?>" name="penutup[]"
                                                        id="" value="1" checked>
                                                    <?php endif ?>

                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                            <input type="hidden" name="bln_pen" class="bln_pen">
                                            <input type="hidden" name="thn_pen" class="thn_pen">

                                            {{-- <input type="text" name="bln" class="bln">
                                            <input type="text" name="thn" class="thn"> --}}

                                            <input type="hidden" name="bulan_akhir" value="<?= $t->bulan ?>">
                                            <input type="hidden" name="tahun_akhir" value="<?= $t->tahun ?>">
                                        </tbody>
                                        @endif
                                    </table>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="float-right btn btn-info">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>




            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.form-checkbox1').click(function() {
                var id_checkbox = $(this).attr("id_checkbox");
                var bulan = $('.bulan' + id_checkbox).val();
                var tahun = $('.tahun' + id_checkbox).val();


                // alert(bulan);
                if ($(this).is(':checked')) {
                    var nilai1 = '';
                    $('.bln_pen').val(nilai1);
                    var nilai2 = '';
                    $('.thn_pen').val(nilai2);
                } else {
                    var nilai1 = bulan;
                    $('.bln_pen').val(nilai1);
                    var nilai2 = tahun;
                    $('.thn_pen').val(nilai2);
                }
            });
            $('.form-checkbox2').click(function() {
                var id_checkbox_pen = $(this).attr("id_checkbox_pen");
                var bulan = $('.bulan' + id_checkbox_pen).val();
                var tahun = $('.tahun' + id_checkbox_pen).val();

                // alert(id_checkbox_pen)
                if ($(this).is(':checked')) {
                    var nilai1 = '';
                    $('.bln_pen').val(nilai1);
                    var nilai2 = '';
                    $('.thn_pen').val(nilai2);
                } else {
                    var nilai1 = bulan;
                    $('.bln_pen').val(nilai1);
                    var nilai2 = tahun;
                    $('.thn_pen').val(nilai2);
                }
            });
        });
    </script>
@endsection
