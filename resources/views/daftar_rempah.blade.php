@extends('layout') 
@section('content') 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<style>
    /* --- Styling Modern --- */
    .button {
        transition: all 0.3s ease-out;
    }
    /* Tambahkan di bagian <style> */
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
    z-index: 99999; /* Naikkan z-index agar paling atas */
    overflow-y: auto;
    display: flex; /* Pakai flex untuk center secara vertikal */
    justify-content: center;
    align-items: flex-start; /* Mulai dari atas untuk mobile */
    padding: 2rem 1rem;
}
.overlay:target {
    visibility: visible;
    opacity: 1;
}
/* Styling Modal Responsif */
.modal-wrapper {
    width: 100%;
    max-width: 500px;
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    position: relative;
    z-index: 100000;
}
    .close-modal {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        font-size: 2rem;
        font-weight: bold;
        color: #64748b;
        text-decoration: none;
        transition: color 0.2s;
    }
    .close-modal:hover {
        color: #7449f5;
    }
    /* Styling Form Input */
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.2s;
    }
    .form-input:focus {
        outline: none;
        border-color: #7449f5;
        box-shadow: 0 0 0 4px rgba(116, 73, 245, 0.1);
    }
    /* Styling Table Responsive */
    .table-responsive-custom {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
</style>

<!-- Container Utama -->
<div class="container py-4">
    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">
            <i class="fas fa-list me-2"></i>Daftar Item PO
        </h3>
        <a href="#divOne" class="btn btn-success btn-lg shadow-lg">
            <i class="fas fa-plus me-2"></i>Tambah Item
        </a>
    </div>

    <!-- Tabel Responsive -->
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive-custom">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-gradient" style="background: #7449f5; color: white;">
                        <tr>
                            <th class="ps-4 py-3">No</th>
                            <th class="py-3">Nama Item</th>
                            <th class="pe-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach($lihat as $tampil)
                        <tr>
                            <td class="ps-4 fw-semibold">{{$no++}}</td>
                            <td class="fw-medium">{{$tampil->nama_menu}}</td>
                            <td class="pe-4 text-center">
                               <a href="#editModal" 
                                    class="btn btn-info btn-sm me-1 editbtn" 
                                    data-id="{{$tampil->id}}">
                                        <i class="fas fa-edit me-1"></i>Ubah
                                    </a>
                                <a href="{{url('delete/'.$tampil->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus item ini?')">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @if(count($lihat) == 0)
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                Belum ada item
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Item --}}
<div class="overlay" id="divOne">
    <div class="modal-wrapper">
        <a href="#" class="close-modal">&times;</a>
        <h2 class="fw-bold mb-4 text-center text-dark">
            <i class="fas fa-plus-circle me-2"></i>Tambah Item
        </h2>
        <div class="content">
            <form action="/rempah" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-semibold text-dark">Nama Item</label>
                    <input type="text" class="form-input" name="nama_menu" placeholder="Masukkan nama item" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save me-2"></i>Tambah Item
                    </button>
                    <a href="#" class="btn btn-outline-secondary btn-lg">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Item --}}
<div class="overlay" id="editModal">
    <div class="modal-wrapper">
        <a href="#" class="close-modal">&times;</a>
        <h2 class="fw-bold mb-4 text-center text-dark">
            <i class="fas fa-edit me-2"></i>Edit Data
        </h2>
        <div class="content">
            <form action="/update-menu" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="men_id" id="men_id" value="" />
                <div class="mb-4">
                    <label class="form-label fw-semibold text-dark">Nama Item</label>
                    <input type="text" class="form-input" name="nama_menu" id="nama_menu" placeholder="Masukkan nama item" required>
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
        
        // Ubah menjadi data-id, bukan val()
        var stud_id = $(this).data('id');
        
        var pass1 = "lol123";
        var pass2 = "admin7788";
        var pass = prompt('Masukan Password Sebelum Mengubah Data');

        console.log('Tombol edit diklik!');
        console.log('ID dari button:', stud_id);

        if(pass == pass1 || pass == pass2) {
            console.log('Password benar! ID:', stud_id);
            
            window.location.href = '#editModal'; // Buka modal secara eksplisit
        
            $.ajax({
                type: "GET",
                url: "/edit-menu/"+stud_id,
                dataType: "json",
                success: function(response) {
                    console.log('Response dari server:', response);
                    
                    // Coba console.log masing-masing value
                    console.log('Isi nama_menu:', response.tampil?.nama_menu);
                    console.log('Isi id:', response.tampil?.id);
                    
                    // Kosongkan dulu lalu isi
                    $('#nama_menu').val('');
                    $('#men_id').val('');
                    
                    if(response.tampil) {
                        $('#nama_menu').val(response.tampil.nama_menu);
                        $('#men_id').val(response.tampil.id);
                        console.log('Berhasil mengisi form!');
                    } else if(response.data) {
                        $('#nama_menu').val(response.data.nama_menu);
                        $('#men_id').val(response.data.id);
                    } else {
                        $('#nama_menu').val(response.nama_menu);
                        $('#men_id').val(response.id);
                    }
                    
                    // Fokus ke input nama_menu agar terlihat
                    $('#nama_menu').focus();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    alert('Terjadi kesalahan saat mengambil data!');
                }
            });
        }else{
            alert('Password Anda Masukan Salah');
            window.location.assign('rempah');
        } 
    });
});
</script>

@endsection