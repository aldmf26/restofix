@extends('template.master')
@section('content')
    <style>
        h6 {
            color: #155592;
            font-weight: bold;
        }

    </style>


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

            </div><!-- /.container-fluid -->
        </div>
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <a href=""></a>
                        <div class="card mb-2" style="background-color: #25C584;">
                            <div class="card-body">
                                <h3 style="text-align: center; color:white"><?= $no ?></h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form action="<?= route('save_transaksi') ?>" method="post" class="form_save">
                                    @csrf
                                    <input type="hidden" name="no_order" id="no_order" value="<?= $no ?>">
                                    <div id="orderan">

                                    </div>
                                </form>
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            load_order();

            function load_order() {
                var no_order = $("#no_order").val();
                // alert(no_order);
                $.ajax({
                    method: "GET",
                    url: "<?= route('list_order2') ?>?no=" + no_order,
                    dataType: "html",
                    success: function(hasil) {
                        $('#orderan').html(hasil);
                    }
                });
            }

            $(document).on('input', '.qty', function() {
                var detail = $(this).attr('detail');
                var qty = $(this).val();
                var harga = $(".harga" + detail).val();
                var ttl_rp = parseFloat(qty) * parseFloat(harga);
                var max = $(this).attr('max');
                var min = $(this).attr('min');

                if (qty > max) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'error',
                        title: 'Jumlah yang dimasukkan melebihi pesanan'
                    });
                }
                var number = ttl_rp.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                $(".total" + detail).text(number);
                $("#total_id" + detail).val(ttl_rp);

                var ttl = $(".tl").val();
                var qty1 = 0;
                $(".qty").each(function() {
                    qty1 += parseFloat($(this).val());

                });
                var ttl_rp1 = 0;
                $(".tl").each(function() {
                    ttl_rp1 += parseFloat($(this).val());

                });
                var number2 = ttl_rp1.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                $('.total_qty').text(qty1);
                $('.total_hrg').text(number2);
                $('.ttl_hrg').val(ttl_rp1);


                var a_okr = $("#a_okr").val();
                var a_ser = $("#a_ser").val();

                var batas = $("#batas").val();

                var ong = $("#ong").val();
                console.log(a_okr);

                if (ttl_rp1 < batas) {
                    if (a_okr == 'Y') {
                        var ongkir = parseFloat(ong);
                    } else {
                        var ongkir = 0;
                    }
                } else {
                    var ongkir = 0;
                }

                if (a_ser == 'Y') {
                    var service = ttl_rp1 * 0.07;
                } else {
                    var service = 0;
                }
                if (a_ser == 'Y') {
                    var tax = (ttl_rp1 + service + ongkir) * 0.1;
                } else {
                    var tax = (ttl_rp1 + ongkir) * 0.1;
                }

                var number3 = ongkir.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                var servis = service.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

                var tax1 = tax.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                var servis2 = service.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1");

                $('.ongkir').text(number3);
                $('.servis').text(servis);
                $('.servis1').val(servis2);
                $('.tax').text(tax1);
                $('.tax1').val(tax);

                var total = ttl_rp1 + service + tax + ongkir;


                var a = Math.round(total);
                var a_format = a.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

                var b = a_format.substr(-3);
                if (b == '000') {
                    c = a;
                    round = '000';
                } else if (b < 1000) {
                    c = a - b + 1000;
                    round = 1000 - b;
                }


                var rupiah = $("#rupiah").val();
                $('#total2').val(c);
                $('.round').val(round);
                $('#total1').val(c);

            });

            $(document).on('click', '#proses', function(event) {
                var ttl_harga = $(".ttl_hrg").val();
                var order = $(".order").val();
                var url = "<?= route('perhitungan') ?>?order=" + order + '&ttl=' + ttl_harga;
                $('#perhitungan').load(url);
            });

            $(document).on('submit', '.form_save', function(event) {
                //   event.preventDefault();

                $('.save_btn').hide();
                // $('.save_loading').show();

            });
            function reset(){
                var ttl_hrg2 = $('#ttl_hrg2').val();
                var tax2 = $('.tax2').val();
                var round2 = $('.round2').val();
                var service2 = $('.servis2').val();
                var ttl = parseInt(ttl_hrg2) + parseInt(tax2) + parseInt(service2) + parseInt(round2)


                $('#view_discount').val('');
                $('#data_discount').val(0);
                $('#total1').val(ttl);
                $('#totalTetap').val(ttl);
                $('.sDiskon').val(round2);
                $('.round').val(round2);
                $('.servis1').val(service2);
                $('.servis').html(service2);  
                $('.tax1').val(tax2);
                $('.tax').html(tax2);  

                $('.kd_voucher').val('');
                $('#rupiah').val(0);  
                $("#view_dp").val(0);
                $("#data_dp").val(0);
                $("#id_dp").val(0);
                $("#kembalian1").val(0);
                $('.vDiskon').val(0);
                $("#jumlah_dp").val(0);
            }
            $(document).on('change', '#data_discount', function(){
                var id_disc = $(this).val();
                var ttl_hrg = $('#ttl_hrg').val();
                var ttl_hrg2 = $('#ttl_hrg2').val();
                var view_discount = $('#view_discount').val();
                var tax = $('#tax').val();
                var tax2 = $('.tax2').val();
                var service = $('.servis1').val();
                var service2 = $('.servis2').val();
                var round = $('.round').val();
                var round2 = $('.round2').val();
                var sDiskon = $('.sDiskon').val();
                var ttl = parseInt(ttl_hrg2) + parseInt(tax2) + parseInt(service2) + parseInt(round2)
                var voucher = $('#rupiah').val();
                var jumlahDp = $("#jumlah_dp").val();
                if(id_disc == 0) {
                    reset()
                    // $('#view_discount').val('');
                    // $('#total1').val(ttl);
                    // $('.sDiskon').val(round2);
                    // $('.round').val(round2);
                    // $('.servis1').val(service2);
                    // $('.servis').html(service2);  
                    // $('.tax1').val(tax2);
                    // $('.tax').html(tax2);  
                                         
                } else {
                    $.ajax({
                        url: "<?= route('get_discount') ?>?id_discount=" + id_disc,
                        method: "GET",
                        dataType: "json",
                        success: function(data) {
                            if(jumlahDp > 0) {
                                $("#data_dp").val(0);
                                $("#jumlah_dp").val('');
                                $("#kode_dp").val('');
                                $("#view_dp").val('');
                                
                            }
                            $("#jumlah_discount").val(data.disc);
                            var tHarga = parseInt(ttl_hrg) * (100 - parseInt(data.disc)) / 100 - voucher
                            var service = tHarga * 0.07;
                            var tax = (tHarga + service) * 0.1;
                            var t = tHarga + service + tax;
                            var a = Math.round(t);
                            var a_format = a.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

                            var b = a_format.substr(-3);
                            if (b == '000') {
                                c = a;
                                round = '000';
                            } else if (b < 1000) {
                                c = a - b + 1000;
                                round = 1000 - b;
                            }
                            if(c < 0) {
                                c = 0
                                tax = 0
                                service = 0
                            } else {
                                c = c 
                                tax = tax
                                service = service
                            }
                                      
                            $('#total1').val(c);
                            $('#totalTetap').val(c);
                            $('.round').val(round);
                            $('.round2').val(round2);
                            $('.sDiskon').val(tHarga);
                            $('.servis').html(service);
                            $('.servis1').val(service);   
                            $('.tax').html(tax);
                            $('.tax1').val(tax);   
                            $('#jumlah_discount').val($("#jumlah_discount").val());   
                            $("#view_discount").val($("#jumlah_discount").val()+' %');
                            $(".vDiskon").val($("#jumlah_discount").val());
                        }
                    })
                }
            })
            $(document).on('click', '#cek_voucher', function(event) {
                var kode = $('.kd_voucher').val();
                var ttl1 = $('#total1').val();
                var ttl2 = $('#total2').val();
                var view_dp = $('#view_dp').val();
                var view_discount = $('#view_discount').val()
                var gosen = $('#gosen').val();
                var ttl_hrg = $('#ttl_hrg').val();
                var ttl_hrg2 = $('#ttl_hrg2').val();
                var sDiskon = $('.sDiskon').val();
                var vDiskon = $('.vDiskon').val();
                var jumlahDp = $("#jumlah_dp").val();
                var total_tetap = $('#totalTetap').val();
                if (kode == '') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'error',
                        title: 'Masukkan kode voucher'
                    });
                } else {
                    $.ajax({
                        url: "<?= route('voucher_pembayaran') ?>?kode=" + kode,
                        type: "GET",
                        // dataType: "json",
                        success: function(data) {
                            if (data == 'kosong') {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    icon: 'error',
                                    title: 'Kode voucher tidak ditemukan'
                                });

                            } else {
                                if (data == 'terpakai') {
                                    Swal.fire({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        icon: 'error',
                                        title: 'Voucher sudah terpakai'
                                    });
                                } if(data == 'expired') {
                                    Swal.fire({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        icon: 'error',
                                        title: 'Voucher sudah expired'
                                    });
                                }
                                else {
                                    if (data == 'off') {
                                        Swal.fire({
                                            toast: true,
                                            position: 'top-end',
                                            showConfirmButton: false,
                                            timer: 3000,
                                            icon: 'error',
                                            title: 'Voucher non-aktif'
                                        });
                                    } else {
                                        
                                        if(jumlahDp > 0) {
                                            $("#data_dp").val(0);
                                            $("#jumlah_dp").val('');
                                            $("#kode_dp").val('');
                                            $("#view_dp").val('');
                                        }
                                        $('#rupiah').val(data);
                                        
                                        if(sDiskon == parseInt($('.round').val())) {
                                            var tot_orderan = ttl_hrg - data;
                                        
                                        } else {
                                           
                                            var tot_orderan = parseInt(sDiskon) - data;
                                        }
                                    
                                        if(tot_orderan < 1) {
                                            tot_orderan = 0
                                            var service = 0;
                                            var tax = 0;
                                            var t = 0;
                                            var c = 0;
                                            var round = 0;
                                        } else {
                                            tot_orderan = tot_orderan
                                            var service = tot_orderan * 0.07;
                                            var tax = (tot_orderan + service) * 0.1;
                                            var t = tot_orderan + service + tax - view_dp +
                                                parseFloat(gosen);
                                            var a = Math.round(t);
                                            var a_format = a.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

                                            var b = a_format.substr(-3);
                                            if (b == '000') {
                                                c = a;
                                                round = '000';
                                            } else if (b < 1000) {
                                                c = a - b + 1000;
                                                round = 1000 - b;
                                            }
                                            if(c < 1) {
                                                c = 0
                                                tax = 0
                                                service = 0
                                                round = 0;
                                            } else {
                                                c = c
                                                tax = tax
                                                service = service
                                            }
                                        }
                                       
                                            
                                            
                                            
                                      
                                        $('#total1').val(c);
                                        $('#totalTetap').val(c);
                                        $('#tvoucher').val(c);
                                        $('.servis').html(service);
                                        $('.tax').html(tax);
                                        $('.round').val(round);
                                        $('.servis1').val(service);
                                        $('.tax1').val(tax);


                                        var cash = parseInt($("#cash").val());
                                        var mandiri_kredit = parseInt($("#mandiri_kredit")
                                            .val());
                                        var mandiri_debit = parseInt($("#mandiri_debit").val());
                                        var bca_kredit = parseInt($("#bca_kredit").val());
                                        var bca_debit = parseInt($("#bca_debit").val());
                                        var total = parseInt($("#total1").val());
                                        var bayar = mandiri_kredit + mandiri_debit + cash +
                                            bca_kredit + bca_debit;
                                        // alert(mandiri_kredit);
                                        if (total <= bayar) {
                                            $('#btn_bayar').removeAttr('disabled');
                                        } else {
                                            $('#btn_bayar').attr('disabled', 'true');
                                        }


                                        Swal.fire({
                                            toast: true,
                                            position: 'top-end',
                                            showConfirmButton: false,
                                            timer: 3000,
                                            icon: 'success',
                                            title: 'Berhasil memasukkan kode voucher'
                                        });
                                    }

                                }

                            }

                        }
                    });

                }

            });
            $(document).on('click', '#btl_voucher', function(event) {
                var kode = $('.kd_voucher').val();
                var ttl1 = $('#total1').val();
                var ttl2 = $('#total2').val();
                
                var ttl_hrg2 = $('#ttl_hrg2').val();
                var view_dp = $('#view_dp').val();
                var view_discount = $('#view_discount').val();
                var gosen = $('#gosen').val();
                var service = $('.servis1').val();
                var service2 = $('.servis2').val();
                var tax = $('#tax').val();
                var tax2 = $('.tax2').val();
                var round2 = $('.round2').val();
                var sDiskon = $('.sDiskon').val();
                var ttl = ttl2 - view_dp + parseFloat(gosen);
                if (kode == '') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'error',
                        title: 'Masukkan kode voucher'
                    });
                } else {
                    // $('.kd_voucher').val('');
                    // $('#rupiah').val('');
                    // $('.tax1').val(tax2);
                    // $('.tax').html(tax2);
                    // $('.servis1').val(service2);
                    // $('.servis').html(service2);
                    // $('.sDiskon').val(round2);
                    // $('.round').val(round2);
                    // $('#total1').val(ttl);

                    reset()
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Berhasil Membatalkan voucher'
                    });
                }

            });

            

            $(document).on("change", "#data_dp", function() {
                var id_dp = $(this).val();
                // alert(id_dp);
                var val1 = $("#total2").val();
                var ttl1 = $("#total1").val();
                var gosen = $('#gosen').val();
                var rupiah = $('#rupiah').val();
                var tv = $('#tvoucher').val();
                var voucher = $('#rupiah').val();
                var vDiskon = $('.vDiskon').val();
                var totalTetap = $('#totalTetap').val();
             
                if (id_dp == 0) {
                    // var tb = 0
                    // if(rupiah != '') {
                    //     tb = tv;
                    // } else {
                    //     tb = val1 - rupiah + parseFloat(gosen);
                    // }
                    reset()
                        // $("#total1").val(tb);
                        // $("#view_dp").val(0);
                        // $("#id_dp").val(0);
                        // $("#kembalian1").val(0);
                    
                } else {
                    $.ajax({
                        url: "<?= route('get_dp') ?>?id_dp=" + id_dp,
                        method: "GET",
                        dataType: "json",
                        success: function(data) {
                         
                            
                            var kembali = 0
                            
                            $("#jumlah_dp").val(data.jumlah);
                            $("#kode_dp").val(data.kd_dp);
                            $("#id_dp").val(data.id_dp);
                            // if(rupiah != '' || vDiskon != '') {
                                
                            // } else {
                            //     var total_bayar = ttl1 - rupiah + parseFloat(gosen) - parseInt($("#jumlah_dp").val())
                            // }
                           
                            var total_bayar = totalTetap - parseInt($("#jumlah_dp").val())
                         
                            if(total_bayar < 0) {
                                kembali =- total_bayar
                                total_bayar = 0
                             
                            } else {
                                kembali = 0
                                total_bayar = total_bayar
                                
                            }
                        
                    
                            
                            // if(total_bayar < 0) {
                            //     total_bayar = 0
                            //     var kembali = parseInt($("#jumlah_dp").val()) - parseInt(total_bayar);
                            // } else if(parseInt($("#jumlah_dp").val()) > total_bayar) {
                            //     total_bayar = total_bayar
                            //     var kembali = parseInt($("#jumlah_dp").val()) - parseInt(val1);
                            //     if(kembali < 0 ) {
                            //         kembali = 0
                            //     } else {
                            //         kembali = kembali
                            //     }
                            // } else {
                            //     kembali = 0
                            // }
                          
                            $("#total1").val(total_bayar);
                            $("#kembalian1").val(kembali);
                            $("#view_dp").val($("#jumlah_dp").val());

                        }
                    });
                }
            });
            $(document).on('keyup', '#gosen', function() {
                var gosen = $(this).val();
                var ttl2 = $("#total2").val();
                var rupiah = $('#rupiah').val();
                var view_dp = $('#view_dp').val();
                if (gosen == '') {
                    var hasil = ttl2 - rupiah - view_dp;
                } else {
                    var hasil = ttl2 - rupiah - view_dp + parseFloat(gosen);
                }
                $("#total1").val(hasil);

            });



            $(document).on('keyup', '.pembayaran', function() {
                // var diskon = parseInt($("#diskon").val());
                var cash = parseInt($("#cash").val());
                var mandiri_kredit = parseInt($("#mandiri_kredit").val());
                var mandiri_debit = parseInt($("#mandiri_debit").val());
                var bca_kredit = parseInt($("#bca_kredit").val());
                var bca_debit = parseInt($("#bca_debit").val());
                var total = parseInt($("#total1").val());
                var bayar = mandiri_kredit + mandiri_debit + cash + bca_kredit + bca_debit;
                // alert(mandiri_kredit);
                if (total <= bayar) {
                    $('#btn_bayar').removeAttr('disabled');
                } else {
                    $('#btn_bayar').attr('disabled', 'true');
                }
            });

        });
    </script>


    <script>
        function selection() {
            var selected = document.getElementById("select1").value;
            if (selected == 0) {
                document.getElementById("input1").removeAttribute("hidden");
            } else {
                //elsewhere actions
            }
        }
    </script>
@endsection
