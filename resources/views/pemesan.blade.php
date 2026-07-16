@extends('layout')
@section('content')
<style>
    .button{
        transition: all 0.3s ease-out;
    }
    .overlay{
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.8);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
    }
    .overlay:target{
        visibility: visible;
        opacity: 1;
    }
    .close{
      margin-right: 25rem;
      margin-top: 50px;
      background-color: white;
      border-radius: 10px;
      width: 20px;
      text-align: center;
    } 
</style>
<div class="box">
    <a href="#divOne" class="button btn btn-success" style="margin-left: 30px; margin-top: 10px">+</a>
</div>

{{-- Form Tambah --}}
<div class="overlay" id="divOne">
    <div class="wrapper">
        <a href="#" class="close">&times</a>
        <div class="content">
            <div class="container">
                <form action="/menu" method="POST" style="margin-left: 35rem; margin-top: 7rem; color: white;  transition: all 0.5s ease-out">
                    @csrf
                    <h2>Pemesan</h2><br>
                    <label> Nama Menu</label><br>
                    <input type="text" name="nama_menu" placeholder="Nama Menu" required><br><br>
                    <input type="submit" value="Tambah"><br>
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<table style="margin-left: 17rem;width: 50%; text-align: center;" border=1>
    <tr>
        <thead>
        <th>No</th>
        <th>Tanggal</th>
        <th>Pemesan</th>
        <th>Alamat</th>
        <th>Status</th>
        <th>Aksi</th>
        </thead>
    </tr>
    @php $no=1; @endphp
    <tbody>
        <tr>
            <td>{{$no++}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td>Proses</td>
            <td>
                <a href="#editModal" style="margin: 5px;"><button class="button btn btn-info editbtn" value=""><i class="far fa-edit"></i></button></a> 
                
                <a href=""><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>

                <a href="#editModal" style="margin: 5px;"><button class="button btn btn-success editbtn" value=""><i class="fas fa-check"></i></button></a> 
            </td>
        </tr>
    </tbody>
</table>

{{-- Edit Modal --}}
<div class="overlay" id="editModal" style="margin-top: 10px;">
    <div class="wrapper">
        <h2>Tambah Menu</h2>
        <a href="#" class="close">&times</a>
        <div class="content">
            <div class="container">
                <form action="/update-menu" method="POST" style="margin-left: 35rem; margin-top: 3rem; color: white;  transition: all 0.5s ease-out">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="men_id" id="men_id" value="" />
                    <h2 align="center">Edit Data</h2><br>
                    <label> Nama Menu</label><br>
                    <input type="text" name="nama_menu" id="nama_menu" placeholder="Nama Menu" required><br><br>
                    <input type="submit" value="submit"><br>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        $(document).on('click', '.editbtn', function() {
           var stud_id = $(this).val();
           //alert(stud_id);
            //  $('#editModal').modal('show');

            $.ajax({
                type: "GET",
                url: "/edit-menu/"+stud_id,
                success: function(response) {
                    console.log(response.tampil.nama_menu);

                    $('#nama_menu').val(response.tampil.nama_menu);
                    $('#men_id').val(response.tampil.id);
                }
            });
        });
    });
</script>

@endsection