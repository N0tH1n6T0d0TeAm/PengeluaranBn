@extends('layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
      margin-right: 32rem;
      margin-top: 90px;
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
        <h2>Tambah Item</h2>
        <a href="#" class="close">&times</a>
        <div class="content">
            <div class="container">
                <form action="/rempah" method="POST" style="margin-left: 35rem; margin-top: 7rem; color: white;  transition: all 0.5s ease-out">
                    @csrf
                    <label> Nama Item</label><br>
                    <input type="text" name="nama_menu" placeholder="Nama Item" required><br><br>
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
        <th>Nama Item</th>
        <th>Aksi</th>
        </thead>
    </tr>
    @php $no=1; @endphp
    @foreach($lihat as $tampil)
    <tbody>
        <tr>
            <td>{{$no++}}</td>
            <td>{{$tampil->nama_menu}}</td>
            <td><a href="#editModal" style="margin: 5px;"><button class="button btn btn-info editbtn" value="{{$tampil->id}}">Ubah</button></a> <a href="{{url('delete/'.$tampil->id)}}"><button class="btn btn-danger">Hapus</button></a></td>
        </tr>
    </tbody>
    @endforeach
</table>

{{-- Edit Modal --}}
<div class="overlay" id="editModal" style="margin-top: 10px;">
    <div class="wrapper">
        <br>
        <a href="#" class="close">&times</a>
        <div class="content">
            <div class="container">
                <form action="/update-menu" method="POST" style="margin-left: 35rem; margin-top: 3rem; color: white;  transition: all 0.5s ease-out">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="men_id" id="men_id" value="" />
                    <h2 align="center">Edit Data</h2><br>
                    <label> Nama Item</label><br>
                    <input type="text" name="nama_menu" id="nama_menu" placeholder="Nama Item" required><br><br>
                    {{-- <label> Jumlah</label><br>
                    <input type="text" name="jumlah"  id="jumlah" placeholder="Jumlah" required><br><br> --}}
                    <input type="submit" value="submit"><br>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        $(document).on('click', '.editbtn', function() {

            var pass1 = "lol123";
            var pass2 = "admin7788";
            var pass = prompt('Masukan Password Sebelum Mengubah Data');

            if(pass == pass1 || pass == pass2) {
             var stud_id = $(this).val();
           
                $.ajax({
                    type: "GET",
                    url: "/edit-menu/"+stud_id,
                    success: function(response) {
                        console.log(response.tampil.nama_menu);

                        $('#nama_menu').val(response.tampil.nama_menu);
                        $('#men_id').val(response.tampil.id);
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