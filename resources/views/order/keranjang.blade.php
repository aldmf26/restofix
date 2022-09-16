@php
$ttl = 0;
$sub_total = 0;
foreach (Cart::content() as $c):
    $ttl += $c->qty;
    $sub_total += $c->qty * $c->price;
endforeach;
@endphp
<?php if($ttl == 0):?>

<div class="col-lg-12">
    <div class="cart-table">
        <div class="cart-table-warp">
            <center>
                <img width="150" src="{{ asset('assets') }}/img_menu/shopping-cart.png" alt=""><br><br>
                <h4>Keranjang Belanja Kosong</h4>
            </center>
            <br><br>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-success bg-gradient btn-block " disabled> SEND TO KITCHEN</button>
<?php else:?>
<input type="hidden" value="{{ $id_distri->id_distribusi }}">
<input type="hidden" value="{{ number_format($batas->rupiah, 0) }}">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table">

                @foreach ($cart as $c)
                    <tr>
                        <td>
                            <strong>{{ $c->name }}
                                <br>
                                {{-- * {{ $c->options->req }} --}}
                                @if (strpos($c->name, ':') !== false || strpos($c->name, 'set.') !== false || strpos($c->name, 'Set.') !== false)                
                                    @if ($c->options->req)
                                        * {{ $c->options->req }}
                                    @else           
                                        <input type="text" name="req2[]" value="{{ old('req2') }}" class="form-control">
                                        <input type="hidden" name="rowid[]" value="{{ $c->rowId }}" class="form-control">
                                    @endif
                                @else
                                    * {{ $c->options->req }}
                                @endif
                            </strong>
                        </td>
                        <td>
                            <strong>
                                {{ number_format($c->price, 0) }}
                            </strong>
                        </td>
                        <td align="center">
                            @php
                                
                                $limit = DB::table('tb_limit')
                                    ->select('tb_limit.jml_limit')
                                    ->join('tb_menu', 'tb_limit.id_menu', 'tb_menu.id_menu')
                                    ->where('tb_limit.id_menu', $c->options->id_menu)
                                    ->first();

                                $cekStok = DB::table('tb_resep')->where('id_menu', $c->options->id_menu)->get(); 
                               $stok = 1;
                                foreach($cekStok as $d) {
                                    $t = DB::selectOne("SELECT sum(a.debit_makanan - a.kredit_makanan) as ttl, b.nm_bahan, c.n FROM `tb_stok_makanan` as a
                                    LEFT JOIN tb_list_bahan as b on a.id_list_bahan = b.id_list_bahan
                                    LEFT JOIN tb_satuan as c on b.id_satuan = c.id
                                    WHERE a.id_lokasi = '$id_lokasi' AND b.id_list_bahan = '$d->id_list_bahan'
                                    GROUP BY a.id_list_bahan");
                                    // $stok = $t->ttl == 0 ? 0 : $c->qty * $d->qty - $t->ttl;
                                    if($t->ttl < $d->qty ) {
                                        $stok = 0;
                                        break;
                                    }
                                }
                            @endphp
                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                <a class="min_cart mr-3 btn-num-product-down" id_menu="{{ $c->options->id_menu }}" id="{{ $c->rowId }}" qty="{{ $c->qty }}">                               
                                    <i class="fa fa-minus"></i></a>
                                <input type="text" value="{{ $c->qty }}" class="text-center" style="width: 35px;"
                                    hidden>
                                    <input disabled class="mtext-104 cl3 txt-center num-product" style="margin-right: 15px; -moz-appearance: textfield; text-align: center" type="text" name="num-product1" value="{{ $c->qty }}">
                                @if ($limit)
                                    @if ($c->qty == $limit->jml_limit)
                                    @else
                                    <a class="plus_cart btn-num-product-up" id="{{ $c->rowId }}" qty="{{ $c->qty }}"
                                        id_menu="{{ $c->options->id_menu }}"><i class="fa fa-plus"></i></a>
                                    @endif
                                @elseif($stok == 0)
                                @else
                                <a class="plus_cart btn-num-product-up" id="{{ $c->rowId }}" qty="{{ $c->qty }}"
                                    id_menu="{{ $c->options->id_menu }}"><i class="fa fa-plus"></i></a>
                                @endif
                                {{-- <?php if($limit){ ?>
                                <?php if($c->qty == $limit->jml_limit){ ?>
                                    <?php }else { ?>
                        
                                <a class="plus_cart btn-num-product-up" id="{{ $c->rowId }}" qty="{{ $c->qty }}"
                                    id_menu="{{ $c->id }}"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                                <?php }else if($stok == 0) { ?> <?php } ?> <?php else{ ?>
                                <a class="plus_cart btn-num-product-up" id="{{ $c->rowId }}" qty="{{ $c->qty }}"
                                    id_menu="{{ $c->id }}"><i class="fa fa-plus"></i></a>
                                <?php } ?> --}}
                                {{-- <a href="javascript:void(0)" id="{{ $c->rowId }}" nama="{{ $c->name }}" id_set="{{ $c->options->id_menu }}"
                                    class="text-danger ml-2 btn-num-product-up delete_cart">X</a>   --}}
                            </div>

                        </td>
                        {{-- <td>
                            <input type="text" class="form-control">
                        </td> --}}
                        <td>
                            {{-- @if (strpos($c->name, ':') !== false)
                                
                            <a href="javascript:void(0)" id="{{ $c->rowId }}" nama="{{ $c->name }}" id_set="{{ $c->options->id_menu }}"
                                class="btn btn-danger btn-sm delete_cart"><i class="fa fa-trash"></i></a>
                            @else
                            <a href="javascript:void(0)" id="{{ $c->rowId }}" nama="{{ $c->name }}" id_set="{{ $c->options->id_menu }}"
                                class="btn btn-danger btn-sm delete_cart">hapus lain set</a>
                            @endif --}}
                            <a href="javascript:void(0)" id="{{ $c->rowId }}" nama="{{ $c->name }}" id_set="{{ $c->options->id_menu }}"
                                class="btn btn-danger btn-sm delete_cart"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th style="font-size: 14px;" class="text-left">SUBTOTAL</th>
                    <th style="font-size: 14px;" colspan="3" class="text-right">Rp.
                        {{ number_format($sub_total, 0) }}
                    </th>
                </tr>
                <tr>
                    <?php if ($id_distri->service == 'Y'):?>
                    <th style="font-size: 14px;" class="text-left">Service Charge</th>
                    @php
                        $service = $sub_total * 0.07;
                    @endphp
                    <th style="font-size: 14px;" colspan="3" class="text-right">Rp.
                        {{ number_format($service, 0) }}</th>
                    <?php else: ?>
                    @php
                        $service = 0;
                    @endphp
                    <?php endif ?>
                </tr>
                <tr>
                    <?php if ($id_distri->ongkir == 'Y'):?>
                    <?php if($sub_total < $batas->rupiah): ?>
                    <th style="font-size: 14px;" class="text-left">ONGKIR</th>
                    <th style="font-size: 14px;" colspan="3" class="text-right">
                        Rp.{{ number_format($onk->rupiah, 0) }} </th>
                    @php
                        $ongkir = $onk->rupiah;
                    @endphp
                    <?php else: ?>
                    <th style="font-size: 14px;" class="text-left">ONGKIR</th>
                    <th style="font-size: 14px;" colspan="3" class="text-right">
                        Free </th>
                    @php
                        $ongkir = 0;
                    @endphp
                    <?php endif ?>
                    <?php else: ?>
                    @php
                        $ongkir = 0;
                    @endphp
                    <?php endif ?>
                </tr>
                <tr>
                    <?php if ($id_distri->tax == 'Y'):?>
                    <th style="font-size: 14px;" class="text-left">Tax</th>
                    @php
                        $tax = ($sub_total + $service + $ongkir) * 0.1;
                    @endphp
                    <th style="font-size: 14px;" colspan="3" class="text-right">Rp.
                        {{ number_format($tax, 0) }}</th>
                    <?php else: ?>
                    @php
                        $tax = 0;
                    @endphp
                    <?php endif ?>
                </tr>
                <tr>
                    <th style="font-size: 16px;" class="text-left">TOTAL</th>
                    <th style="font-size: 16px;" colspan="3" class="text-right">Rp.
                        {{ number_format($sub_total + $service + $tax + $ongkir) }}</th>
                </tr>


                {{-- <tr>
                    {{ Cart::subtotal() }}
                </tr> --}}
            </table>
            <button type="submit" class="btn btn-success bg-gradient btn-block">SEND TO KITCHEN</button>
        </div>
    </div>
</div>
<?php endif?>
