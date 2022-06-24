<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- select 2 -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/daterangepicker/daterangepicker.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet"
href="{{ asset('assets') }}/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
href="{{ asset('assets') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
<!-- BS Stepper -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/bs-stepper/css/bs-stepper.min.css">
<!-- dropzonejs -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/dropzone/min/dropzone.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">
<link rel="stylesheet" type="text/css" href=" {{ asset('assets') }}/css/slider.css">
<link rel="stylesheet" type="text/css" href=" {{ asset('assets') }}/dropify/dist/css/dropify.min.css">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css"
rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
rel="stylesheet">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
rel="stylesheet">
    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                  
                    <div class="card-body">
                        <nav class="nav nav-tabs">
                            <li class="nav-item">

                                <a class="nav-link {{ $jenis == 'takemori' ? 'active' : '' }}" aria-current="page" href="{{ route('komisi', ['jenis' => 'takemori']) }}">Takemori</a>
                            </li>
                            <li class="nav-item">

                                <a class="nav-link {{ $jenis == 'soondobu' ? 'active' : '' }}" href="{{ route('komisi', ['jenis' => 'soondobu']) }}">Soondobu</a>
                            </li>
                          </nav>
                        <table class="table" id="table"> 
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Komisi</th>
                                    <th>Komisi Target</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                $ttl_komisi = 0;
                                $ttl_komisi_trg = 0;
                                foreach ($komisi as $k) :
                                    if ($k['nm_karyawan'] == 'SDB' || $k['nm_karyawan'] == 'TKMR') {
                                        continue;
                                    }
                                    if ($rules_active) {
                                        if ($rules_active['jenis'] == 'komisi') {
                                            if ($k['dt_komisi'] >= $rules_active['jumlah']) {
                                                $trg_komisi = $k['dt_komisi'] * $rules_active['persen'];
                                            } else {
                                                $trg_komisi = $k['dt_komisi'];
                                            }
                                        } else if ($rules_active['jenis'] == 'pendapatan') {
                                            if ($total_penjualan['ttl_penjualan'] >= $rules_active['jumlah']) {
                                                $trg_komisi = $k['dt_komisi'] * $rules_active['persen'];
                                            } else {
                                                $trg_komisi = $k['dt_komisi'];
                                            }
                                        } else {
                                            $trg_komisi = $k['dt_komisi'];
                                        }
                                    } else {
                                        $trg_komisi = $k['dt_komisi'];
                                    }

                                    $ttl_komisi_trg += $trg_komisi;
                                    $ttl_komisi += $k['dt_komisi'];

                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>

                                        <td><?= $k['nm_karyawan'] ?></td>
                                        <td><?= number_format($k['dt_komisi'], 0) ?></td>
                                        <td><?= number_format($trg_komisi, 0) ?></td>

                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">TOTAL</th>
                                    <th><?= number_format($ttl_komisi, 0); ?></th>
                                    <th><?= number_format($ttl_komisi_trg, 0); ?></th>
                                </tr>
                                <tr>
                                    <th colspan="2">Beban Resto</th>
                                    <th><?= number_format($komisi_resto['beban_komisi'], 0); ?></th>
                                    <?php
                                    if($ttl_komisi == 0) {
                                            $persen_resto = 0;
                                        } else {
                                            $persen_resto = $komisi_resto['beban_komisi'] ? ($komisi_resto['beban_komisi'] * 100) / $ttl_komisi : 0;
                                        }
                                    $beban_target_resto = $ttl_komisi_trg ? ($ttl_komisi_trg * $persen_resto) / 100 : 0;
                                    ?>
                                    <th><?= number_format($beban_target_resto, 0); ?></th>
                                </tr>
                                
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('assets') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('assets') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="{{ asset('assets') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets') }}/dist/js/adminlte.min.js"></script>
<script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets') }}/dist/js/demo.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js">
</script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
    function doubleClicked(element) {
        if (element.data('alreadyClicked')) {
            return true;
        } else {
            element.data('alreadyClicked', true);
            setTimeout(function() {
                element.removeData('alreadyClicked');
            }, 500); // (Prevent user from clicking the button more than once within 500ms (0.5s))
            return false;
        }
    }

    $(document).ready(function() {
        $('.first-button').on('click', function(e) {
            if (doubleClicked($(this))) {
                e.preventDefault(); // Prevent Default Action
                e.stopPropagation(); // Stop Navbar from opening/closing
                return;
            } else {
                $('.animated-icon1').toggleClass('open');
            }
        });
    });

    $(function() {
        $("#example1").DataTable({

            "lengthChange": false,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#table').DataTable({

            "bSort": true,
            // "scrollX": true,
            "paging": true,
            "stateSave": true,
            "scrollCollapse": true
        });

        $('#tabelAbsen').DataTable({

            "bSort": true,
            "scrollY": true,
            "paging": true,
            "stateSave": true,
            "scrollCollapse": true
        });

        $('#table2').DataTable({

            "bSort": true,
            // "scrollX": true,
            "paging": true,
            "stateSave": true,
            "scrollCollapse": true
        });
        $('#table3').DataTable({

            "bSort": true,
            // "scrollX": true,
            "paging": true,
            "stateSave": true,
            "scrollCollapse": true
        });

        $('#cek').DataTable({
            "paging": false,
            "pageLength": 100,
            "scrollY": "300px",
            "lengthChange": false,
            "ordering": false,
            "info": false,
            "stateSave": true,
            "autoWidth": true
        });

        $('#cek_kembali').DataTable({
            "paging": false,
            "pageLength": 100,
            "scrollY": "300px",
            "lengthChange": false,
            "ordering": false,
            "info": false,
            "stateSave": true,
            "autoWidth": true
        });

    });
</script>

<script>
    $(function() {
        $('.select').select2()
        $('.select').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Search...');
        });
    })
</script>
<script type="text/javascript" src="{{ asset('assets') }}/dropify/dist/js/dropify.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                default: 'Drag',
                replace: 'Ganti',
                remove: 'Hapus',
                error: 'error'
            }
        });
    });
</script>
  </body>
</html>