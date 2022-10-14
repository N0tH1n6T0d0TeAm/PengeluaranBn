@extends('layout')
@section('content')

{{-- https://www.aspsnippets.com/Articles/Dynamically-populate-Year-in-DropDownList-SELECT-using-JavaScript.aspx --}}
@php
$total_transaksi = 0;

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

<form action="/laporan_cafe_bulanan/search" method="GET">
<table>
    <tr>
        <td> <h2 style="margin: 10px;">Laporan Bulanan Cafe</h2></td>
        <td><select name="search" style="margin: 10px; height: 30px; width:150px">
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select></td>

        <td><select name="search2" id="ddlYears" style="margin: 10px; height: 30px; width:150px">
           
        </select></td>

        <td><button class="btn btn-success">Cari</button></td>
    </tr>
</table>
</form>
    <script type="text/javascript">
    window.onload = function () {
        //Reference the DropDownList.
        var ddlYears = document.getElementById("ddlYears");
 
        //Determine the Current Year.
        var currentYear = (new Date()).getFullYear();
 
        //Loop and add the Year values to DropDownList.
        for (var i = 2022; i <= currentYear; i++) {
            var option = document.createElement("option");
            option.innerHTML = i;
            option.value = i;
            ddlYears.appendChild(option);
        }
    };
</script>
<table style="margin: 10px; width: 50rem; text-align: center" border=1 id="table">
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Transaksi Jumlah</th>
</tr>
@php $no=1; @endphp
@foreach($cafe as $key)
<tr>
    @php
    $total_transaksi += $key->transaksi_jumlah;
@endphp
    <td>{{$no++}}</td>
    <td>{{tgl_indo($key->tanggal)}}</td>
    <td>{{$key->transaksi_jumlah}}</td>
</tr>
@endforeach
<th>Total</th>
<th>{{$total_transaksi}}</th>
</table>
<button id="downloadexcel" class="btn btn-success" style="margin: 10px 10px 10px 25rem">Download</button>


<script>
    document.getElementById('downloadexcel').addEventListener('click', function() {
		var table2excel = new Table2Excel();
  		table2excel.export(document.querySelectorAll("#table"));
	});
</script>
@endsection