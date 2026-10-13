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

<!-- Container Responsif dengan Bootstrap -->
<div class="container py-4">
    <!-- Judul Halaman -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h2 class="display-6 fw-bold text-primary">
                <i class="fas fa-cash-register me-2"></i>
                Total Pengeluaran Setiap Hari
            </h2>
        </div>
    </div>

    <!-- Card untuk Total Pengeluaran -->
    <div class="row g-4 justify-content-center">
        <!-- Card PO -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow-lg border-0 rounded-4">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-file-invoice-dollar fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title text-muted text-uppercase fw-semibold mb-2">
                        Total Pengeluaran PO
                    </h5>
                    <h3 class="fw-bold text-dark">
                        Rp {{ number_format($total_po, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Card Cafe -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow-lg border-0 rounded-4">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-coffee fa-3x text-success"></i>
                    </div>
                    <h5 class="card-title text-muted text-uppercase fw-semibold mb-2">
                        Total Pengeluaran Cafe
                    </h5>
                    <h3 class="fw-bold text-dark">
                        Rp {{ number_format($total_cafe, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection