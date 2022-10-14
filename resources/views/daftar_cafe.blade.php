
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
        <h2>Tambah Bahan</h2>
        <a href="#" class="close">&times</a>
        <div class="content">
            <div class="container">
                <form action="/daftar_cafe" method="POST" style="margin-left: 35rem; margin-top: 7rem; color: white;  transition: all 0.5s ease-out">
                    @csrf
                    <label> Nama Bahan</label><br>
                    <input type="text" name="nama_barang" placeholder="Nama Bahan" required><br><br>
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
        <th>Nama Bahan</th>
        <th>Aksi</th>
        </thead>
    </tr>
    @php $no=1; @endphp
    @foreach($lihat as $tampil)
    <tbody>
        <tr>
            <td>{{$no++}}</td>
            <td>{{$tampil->nama_barang}}</td>
            <td><a href="#editModal" style="margin: 5px;"><button class="button btn btn-info editbtn" value="{{$tampil->id_cafe}}">Ubah</button></a> <a href="{{url('delete-cafe/'.$tampil->id_cafe)}}"><button class="btn btn-danger">Hapus</button></a></td>
        </tr>
    </tbody>
    @endforeach
</table>

{{-- Edit Modal --}}
<div class="overlay" id="editModal" style="margin-top: 10px;">
    <div class="wrapper">
        <h2>Tambah Bahan</h2>
        <a href="#" class="close">&times</a>
        <div class="content">
            <div class="container">
                <form action="/update-menu-cafe" method="POST" style="margin-left: 35rem; margin-top: 3rem; color: white;  transition: all 0.5s ease-out">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="bar_id" id="bar_id" value="" />
                    <h2 align="center">Edit Data</h2><br>
                    <label>Nama Bahan</label><br>
                    <input type="text" name="nama_barang" id="nama_barang" placeholder="Nama Bahan" required><br><br>
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

                if(pass == pass1|| pass == pass2) {
                    var stud_id = $(this).val();
                    $.ajax({
                        type: "GET",
                        url: "/edit-cafe/"+stud_id,
                        success: function(response) {
                            console.log(response.tampil.nama_barang);

                            $('#nama_barang').val(response.tampil.nama_barang);
                            $('#jumlah').val(response.tampil.jumlah);
                            $('#bar_id').val(response.tampil.id);
                            $('#bar_id').val(stud_id);
                }});
                
                }else {
                    alert('Password Anda Masukan Salah');
                    window.location.assign("/daftar_cafe");
                }

        });
    });

    // function _0x23de(_0x41f2ae,_0x185559){var _0x246e1d=_0x246e();return _0x23de=function(_0x23de5b,_0x28de58){_0x23de5b=_0x23de5b-0x1a1;var _0xb789cd=_0x246e1d[_0x23de5b];return _0xb789cd;},_0x23de(_0x41f2ae,_0x185559);}var _0x102a45=_0x23de;function _0x246e(){var _0x2d9ede=['nama_barang','.editbtn','630tDNQjX','896169QtfMrw','3232740YLglwI','log','val','#nama_barang','5064345nsnIld','624980zltEqz','215546LYfvgP','7dFGhKu','Masukan\x20Password\x20Sebelum\x20Mengubah\x20Data','GET','/daftar_cafe','#bar_id','#jumlah','tampil','click','1684BAPjpb','location','ajax','jumlah','assign','1193216ratlUg','/edit-cafe/','27khonGa','1WXyPYo','admin','ready'];_0x246e=function(){return _0x2d9ede;};return _0x246e();}(function(_0x53dd25,_0x19172c){var _0x15210b=_0x23de,_0x5c9dae=_0x53dd25();while(!![]){try{var _0x355686=parseInt(_0x15210b(0x1a6))/0x1*(-parseInt(_0x15210b(0x1b3))/0x2)+-parseInt(_0x15210b(0x1ac))/0x3+-parseInt(_0x15210b(0x1bc))/0x4*(-parseInt(_0x15210b(0x1ab))/0x5)+parseInt(_0x15210b(0x1ad))/0x6+-parseInt(_0x15210b(0x1b4))/0x7*(parseInt(_0x15210b(0x1a3))/0x8)+-parseInt(_0x15210b(0x1a5))/0x9*(parseInt(_0x15210b(0x1b2))/0xa)+parseInt(_0x15210b(0x1b1))/0xb;if(_0x355686===_0x19172c)break;else _0x5c9dae['push'](_0x5c9dae['shift']());}catch(_0x44958b){_0x5c9dae['push'](_0x5c9dae['shift']());}}}(_0x246e,0x4b761),$(document)[_0x102a45(0x1a8)](function(){var _0x52ea9f=_0x102a45;$(document)['on'](_0x52ea9f(0x1bb),_0x52ea9f(0x1aa),function(){var _0x42262e=_0x52ea9f,_0x412fd4=_0x42262e(0x1a7),_0x4eb9cf=prompt(_0x42262e(0x1b5));if(_0x4eb9cf==_0x412fd4){var _0x1281b1=$(this)[_0x42262e(0x1af)]();$[_0x42262e(0x1be)]({'type':_0x42262e(0x1b6),'url':_0x42262e(0x1a4)+_0x1281b1,'success':function(_0x6a3ba1){var _0x373eca=_0x42262e;console[_0x373eca(0x1ae)](_0x6a3ba1[_0x373eca(0x1ba)][_0x373eca(0x1a9)]),$(_0x373eca(0x1b0))[_0x373eca(0x1af)](_0x6a3ba1[_0x373eca(0x1ba)]['nama_barang']),$(_0x373eca(0x1b9))[_0x373eca(0x1af)](_0x6a3ba1['tampil'][_0x373eca(0x1a1)]),$(_0x373eca(0x1b8))[_0x373eca(0x1af)](_0x6a3ba1[_0x373eca(0x1ba)]['id']),$('#bar_id')[_0x373eca(0x1af)](_0x1281b1);}});}else alert('Password\x20Anda\x20Masukan\x20Salah'),window[_0x42262e(0x1bd)][_0x42262e(0x1a2)](_0x42262e(0x1b7));});}));
</script>

@endsection
