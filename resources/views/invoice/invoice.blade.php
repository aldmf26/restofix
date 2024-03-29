@extends('template.master')
@section('content')
    <style>
        /* .icon-menu:hover{
                background: #C8BED8;
                border-radius: 50px;
            } */

        h6 {
            color: #155592;
            font-weight: bold;
        }

    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2 justify-content-center">
                    <div class="col-sm-12">
                        <center>
                            <h4 style="color: #787878; font-weight: bold;">List Invoice</h4>
                        </center>

                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <a class="btn btn-info float-right" data-toggle="modal" data-target="#view"><i
                                class="fas fa-eye"></i> View</a>
                        <br>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table  " id="table" width="100%" style="font-size: 12px;">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" style="font-size: 12px;">No</th>
                                                <th rowspan="2" style="font-size: 12px;">Tanggal</th>
                                                <th rowspan="2" style="font-size: 12px;">No Order</th>
                                                <th rowspan="2" style="font-size: 12px;">Meja</th>
                                                <th rowspan="2" style="font-size: 12px;">Total</th>
                                                <th rowspan="2" style="font-size: 12px;">Discount</th>
                                                <th rowspan="2" style="font-size: 12px;">Voucher</th>
                                                <th rowspan="2" style="font-size: 12px;">Dp</th>
                                                <th rowspan="2" style="font-size: 12px;">Gosen</th>
                                                <th rowspan="2" style="font-size: 12px;">Total Bayar</th>
                                                <th rowspan="2" style="font-size: 12px;">Cash</th>
                                                <th colspan="2" style="font-size: 12px;">BCA<br></th>
                                                <th colspan="2" style="font-size: 12px;">Mandiri</th>
                                                <th rowspan="2" style="font-size: 12px;">Admin</th>
                                                <th rowspan="2" style="font-size: 12px;">Aksi</th>
                                            </tr>
                                            <tr>
                                                <th style="font-size: 12px;">Debit</th>
                                                <th style="font-size: 12px;">Kredit</th>
                                                <th style="font-size: 12px;">Debit<br></th>
                                                <th style="font-size: 12px;">Kredit</th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                    foreach ($invoice as $inv) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= date('d-m-Y', strtotime($inv->tgl_transaksi)) ?></td>
                                                <td><a href="<?= route('print_nota', ['no' => $inv->no_order]) ?>"
                                                        target="_blank"><?= $inv->no_order ?></a></td>
                                                <td><?= $inv->nm_meja ?></td>
                                                <td><?= number_format($inv->total_orderan + $inv->tax + $inv->service + $inv->ongkir + $inv->round, 0) ?>
                                                </td>
                                                <td><?= number_format($inv->discount, 0) ?></td>
                                                <td><?= $inv->voucher ?></td>
                                                <td><?= number_format($inv->dp, 0) ?></td>
                                                <td><?= number_format($inv->gosen, 0) ?></td>
                                                <td><?= number_format($inv->total_bayar, 0) ?></td>
                                                <td><?= number_format($inv->cash, 0) ?></td>
                                                <td><?= number_format($inv->d_bca, 0) ?></td>
                                                <td><?= number_format($inv->k_bca, 0) ?></td>
                                                <td><?= number_format($inv->d_mandiri, 0) ?></td>
                                                <td><?= number_format($inv->k_mandiri, 0) ?></td>
                                                <td><?= $inv->admin ?></td>
                                                <td>
                                                    <?php if(date('Y-m-d')): ?>
                                                    <a href="#" class="btn btn-danger btn-sm btn_hapus"
                                                        no_order="{{$inv->no_order}}" meja="{{$inv->nm_meja}}"
                                                        data-toggle="modal" data-target="#hapus_voucher"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                    <?php else: ?>
                                                    <?php endif ?>
    
                                                </td>
                                            </tr>
                                            <?php endforeach ?>

                                        </tbody>
                                    </table>

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
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <style>
        .modal-lg-max {
            max-width: 900px;
        }

    </style>

    <form action="" method="get">
        <div class="modal fade" id="view">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title">View</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="row">

                                <div class="col-lg-6">
                                    <label for="">Dari</label>
                                    <input type="date" name="tgl1" class="form-control">
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Sampai</label>
                                    <input type="date" name="tgl2" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" target="_blank">Lanjutkan</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{route('hapus_invoice')}}" method="post">
        @csrf
        <div class="modal fade" id="hapus_voucher">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bg-danger ">
                        <h4 class="modal-title">Hapus data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <label for="">Inoice</label>
                                    <input type="text" id="no_order" name="no_invoice" class="form-control" readonly>
                                    <input type="hidden" id="meja" name="meja" class="form-control" readonly>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Masukan voucher</label>
                                    <input type="text" name="kd_voucher" class="form-control">
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <label for="">Alasan</label>
                                    <input type="text" class="form-control" name="alasan">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-info" target="_blank">Lanjutkan</button>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $(document).on('click', '.btn_hapus', function() {
            var no_order = $(this).attr("no_order");
            var meja = $(this).attr("meja");

            $('#no_order').val(no_order);
            $('#meja').val(meja);
                

        });

        
    });
</script>
@endsection