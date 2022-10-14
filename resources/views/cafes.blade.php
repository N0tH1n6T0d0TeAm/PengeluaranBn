@extends('layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="content_wrapper">
    <!--middle content wrapper-->
    <div class="middle_content_wrapper">
        <!-- counter_area -->
        <section class="counter_area">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="row"> 
                        <div class="col-lg-8">
                            <form action="/cafes" method="post">
                                @csrf
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Satuan</th>
                                                <th scope="col">Diskon</th>
                                                <th scope="col">Total</th>
                                                <th><a href="#addOrder" class="btn btn-sm btn-success  rounded-circle add_order" id="add_order"><i class="fa fa-plus-circle"></i></a></th>

                                            </tr>
                                        </thead>
                                        <tbody class="addMoreOrder">
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <select class="form-control id_menu" id="id_menu" name="id_menu[]">
                                                        <option>Select Item</option>
                                                        @foreach($kafe as $data)
                                                        <option value="{{$data->id_cafe}}">{{$data->nama_barang}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="harga[]" id="harga" class="form-control harga">
                                                </td>

                                                <td>
                                                    <input type="number" name="kwantitas[]" id="kwantitas" class="form-control kwantitas">
                                                </td>
                                                <td>
                                                    <input type="text" name="satuan[]" id="satuan" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="number" name="diskon[]" id="diskon" class="form-control diskon">
                                                </td>
                                                <td>
                                                    <input type="number" name="total[]" id="total" class="form-control totalAmount">

                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-danger rounded-circle"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card-header">
                                <h4>Total <b class="total">0.00</b></h4>
                            </div>
                            <input type="hidden" name="transaksi_jumlah[]" class="total-input">
                            <input type="hidden" name="" class="total-input">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="customer_name">Nama Toko</label>
                                            <input type="text" class="form-control" id="customer_name" name="nama_toko">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="customer_name">Tanggal</label>
                                            <input type="date" class="form-control" id="customer_name" name="tanggal">
                                        </div>
                                    </div>
                                </div>
                                <h6>Metode Pembayaran</h3>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="bayar" id="exampleRadios1" value="Cash" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Cash
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="bayar" id="exampleRadios1" value="Debit" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Debit
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="payment">Pembayaran</label>
                                        <input type="number" class="form-control nominal" name="pembayaran" id="nominal">
                                    </div>
                                    <div class="form-group">
                                        <label for="returning_charge">Kembalian</label>
                                        <input type="number" class="form-control  bg-light text-dark kembalian" name="kembalian" id="kembalian" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>

 $('.add_order').on('click', function(e) {
 
 var produk = $(".id_menu").html();
 var numberofrow = ($('.addMoreOrder tr').length - 0) + 1;
 var tr = '<tr><td class="no">' + numberofrow + '</td>' +
     '<td><select class="form-control id_menu" name="id_menu[]" id="id_menu">' + produk + '</select></td>' +
     '<td> <input type="number" name="harga[]" class="form-control harga" id="harga_t"></td>' +
     '<td> <input type="number" name="kwantitas[]"  class="form-control kwantitas" id="kwantitas_t"></td>' +
     '<td> <input type="text" name="satuan[]" class="form-control satuan" id="satuan_t"></td>' +
     '<td> <input type="number" name="diskon[]" class="form-control diskon" id="diskon_t"></td>' +
     '<td> <input type="number"  name="total[]"  class="form-control totalAmount" id="total_t"></td>' +
     '<td><a href="#" class="btn btn-sm btn-danger delete rounded-circle"><i class="fa fa-times"></i></a></td>'; 
     $('.addMoreOrder').append(tr);
 });

$('.addMoreOrder').delegate('.delete', 'click', function(){
    $(this).parent().parent().remove();
});

function TotalAmount(){
    var total = 0;
    $('.totalAmount').each(function(i, e){
        var amount = $(this).val() - 0;
        total += amount;
    });

    $('.total').html(total);
}

$('.addMoreOrder').delegate('.id_menu','change', function(){
    var tr = $(this).parent().parent();
    var harga = tr.find('.id_menu option:selected');
    tr.find('.harga').val(harga);
    var qty = tr.find('.kwantitas').val() - 0;
    var diskon = tr.find('.diskon').val() - 0;
    var harga = tr.find('.harga').val() - 0;
    var total_amount = (qty * harga) - (diskon);
    tr.find('.totalAmount').val(total_amount);
    TotalAmount();
});

$('.addMoreOrder').delegate('.kwantitas, .diskon', 'keyup', function(){
    var tr = $(this).parent().parent();
    var qty = tr.find('.kwantitas').val() - 0;
    var diskon = tr.find('.diskon').val() - 0;
    var harga = tr.find('.harga').val() - 0;
    var total_amount = (qty * harga) - (diskon);
    tr.find('.totalAmount').val(total_amount);
    TotalAmount();
})

$('#nominal').keyup(function() {
    // alert(1);
    var total = $('.total').html();
    var paid_amount = $(this).val();
    var tot = paid_amount - total;
    $('#kembalian').val(tot);
})
</script>
@endsection
