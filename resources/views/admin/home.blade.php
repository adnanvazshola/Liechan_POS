@extends('layouts.app')
 
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Laporan Penjualan {{ date_format($today ,"F Y") }}</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="chart">
                                <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                @if($pendapatan > $pendapatanBulanLalu)
                                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> {{ number_format($untungPendapatan,0,",",".") }}%</span>
                                @elseif($pendapatan == $pendapatanBulanLalu)
                                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> {{ number_format($untungPendapatan,0,",",".") }}%</span>
                                @else
                                    <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> {{ number_format($untungPendapatan,0,",",".") }}%</span>
                                @endif
                                <h5 class="description-header">Rp. {{ number_format($pendapatan,0,',','.') }}</h5>
                                <span class="description-text">Pendapatan Kotor</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                @if($pengeluaran > $pengeluaranBulanLalu)
                                    <span class="description-percentage text-danger"><i class="fas fa-caret-up"></i> {{ number_format($untungPengeluaran,0,",",".") }}%</span>
                                @elseif($pengeluaran == $pengeluaranBulanLalu)
                                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> {{ number_format($untungPengeluaran,0,",",".") }}%</span>
                                @else
                                    <span class="description-percentage text-success"><i class="fas fa-caret-down"></i> {{ number_format($untungPengeluaran,0,",",".") }}%</span>
                                @endif
                                <h5 class="description-header">Rp. {{ number_format($pengeluaran,0,',','.') }}</h5>
                                <span class="description-text">TOTAL PENGELUARAN</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                @if($pesanan > $pesananBulanLalu)
                                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> {{ number_format($untungPendapatan,0,",",".") }}%</span>
                                @elseif($pesanan == $pesananBulanLalu)
                                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> {{ number_format($untungPendapatan,0,",",".") }}%</span>
                                @else
                                    <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> {{ number_format($untungPendapatan,0,",",".") }}%</span>
                                @endif
                                <h5 class="description-header">{{ $pesanan }}</h5>
                                <span class="description-text">TOTAL Pesanan</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                                <h5 class="description-header">23000 pcs</h5>
                                <span class="description-text">Total Penjualan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="{{ asset('adminLTE/dist/js/pages/dashboard2.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/chart.js/Chart.min.js') }}"></script>
@endpush