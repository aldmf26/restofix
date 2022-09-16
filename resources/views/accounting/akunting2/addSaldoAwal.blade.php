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
    <style>
        .scroll {
            overflow-x: auto;
            height: 450px;
            overflow-y: scroll;
        }

        .form-control1 {
            display: block;
            width: 100%;
            height: calc(2.25rem + -9px);
            padding: .375rem .75rem;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            box-shadow: inset 0 0 0 transparent;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
               @include('accounting.template.flash')
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Atur Saldo Awal</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="tambah_saldo">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="">Tanggal Saldo Awal</label>
                                            <input type="date" name="tgl" class="form-control" id="tgl_peng" required>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <button type="submit" class="btn btn-info  float-right mt-4 buton">Simpan Neraca Saldo</button>
                                        </div>
                                    </div>
                                    <h2 class="text-danger" id="testing"></h2>
                                    <div class="scroll">
                                        <table class="table mt-2" width="100%">
                                            <thead>
                                                <tr>
                                                    <th width="3%">No</th>
                                                    <th width="47%">Nama Akun</th>
                                                    <th width="25%">Debit</th>
                                                    <th width="25%">Kredit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1;
                                                $kategori = DB::table('tb_kategori_akun')->get();
                                                foreach ($kategori as $k) : ?>
                                                    <?php $saldo = DB::select("SELECT * From tb_akun as a where a.id_kategori = '$k->id_kategori' ") ?>
                                                    <tr>
                                                        <td colspan="4">
                                                            <dt><?= $k->nm_kategori ?></dt>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                    foreach ($saldo as $s) :
                                                    ?>
                                                        <tr>
                                                            <td><?= $i++ ?></td>
                                                            <td><?= $s->nm_akun ?>
                                                                <input type="hidden" value="<?= $s->id_akun ?>" name="id_akun[]">
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <p class="debit debit_akun<?= $s->id_akun ?>" id_akun="<?= $s->id_akun ?>">Rp.0</p>
                                                                <input type="number" name="debit[]" style="text-align: right;" class="form-control1 debit_input debit_form_input<?= $s->id_akun ?>" id_akun="<?= $s->id_akun ?>" value="0" autofocus>
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <p class="kredit kredit_akun<?= $s->id_akun ?>" id_akun="<?= $s->id_akun ?>">Rp.0</p>
                                                                <input type="number" name="kredit[]" style="text-align: right;" class="form-control1 kredit_input kredit_form_input<?= $s->id_akun ?>" id_akun="<?= $s->id_akun ?>" value="0" autofocus>
                                                            </td>

                                                        </tr>
                                                    <?php endforeach ?>
                                                <?php endforeach ?>

                                            </tbody>
                                            <tfoot>
                                                <th>Total</th>
                                                <th></th>
                                                <th style="text-align: right;"><input type="hidden" value="0" class="total_debit">
                                                    <p class="text_debit"></p>
                                                </th>
                                                <th style="text-align: right;"><input type="hidden" value="0" class="total_kredit">
                                                    <p class="text_kredit"></p>
                                                </th>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

</div>
<style>
    .modal-lg-max {
        max-width: 1000px;
    }
</style>
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg-max" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-costume">
                <h5 class="modal-title" id="exampleModalLabel">Saldo Awal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Silahkan konfirmasi untuk menerbitkan saldo awal dengan kondisi di bawah ini:</h5>
                <br>
                <p>
                    Total debit dan kredit harus sama. Total selisih berjumlah <span class="selisih text-danger"></span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {


hide_input();

function hide_input() {
    $(".debit_input").hide();
    $(".kredit_input").hide();
    // alert(id_distribusi);

}

$(document).on('click', '.debit', function() {
    var id_akun = $(this).attr('id_akun');
    $(".debit_akun" + id_akun).hide();
    $(".debit_form_input" + id_akun).show();
    $(".debit_form_input" + id_akun).focus();
    $(".debit_form_input" + id_akun).select();
    // $('.debit_hasil' + id_akun).val(debit);
});

$(document).on('click', '.debit_input', function() {
    var id_akun = $(this).attr('id_akun');
    $(".debit_form_input" + id_akun).hide();
    $(".debit_akun" + id_akun).show();
    var debit = $(".debit_akun" + id_akun).val();
    // $('.debit_hasil' + id_akun).val(debit);
});

$("#tgl_peng").change(function (e) { 
    var tgl_pen = $(this).val();
    const d = new Date(tgl_pen);
    let month = d.getMonth();
    let year = d.getFullYear();

    var bulan = month + 1
    var tahun = year

    $.ajax({
        url: "<?= route('saldoAwalDanger'); ?>?bulan="+bulan+"&tahun="+tahun,
        type: "GET",
        // dataType: "json",
        success: function(data) {
            // alert(data)
          $('#testing').text(data);
          if (data != '') {
            $('.scroll').hide();
            $('.buton').attr('disabled', 'true');
          } else {
            $('.scroll').show();
            $('.buton').removeAttr('disabled', 'true');
          }
        }

    });
    
});

$(document).on('keyup', '.debit_input', function() {
    var id_akun = $(this).attr('id_akun');

    var debit = $(".debit_form_input" + id_akun).val();

    var debit2 = parseFloat(debit);

    var number = debit2.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

    var rupiah = "Rp. " + number;
    $(".debit_akun" + id_akun).text(rupiah);


    var total = 0;
    $(".debit_input:not([disabled=disabled]").each(function() {
        total += parseFloat($(this).val());
    });
    $('.total_debit').val(total);
    var number_total = total.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    var rupiah_total = "Rp. " + number_total;
    $('.text_debit').text(rupiah_total);

});


// Kredit -----------------------------------
$(document).on('click', '.kredit', function() {
    var id_akun = $(this).attr('id_akun');
    $(".kredit_akun" + id_akun).hide();
    $(".kredit_form_input" + id_akun).show();
    $(".kredit_form_input" + id_akun).focus();
    $(".kredit_form_input" + id_akun).select();
    // $('.debit_hasil' + id_akun).val(debit);
});
$(document).on('click', '.kredit_input', function() {
    var id_akun = $(this).attr('id_akun');
    $(".kredit_form_input" + id_akun).hide();
    $(".kredit_akun" + id_akun).show();
});

$(document).on('keyup', '.kredit_input', function() {
    var id_akun = $(this).attr('id_akun');

    var kredit = $(".kredit_form_input" + id_akun).val();

    var kredit2 = parseFloat(kredit);

    var number = kredit2.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

    var rupiah = "Rp. " + number;
    $(".kredit_akun" + id_akun).text(rupiah);

    var total = 0;
    $(".kredit_input:not([disabled=disabled]").each(function() {
        total += parseFloat($(this).val());
    });
    $('.total_kredit').val(total);

    var number_total = total.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    var rupiah_total = "Rp. " + number_total;
    $('.text_kredit').text(rupiah_total);
});

$(document).on('submit', '#tambah_saldo', function(event) {
    event.preventDefault();
    var acc = "{{Request::get('acc')}}"
    var debit = $(".total_debit").val();
    var kredit = $(".total_kredit").val();
    var total = parseFloat(debit) - parseFloat(kredit);
    if (debit == kredit) {
        $.ajax({
            url: "{{route('saveSaldoAwal')}}",
            type: 'GET',
            data: $("#tambah_saldo").serialize(),
            success: function(data) {

            }
        });
        window.location = "<?= route('neracaSaldoBaru') ?>?acc="+acc;
    } else {
        var number_total = total.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        var rupiah_total = "Rp. " + number_total;
        $('.selisih').text(rupiah_total);
        $('#myModal').modal('show')
    }



});
});
</script>
@endsection