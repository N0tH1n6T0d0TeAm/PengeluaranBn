
@extends('layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
    .table-responsive-custom {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .form-control {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.2s;
    }
    .form-control:focus {
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        border-color: #10b981;
    }
    .btn {
        border-radius: 10px;
    }
    .card {
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border-radius: 16px;
    }
    .total-display {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 1rem;
        border-radius: 12px;
    }
</style>
<div class="content_wrapper py-4">
    <!--middle content wrapper-->
    <div class="middle_content_wrapper">
        <!-- counter_area -->
        <section class="counter_area">
            <div class="card">
                <div class="card-header">
                    <h4 class="fw-bold mb-0">Transaksi Cafe</h4>
                </div>
                <div class="card-body">
                    <div class="row g-4"> 
                        <div class="col-12 col-lg-8">
                            <form action="/cafes" method="post" id="transaksiForm">
                                @csrf
                                <div class="card-body p-0">
                                    <div class="table-responsive-custom">
                                        <table class="table table-hover">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th class="ps-3">No</th>
                                                    <th>Nama Barang</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah</th>
                                                    <th>Satuan</th>
                                                    <th>Diskon</th>
                                                    <th>Total</th>
                                                    <th class="text-center">
                                                        <a href="#addOrder" class="btn btn-success rounded-circle add_order" id="add_order" title="Tambah Item">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="addMoreOrder">
                                                <tr>
                                                    <td class="ps-3 align-middle">1</td>
                                                    <td>
                                                        <select class="form-control id_menu" id="id_menu" name="id_menu[]">
                                                            <option value="">Select Item</option>
                                                            @foreach($kafe as $data)
                                                            <option value="{{$data->id_cafe}}">{{$data->nama_barang}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="harga[]" id="harga" class="form-control harga" placeholder="0">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="kwantitas[]" id="kwantitas" class="form-control kwantitas" placeholder="0">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="satuan[]" id="satuan" class="form-control" placeholder="pcs">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="diskon[]" id="diskon" class="form-control diskon" placeholder="0">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="total[]" id="total" class="form-control totalAmount" placeholder="0" readonly style="background-color: #f9fafb;">
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="btn btn-danger rounded-circle delete" title="Hapus">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="total-display mb-4">
                                <h4 class="mb-0 fw-bold">Total <span class="total" style="font-size: 1.5rem;">0.00</span></h4>
                            </div>
                            <input type="hidden" name="transaksi_jumlah[]" class="total-input">
                            <div class="card-body p-0">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="customer_name" class="fw-semibold">Nama Toko</label>
                                            <input type="text" class="form-control" id="customer_name" name="nama_toko" placeholder="Masukkan nama toko">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal" class="fw-semibold">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="fw-bold mb-3">Metode Pembayaran</h6>
                                    <div class="row g-2 mb-4">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="bayar" id="cashRadio" value="Cash" checked>
                                                <label class="form-check-label" for="cashRadio">
                                                    <i class="fas fa-money-bill-wave me-1"></i>Cash
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="bayar" id="debitRadio" value="Debit">
                                                <label class="form-check-label" for="debitRadio">
                                                    <i class="fas fa-credit-card me-1"></i>Debit
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="payment" class="fw-semibold">Pembayaran</label>
                                        <input type="number" class="form-control nominal" name="pembayaran" id="nominal" placeholder="Masukkan jumlah pembayaran">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="returning_charge" class="fw-semibold">Kembalian</label>
                                        <input type="number" class="form-control bg-light text-dark kembalian" name="kembalian" id="kembalian" readonly placeholder="0">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 btn-lg">
                                        <i class="fas fa-check-circle me-2"></i>Submit Transaksi
                                    </button>
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
    e.preventDefault();
 
 var produk = $(".id_menu:first").html();
 var numberofrow = ($('.addMoreOrder tr').length - 0) + 1;
 var tr = '<tr><td class="align-middle ps-3">' + numberofrow + '</td>' +
     '<td><select class="form-control id_menu" name="id_menu[]" id="id_menu">' + produk + '</select></td>' +
     '<td> <input type="number" name="harga[]" class="form-control harga" placeholder="0"></td>' +
     '<td> <input type="number" name="kwantitas[]"  class="form-control kwantitas" placeholder="0"></td>' +
     '<td> <input type="text" name="satuan[]" class="form-control satuan" placeholder="pcs"></td>' +
     '<td> <input type="number" name="diskon[]" class="form-control diskon" placeholder="0"></td>' +
     '<td> <input type="number"  name="total[]"  class="form-control totalAmount" placeholder="0" readonly style="background-color: #f9fafb;"></td>' +
     '<td class="text-center"><a href="#" class="btn btn-sm btn-danger delete rounded-circle"><i class="fa fa-times"></i></a></td></tr>'; 
     $('.addMoreOrder').append(tr);
 });

$('.addMoreOrder').delegate('.delete', 'click', function(e){
    e.preventDefault();
    $(this).closest('tr').remove();
    // Update nomor urut
    $('.addMoreOrder tr').each(function(index) {
        $(this).find('td:first').text(index + 1);
    });
    TotalAmount();
});

function TotalAmount(){
    var total = 0;
    $('.totalAmount').each(function(i, e){
        var amount = parseFloat($(this).val()) || 0;
        total += amount;
    });

    $('.total').html(total.toLocaleString('id-ID'));
    $('.total-input').val(total);
}

$('.addMoreOrder').delegate('.id_menu','change', function(){
    var tr = $(this).closest('tr');
    var harga = tr.find('.harga').val() || 0;
    var qty = parseFloat(tr.find('.kwantitas').val()) || 0;
    var diskon = parseFloat(tr.find('.diskon').val()) || 0;
    var harga_val = parseFloat(harga) || 0;
    var total_amount = (qty * harga_val) - diskon;
    tr.find('.totalAmount').val(total_amount);
    TotalAmount();
});

$('.addMoreOrder').delegate('.harga, .kwantitas, .diskon', 'keyup change', function(){
    var tr = $(this).closest('tr');
    var qty = parseFloat(tr.find('.kwantitas').val()) || 0;
    var diskon = parseFloat(tr.find('.diskon').val()) || 0;
    var harga = parseFloat(tr.find('.harga').val()) || 0;
    var total_amount = (qty * harga) - diskon;
    tr.find('.totalAmount').val(total_amount);
    TotalAmount();
})

$('#nominal').keyup(function() {
    var totalText = $('.total').html().replace(/[^0-9]/g, '');
    var total = parseFloat(totalText) || 0;
    var paid_amount = parseFloat($(this).val()) || 0;
    var tot = paid_amount - total;
    $('#kembalian').val(tot >= 0 ? tot : 0);
})
</script>
@endsection
