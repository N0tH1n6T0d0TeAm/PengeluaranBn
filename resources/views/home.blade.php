@extends('layout')
@section('content')

@php
    $total_po = 0;
    foreach($home as $key) {
        $total_po += $key->transaksi_jumlah;
    }

    $total_cafe=0;
    foreach($home2 as $key2) {
        $total_cafe  += $key2->transaksi_jumlah;
    }
@endphp
<h2 style="margin-left: 30rem;">Total Pengeluaran Setiap Hari</h2><br><br>
<h2 style="margin-left: 10rem">Total Pengeluaran PO: {{$total_po}}</h2>
<h2 style="margin-left: 10rem">Total Pengeluaran Cafe: {{$total_cafe}}</h2>
@endsection