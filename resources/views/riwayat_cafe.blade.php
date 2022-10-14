@extends('layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    }

    .overlay:target {
        visibility: visible;
        opacity: 1;
    }

    .close {
        margin-right: 28rem;
        margin-top: 90px;
        background-color: white;
        border-radius: 10px;
        width: 20px;
        text-align: center;
    }

</style>
@php
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
    @endphp

<div class="content_wrapper">
    <!--middle content wrapper-->
    <div class="middle_content_wrapper">
        <!-- counter_area -->
        <section class="counter_area">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-1">
                        </div>
                        <div class="col-lg-6">
                            <h2>Riwayat Pengeluaran Cafe</h2>
                        </div>
                        <div class="col-lg-5">
                            <form action="/riwayat_cafe"  class="form-inline" method="GET">

                                @csrf
                                <div class="form-group mb-2">
                                    <label for="datefrom" class="mx-1">From</label>
                                    <input type="date" id="datefrom" class="form-control" name="datefrom">
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="dateto" class="mx-1">To</label>
                                    <input type="date" id="dateto" class="form-control" name="dateto">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                            
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Toko</th>
                                        <th scope="col">Metode Pembayaran</th>
                                        <th scope="col">Transaksi Jumlah</th>
                                        <th scope="col">Pembayaran</th>
                                        <th scope="col">Kembalian</th>
                                        <th scope="col">No Nota</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($transaksi as $trans)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{tgl_indo($trans->tanggal)}}</td>
                                        <td>{{$trans->nama_toko}}</td>
                                        <td>{{$trans->metode_pembayaran}}</td>
                                        <td>{{number_format($trans->transaksi_jumlah)}}</td>
                                        <td>{{number_format($trans->pembayaran)}}</td>
                                        <td><b>-</b>{{number_format($trans->kembalian)}}</td>
                                        <td>{{$trans->no_nota}}</td>
                                        <td>
                                            <a href="/detail/{{$trans->id}} #detail" class="btn btn-primary detail">Detail</a>
                                            <a href="#editbtn"><button value="{{$trans->id}}" class="btn btn-warning editbtn" id="btn">Ubah</button></a>
                                            <a href="{{url('hapus_riwayat/'.$trans->id)}}" class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


@isset($detailorder)
{{-- Detail --}}
<div class="overlay" id="detail" style="margin-top: 10px;">
    <div class="wrapper">
        <br>
        <a href="#" class="close">&times</a>
        <div class="content">
            <div class="container">
                <form style="margin-left: 30rem; margin-top: 3rem; color: white;  transition: all 0.5s ease-out">
                    @csrf
                    <h2 align="center">Details</h2><br><br>
                    <table style="text-align: center" border=1>
                        <tr>
                            <th>Nama Item</th>
                            <th>Harga</th>
                            <th>Kwantitas</th>
                            <th>Satuan</th>
                            <th>Diskon</th>
                            <th>Total</th>
                        </tr>
                        @foreach($detailorder as $key)
                        <tr>
                            <th>{{$key->cafe->nama_barang}}</th>
                            <th>{{$key->harga}}</th>
                            <th>{{$key->kwantitas}}</th>
                            <th>{{$key->satuan}}</th>
                            <th>{{$key->diskon}}</th>
                            <th>{{$key->total}}</th>
                        </tr>
                        @endforeach
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endisset

{{-- EDIT DATA --}}
<div class="overlay" id="editbtn" style="margin-top: 5px; margin-left: -20rem;">
    <div class="wrapper">
        <br>
        <a href="#" class="close">&times</a>
        <div class="content">
            <div class="container">
                <form action="/update_c" style="margin-left: 30rem; margin-top: 1rem; color: white;  transition: all 0.5s ease-out;" method="POST">
                    @method('PUT')
                    @csrf
                    <br><h2 align="center">Ubah</h2><br>
                    <input type="hidden" name="t_cafe" value="" id="t_cafe" />

                    <label>Tanggal</label><br>
                    <input type="date" name="tanggal" value="" style="width: 85%" id="tanggal"><br><br>
                    <label>Nama Toko</label><br>
                    <input type="text" name="nama_toko" value="" style="width: 85%" id="nama_toko"><br><br>
                    <label>Metode Pembayaran</label><br>
                    <select name="metode" style="width: 85%" id="metode">
                        <option>Cash</option>
                        <option>Debit</option>
                    </select><br><br>
                    <label>Transaksi Jumlah</label><br>
                    <input type="text" name="jumlah" value="" style="width: 85%" id="jumlah"><br><br>
                    <label>Pembayaran</label><br>
                    <input type="text" name="bayar" value="" style="width: 85%" id="bayar"><br><br>
                    <label>Kembalian</label><br>
                    <input type="text" name="kembalian" value="" style="width: 85%" id="kembalian"><br><br>
                    <button class="btn btn-primary">Ubah</button>
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>

<script>
    
    $(document).ready(function() {  
        $(document).on('click', '.editbtn', function() {
            var pass1 = "lol123";
            var pass2 = "admin7788";
            var pass = prompt("Masukan Password Sebelum Mengubah Data");

            if(pass == pass1 || pass == pass2) {
            var stud_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "/edit-riwayat/"+stud_id,
                success: function(response) {
                   $('#tanggal').val(response.tampil.tanggal);
                   $('#nama_toko').val(response.tampil.nama_toko);
                   $('#metode').val(response.tampil.metode_pembayaran);
                   $('#jumlah').val(response.tampil.transaksi_jumlah);
                   $('#bayar').val(response.tampil.pembayaran);
                   $('#kembalian').val(response.tampil.kembalian);
                   $('#t_cafe').val(stud_id);
                }
            });
        }else {
            alert("Password Anda Masukan Salah");
            window.location.assign("riwayat_cafe");
        }
        });
    });

</script>
@endsection
