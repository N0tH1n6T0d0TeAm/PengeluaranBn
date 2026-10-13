
<?php $__env->startSection('content'); ?>
<style>
    .button {
        transition: all 0.3s ease-out;
    }

    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.8);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
        z-index: 99999;
        overflow-y: auto;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 2rem 1rem;
    }

    .overlay:target {
        visibility: visible;
        opacity: 1;
    }

    .modal-wrapper {
        width: 100%;
        max-width: 700px;
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 100000;
    }

    .close {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        font-size: 2.5rem;
        font-weight: bold;
        color: #64748b;
        text-decoration: none;
        transition: color 0.2s;
        line-height: 1;
        cursor: pointer;
    }

    .close:hover {
        color: #7c3aed;
    }

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
</style>

<?php
      function tgl_indo($tanggal){
      $bulan=array(
        1=>'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desmber'
);

$pecahkan=explode('-',$tanggal);

return $pecahkan[2].' '.$bulan[(int)$pecahkan[1]].' '.$pecahkan[0];
}
    ?>

<div class="content_wrapper py-4">
    <!--middle content wrapper-->
    <div class="middle_content_wrapper">
        <!-- counter_area -->
        <section class="counter_area">
            <div class="card">
                <div class="card-header">
                    <div class="row g-3 align-items-center">
                        <div class="col-12 col-lg-6">
                            <h2 class="mb-0 fw-bold">Riwayat Pengeluaran PO</h2>
                        </div>
                        <div class="col-12 col-lg-6">
                            <form class="form-inline d-flex flex-wrap gap-2 justify-content-lg-end" action="/riwayat_po" method="GET">

                                <?php echo csrf_field(); ?>
                                <div class="form-group mb-0">
                                    <label for="datefrom" class="me-2 fw-semibold">From</label>
                                    <input type="date" id="datefrom" class="form-control" name="datefrom">
                                </div>
                                <div class="form-group mx-sm-2 mb-0">
                                    <label for="dateto" class="me-2 fw-semibold">To</label>
                                    <input type="date" id="dateto" class="form-control" name="dateto">
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive-custom">
                            <table class="table table-hover">
                                <thead style="background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%); color: white;">
                                    <tr>
                                        <th scope="col" class="ps-3">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Toko</th>
                                        <th scope="col">Metode Pembayaran</th>
                                        <th scope="col">Transaksi Jumlah</th>
                                        <th scope="col">Pembayaran</th>
                                        <th scope="col">Kembalian</th>
                                        <th scope="col">No Nota</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; ?>
                                    <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="ps-3 fw-semibold"><?php echo e($no++); ?></td>
                                        <td><?php echo e(tgl_indo($trans->tanggal)); ?></td>
                                        <td><?php echo e($trans->nama_toko); ?></td>
                                        <td>
                                            <span class="badge bg-info"><?php echo e($trans->metode_pembayaran); ?></span>
                                        </td>
                                        <td class="fw-semibold text-success">Rp <?php echo e(number_format($trans->transaksi_jumlah)); ?></td>
                                        <td class="fw-semibold text-primary">Rp <?php echo e(number_format($trans->pembayaran)); ?></td>
                                        <td class="fw-semibold text-warning">
                                            <?php if($trans->kembalian > 0): ?>
                                                +Rp <?php echo e(number_format($trans->kembalian)); ?>

                                            <?php elseif($trans->kembalian < 0): ?>
                                                -Rp <?php echo e(number_format(abs($trans->kembalian))); ?>

                                            <?php else: ?>
                                                Rp 0
                                            <?php endif; ?>
                                        </td>
                                        <td class="fw-medium"><?php echo e($trans->no_nota); ?></td>
                                        <td class="text-center">
                                            <a href="/detailPo/<?php echo e($trans->id); ?> #detail" class="btn btn-primary btn-sm detail me-1">
                                                <i class="fas fa-eye me-1"></i>Detail
                                            </a>
                                            <a href="#ubah" class="btn btn-warning btn-sm me-1 ubah" data-id="<?php echo e($trans->id); ?>">
                                                <i class="fas fa-edit me-1"></i>Ubah
                                            </a>
                                            <a href="<?php echo e(url('hapus_riwayat_po/'.$trans->id)); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus riwayat ini?')">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php if(isset($detailorder)): ?>

<div class="overlay" id="detail">
    <div class="modal-wrapper">
        <a href="#" class="close">&times;</a>
        <h2 class="fw-bold mb-4 text-center text-dark">Details</h2>
        <div class="table-responsive-custom">
            <table class="table table-hover">
                <thead class="bg-light">
                    <tr>
                        <th>Nama Item</th>
                        <th>Harga</th>
                        <th>Kwantitas</th>
                        <th>Satuan</th>
                        <th>Diskon</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $detailorder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key->menu->nama_menu); ?></td>
                        <td>Rp <?php echo e(number_format($key->harga)); ?></td>
                        <td><?php echo e($key->kwantitas); ?></td>
                        <td><?php echo e($key->satuan); ?></td>
                        <td>Rp <?php echo e(number_format($key->diskon)); ?></td>
                        <td class="fw-semibold text-success">Rp <?php echo e(number_format($key->total)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>


<div class="overlay" id="ubah">
    <div class="modal-wrapper" style="max-width: 500px;">
        <a href="#" class="close">&times;</a>
        <h2 class="fw-bold mb-4 text-center text-dark">Ubah Riwayat PO</h2>
        <form action="/update_p" method="POST">
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>
            <input type="hidden" name="t_cafe" value="" id="t_cafe" />

            <div class="mb-3">
                <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                <input type="date" name="tanggal" value="" style="width: 100%" id="tanggal" class="form-control">
            </div>
            <div class="mb-3">
                <label for="nama_toko" class="form-label fw-semibold">Nama Toko</label>
                <input type="text" name="nama_toko" value="" style="width: 100%" id="nama_toko" class="form-control">
            </div>
            <div class="mb-3">
                <label for="metode" class="form-label fw-semibold">Metode Pembayaran</label>
                <select name="metode" style="width: 100%" id="metode" class="form-control">
                    <option>Cash</option>
                    <option>Debit</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label fw-semibold">Transaksi Jumlah</label>
                <input type="text" name="jumlah" value="" style="width: 100%" id="jumlah" class="form-control">
            </div>
            <div class="mb-3">
                <label for="bayar" class="form-label fw-semibold">Pembayaran</label>
                <input type="text" name="bayar" value="" style="width: 100%" id="bayar" class="form-control">
            </div>
            <div class="mb-4">
                <label for="kembalian" class="form-label fw-semibold">Kembalian</label>
                <input type="text" name="kembalian" value="" style="width: 100%" id="kembalian" class="form-control">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i>Ubah
                </button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    $(document).on('click', '.ubah', function() {

        var pass1 = "lol123";
        var pass2 = "admin7788"
        var pass = prompt("Masukan Password Sebelum Mengubah Data");

        if(pass == pass1 || pass == pass2){
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "/edit-riwayat-po/"+id,
                success: function (response) {
                    //console.log(response);
                    $('#tanggal').val(response.liat.tanggal);
                    $('#nama_toko').val(response.liat.nama_toko);
                    $('#metode').val(response.liat.metode_pembayaran);
                    $('#jumlah').val(response.liat.transaksi_jumlah);
                    $('#bayar').val(response.liat.pembayaran);
                    $('#kembalian').val(response.liat.kembalian);
                    $('#t_cafe').val(id);
                }
            });
        }else{
            alert('Password Anda Masukan Salah');
            window.location.assign('riwayat_po')
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Administrator\Downloads\PengeluaranBn-main\PengeluaranBn-main\resources\views/riwayat_po.blade.php ENDPATH**/ ?>