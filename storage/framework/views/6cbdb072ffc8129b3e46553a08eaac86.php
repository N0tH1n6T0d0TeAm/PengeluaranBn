
 
<?php $__env->startSection('content'); ?> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<style>
    /* --- Styling Modern & Responsif --- */
    .button {
        transition: all 0.3s ease-out;
    }
    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.8);
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
        max-width: 500px;
        background: white;
        border-radius: 16px;
        padding: 2.5rem 2rem;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        position: relative;
        z-index: 100000;
    }
    .close-modal {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        font-size: 2.5rem;
        font-weight: bold;
        color: #64748b;
        text-decoration: none;
        transition: color 0.2s;
        line-height: 1;
    }
    .close-modal:hover {
        color: #7449f5;
        text-decoration: none;
    }
    .form-input {
        width: 100%;
        padding: 0.875rem 1.25rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1.05rem;
        transition: all 0.2s;
    }
    .form-input:focus {
        outline: none;
        border-color: #7449f5;
        box-shadow: 0 0 0 5px rgba(116, 73, 245, 0.12);
    }
    .table-responsive-custom {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
</style>

<!-- Container Utama -->
<div class="container py-4">
    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h3 class="fw-bold text-dark mb-0">
            <i class="fas fa-coffee me-2"></i>Daftar Bahan Cafe
        </h3>
        <a href="#divOne" class="btn btn-success btn-lg shadow-lg">
            <i class="fas fa-plus me-2"></i>Tambah Bahan
        </a>
    </div>

    <!-- Tabel Responsive -->
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive-custom">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-gradient" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                        <tr>
                            <th class="ps-4 py-3">No</th>
                            <th class="py-3">Nama Bahan</th>
                            <th class="pe-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        <?php $__currentLoopData = $lihat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tampil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="ps-4 fw-semibold"><?php echo e($no++); ?></td>
                            <td class="fw-medium"><?php echo e($tampil->nama_barang); ?></td>
                            <td class="pe-4 text-center">
                                <a href="#editModal" class="btn btn-info btn-sm me-1 editbtn" data-id="<?php echo e($tampil->id_cafe); ?>">
                                    <i class="fas fa-edit me-1"></i>Ubah
                                </a>
                                <a href="<?php echo e(url('delete-cafe/'.$tampil->id_cafe)); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus bahan ini?')">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(count($lihat) == 0): ?>
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                Belum ada bahan yang ditambahkan
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="overlay" id="divOne">
    <div class="modal-wrapper">
        <a href="#" class="close-modal">&times;</a>
        <h2 class="fw-bold mb-4 text-center text-dark">
            <i class="fas fa-plus-circle me-2"></i>Tambah Bahan
        </h2>
        <div class="content">
            <form action="/daftar_cafe" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="form-label fw-semibold text-dark mb-2">Nama Bahan</label>
                    <input type="text" class="form-input" name="nama_barang" placeholder="Masukkan nama bahan" required autofocus>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save me-2"></i>Tambah Bahan
                    </button>
                    <a href="#" class="btn btn-outline-secondary btn-lg">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="overlay" id="editModal">
    <div class="modal-wrapper">
        <a href="#" class="close-modal">&times;</a>
        <h2 class="fw-bold mb-4 text-center text-dark">
            <i class="fas fa-edit me-2"></i>Edit Data
        </h2>
        <div class="content">
            <form action="/update-menu-cafe" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="bar_id" id="bar_id" value="" />
                <div class="mb-4">
                    <label class="form-label fw-semibold text-dark mb-2">Nama Bahan</label>
                    <input type="text" class="form-input" name="nama_barang" id="nama_barang" placeholder="Masukkan nama bahan" required autofocus>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-check me-2"></i>Simpan Perubahan
                    </button>
                    <a href="#" class="btn btn-outline-secondary btn-lg">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        $(document).on('click', '.editbtn', function(e) {
            e.preventDefault();
            
            // Ganti menjadi data-id!
            var stud_id = $(this).data('id');
            
            var pass1 = "lol123";
            var pass2 = "admin7788";
            var pass = prompt('Masukan Password Sebelum Mengubah Data');

            console.log('=== Debug Info ===');
            console.log('Tombol edit diklik!');
            console.log('ID dari button:', stud_id);

            if(pass == pass1 || pass == pass2) {
                console.log('Password benar! ID:', stud_id);
                
                window.location.href = '#editModal';
                
                $.ajax({
                    type: "GET",
                    url: "/edit-cafe/"+stud_id,
                    dataType: "json",
                    success: function(response) {
                        console.log('Response dari server:', response);
                        
                        $('#nama_barang').val('');
                        $('#bar_id').val('');
                        
                        if(response.tampil) {
                            $('#nama_barang').val(response.tampil.nama_barang);
                            if(response.tampil.jumlah) $('#jumlah').val(response.tampil.jumlah);
                            $('#bar_id').val(response.tampil.id);
                            console.log('✅ Berhasil mengisi form dari response.tampil!');
                        } else if(response.data) {
                            $('#nama_barang').val(response.data.nama_barang);
                            if(response.data.jumlah) $('#jumlah').val(response.data.jumlah);
                            $('#bar_id').val(response.data.id);
                            console.log('✅ Berhasil mengisi form dari response.data!');
                        } else {
                            $('#nama_barang').val(response.nama_barang);
                            if(response.jumlah) $('#jumlah').val(response.jumlah);
                            $('#bar_id').val(response.id);
                            console.log('✅ Berhasil mengisi form dari response langsung!');
                        }
                        
                        $('#bar_id').val(stud_id);
                        $('#nama_barang').focus();
                    },
                    error: function(xhr, status, error) {
                        console.error('❌ AJAX Error:', error);
                        console.error('Response Text:', xhr.responseText);
                        alert('Terjadi kesalahan saat mengambil data! Silakan coba lagi.');
                    }
                });
            } else {
                alert('❌ Password Anda Masukan Salah!');
                window.location.assign("/daftar_cafe");
            } 
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Administrator\Downloads\PengeluaranBn-main\PengeluaranBn-main\resources\views/daftar_cafe.blade.php ENDPATH**/ ?>