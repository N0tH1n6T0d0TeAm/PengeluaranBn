@extends('layout')
@section('content')
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
                            <h2>Riwayat Pengeluaran PO</h2>
                        </div>
                        <div class="col-lg-5">
                            <form class="form-inline" action="/riwayat_po" method="GET">

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
                                            <a href="/detailPo/{{$trans->id}} #detail" class="btn btn-primary detail">Detail</a> 
                                            <a href="#ubah"><button class="btn btn-warning ubah" value="{{$trans->id}}">Ubah</button></a> 
                                            <a href="{{url('hapus_riwayat_po/'.$trans->id)}}" class="btn btn-danger">Hapus</a>
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
                            <th>{{$key->menu->nama_menu}}</th>
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

{{-- UBAH --}}
<div class="overlay" id="ubah" style="margin-top: 5px; margin-left: -20rem;">
    <div class="wrapper">
        <br>
        <a href="#" class="close">&times</a>
        <div class="content">
            <div class="container">
                <form action="/update_p" style="margin-left: 30rem; margin-top: 1rem; color: white;  transition: all 0.5s ease-out;" method="POST">
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
                        $(document).on('click', '.ubah', function() {
                        
                            var pass1 = "lol123";
                            var pass2 = "admin7788"
                            var pass = prompt("Masukan Password Sebelum Mengubah Data");

                            if(pass == pass1 || pass == pass2){
                                var id = $(this).val();

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
@endsection
