@extends('accounting.template.master')
@section('content')
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
            <div class="row">
                <div class="col-lg-10">
                    @include('accounting.template.flash')
                    <div class="card">
                        <div class="card-header">
                                <?php
                                $bulan = ['bulan', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                $bulan1 = (int)$month;
                                ?>
                                <h3 class="float-left">Saldo Buku Besar <?= $bulan[$bulan1] ?> <?= $year ?></h3>
                                <form action="">
                                    <button  data-toggle="modal" data-target="#view" class="btn btn-sm btn-primary float-right mt-1 ml-2" type="button"><i class="fa fa-eye"></i> View</button>              
                                    <a href="{{ route('addSaldoAwal',['acc' => Request::get('acc')]) }}" class="btn btn-sm btn-primary float-right mt-1 ml-2" type="button"><i class="fa fa-plus"></i> Saldo Awal</a>              
                                {{-- <select name="bulan" id="">
                                    <option value=""></option>
                                </select> --}}
                                <input type="hidden" name="id_lokasi" value="{{ Request::get('acc') }}">
                                </form>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <form action="" method="get">
                                {{-- <div class="row">
                                    <div class="col-lg-12">
                                            <label for="">Tanggal</label>
                                            <input type="date" value="2020-01-01" name="tgl" class="form-control col-lg-3">
                                            <label for="">Tes</label>
                                            <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-eye"></i> View</button>
                                            <input type="hidden" name="id_lokasi" value="{{ Request::get('acc') }}">
                                        </div>
                                        
                                    </div> --}}
                                </form> 
                                

                                <table class="table mt-2">
                                    <thead>                                
                                        <tr class="table-info">
                                            <th width="10%" class="sticky-top th">#</th>
                                            <th width="40%" class="sticky-top th">Akun</th>
                                            <th width="15%" class="sticky-top th">Debit</th>
                                            <th width="20%" class="sticky-top th">Kredit</th>
                                            <th width="20%" class="sticky-top th">Saldo</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $tgl = '';
                                        $total_debit = 0;
                                        $total_kredit = 0;
                                        $total_saldo = 0;
                                        $no = 1;
                                    ?>                
                                    <tbody>
                                        @php
                                            $kat = DB::table('tb_kategori_akun')->get();
                                        @endphp
                                        @foreach ($kat as $k)
                                            <tr>
                                                <td></td>
                                                <td><b>{{ $k->nm_kategori }}</b></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            @php
                                                $id_lokasi = Request::get('acc');
                                                $tb_akun = DB::select("SELECT a.id_akun, a.nm_akun, tb_neraca_saldo_penutup.debit, tb_neraca_saldo_penutup.kredit,c.debit_saldo,c.kredit_saldo FROM tb_akun as a
                                                            left join (SELECT a.id_akun, b.nm_akun, a.debit, a.kredit
                                                            FROM tb_neraca_saldo_penutup AS a
                                                            LEFT JOIN tb_akun AS b ON a.id_akun = b.id_akun                           
                                                            WHERE MONTH(a.tgl) = '$month' and YEAR(a.tgl) = '$year' and a.id_lokasi = '$id_lokasi' 
                                                            GROUP BY b.id_akun) tb_neraca_saldo_penutup on a.id_akun = tb_neraca_saldo_penutup.id_akun
                                                            LEFT JOIN tb_neraca_saldo as c ON a.id_akun = c.id_akun
                                                            WHERE a.id_lokasi = '$id_lokasi' and a.id_kategori = '$k->id_kategori'
                                                            order by a.id_akun ASC;");
                                            @endphp
                                            @foreach ($tb_akun as $a)     
                                            @php
                                                $total_debit += $a->debit;
                                                $total_kredit += $a->kredit;
                                                $total_saldo += $a->debit - $a->kredit ;
                                                $saldo = $a->debit - $a->kredit ;
                                            @endphp        
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $a->nm_akun }}</td>
                                                <td>{{ number_format($a->debit == '' ? 0 : $a->debit,0)}}</td>
                                                <td>{{ number_format($a->kredit == '' ? 0 : $a->kredit ,0) }}</td>
                                                <td>{{ number_format($saldo == '' ? 0 : $saldo,0) }}</td>
                                            </tr>
                                            @endforeach
                                        @endforeach
                                        {{-- @foreach ($tb_akun as $a)     
                                        @php
                                            $total_debit += $a->debit;
                                            $total_kredit += $a->kredit;
                                            $total_saldo += $a->debit - $a->kredit ;
                                            $saldo = $a->debit - $a->kredit ;
                                        @endphp        
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $a->nm_akun }}</td>
                                            <td>{{ number_format($a->debit == '' ? 0 : $a->debit,0)}}</td>
                                            <td>{{ number_format($a->kredit == '' ? 0 : $a->kredit ,0) }}</td>
                                            <td>{{ number_format($saldo == '' ? 0 : $saldo,0) }}</td>
                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Total</th>
                                            <th><?= number_format($total_debit, 0) ?></th>
                                            <th><?= number_format($total_kredit, 0) ?></th>
                                            <th><?= number_format($total_saldo, 0) ?></th>
                                        </tr>
                                    </tfoot>
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
<style>
    .modal-lg-max {
        max-width: 1000px;
    }

</style>
<form action="" method="GET">
    <div class="modal fade" id="view" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat data perperiode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="acc" value="{{ Request::get('acc') }}">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="list_kategori">Akun</label>
                                <select name="month" class="form-control" required="">
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="list_kategori">Tahun</label>
                                <select name="year" class="form-control select" required="">
                                    <?php foreach ($tahun as $t) : ?>
                                        <?php $tanggal = $t->tgl;
                                        $explodetgl = explode('-', $tanggal); ?>
                                        <option value="<?= $explodetgl[0]; ?>"><?= $explodetgl[0]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
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
@endsection