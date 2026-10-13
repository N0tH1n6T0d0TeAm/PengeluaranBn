

<?php $__env->startSection('content'); ?>
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
        box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
        border-color: #8b5cf6;
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
        background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
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
                    <h4 class="fw-bold mb-0">Transaksi Rempah</h4>
                </div>
                <div class="card-body">
                    <div class="row g-4"> 
                        <div class="col-12 col-lg-8">
                            <form action="/transaksi" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="card-body p-0">
                                    <div class="table-responsive-custom">
                                        <table class="table table-hover">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th class="ps-3">No</th>
                                                    <th scope="col">Nama Rempah</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Kwantitas</th>
                                                    <th scope="col">Satuan</th>
                                                    <th scope="col">Diskon</th>
                                                    <th scope="col">Total</th>
                                                    <th class="text-center">
                                                        <a href="#addOrder" class="btn btn-success rounded-circle add_order" id="add_order" title="Tambah Item">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="addMoreOrder">
                                                <tr>
                                                    <td class="no ps-3 align-middle">1</td>
                                                    <td>
                                                        <select class="form-control id_menu" id="id_menu" name="id_menu[]">
                                                            <option>Select Item</option>
                                                            <?php $__currentLoopData = $rempah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($data->id); ?>"><?php echo e($data->nama_menu); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="harga[]" id="harga" class="form-control harga" placeholder="0">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="kwantitas[]" id="kwantitas" class="form-control kwantitas" placeholder="0">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="satuan[]" id="satuan" class="form-control satuan" placeholder="pcs">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="diskon[]" id="diskon" class="form-control diskon" placeholder="0">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="total[]" id="total" class="form-control totalAmount" placeholder="0" readonly style="background-color: #f9fafb;">
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="btn btn-sm btn-danger rounded-circle delete" title="Hapus">
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
                            <input type="hidden" name="" class="total-input">
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
                                                <input class="form-check-input" type="radio" name="bayar" id="exampleRadios1" value="Cash" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Cash
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="bayar" id="exampleRadios2" value="Debit">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Debit
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
                                        <i class="fas fa-check-circle me-2"></i>Submit
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

 var produk = $(".id_menu").html();
 var numberofrow = ($('.addMoreOrder tr').length - 0) + 1;
 var tr = '<tr><td class="no ps-3 align-middle">' + numberofrow + '</td>' +
     '<td><select class="form-control id_menu" name="id_menu[]" id="id_menu">' + produk + '</select></td>' +
     '<td> <input type="number" name="harga[]" class="form-control harga" id="harga" placeholder="0"></td>' +
     '<td> <input type="number" name="kwantitas[]"  class="form-control kwantitas" id="kwantitas_t" placeholder="0"></td>' +
     '<td> <input type="text" name="satuan[]" class="form-control satuan" id="satuan" placeholder="pcs"></td>' +
     '<td> <input type="number" name="diskon[]" class="form-control diskon" id="diskon" placeholder="0"></td>' +
     '<td> <input type="number"  name="total[]"  class="form-control totalAmount" id="totalAmount" placeholder="0" readonly style="background-color: #f9fafb;"></td>' +
     '<td class="text-center"><a href="#" class="btn btn-sm btn-danger delete rounded-circle"><i class="fa fa-times"></i></a></td>'; 
     $('.addMoreOrder').append(tr);
 });

 $('.addMoreOrder').delegate('.delete', 'click', function(e){
    e.preventDefault();
    $(this).parent().parent().remove();
    // Update nomor urut
    $('.addMoreOrder tr').each(function(index) {
        $(this).find('.no').text(index + 1);
    });
    TotalAmount();
});

function TotalAmount(){
    var total = 0;
    $('.totalAmount').each(function(i, e){
        var amount = $(this).val() - 0;
        total += amount;
    });

    $('.total').html(total);
    $('.total-input').val(total);
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Administrator\Downloads\PengeluaranBn-main\PengeluaranBn-main\resources\views/transaksi.blade.php ENDPATH**/ ?>