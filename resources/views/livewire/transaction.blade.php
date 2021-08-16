@push('css')
    <style>
        .btn-outline-warning:hover{
            color: white;
        }
        .clickable {
            cursor: pointer;
        }
        .right-col {
            text-align: center;
        }
    </style>
@endpush
<div class="pl-3 pr-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Keuangan</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button wire:click="create" class="btn btn-sm btn-outline-primary rounded-pill">+ Tambah Transaksi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h6 class="card-title">Laporan Bulan {{ $today->translatedFormat('F Y') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-coins"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pendapatan Kotor</span>
                                    <span class="info-box-number text-sm">
                                        Rp. {{ number_format($pendapatanKotor,0,',','.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-coins"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pengeluaran</span>
                                    <span class="info-box-number text-sm">
                                        Rp. {{ number_format($pengeluaran,0,',','.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix hidden-md-up"></div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-coins"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pesanan Hari Ini</span>
                                    <span class="info-box-number text-sm">
                                        {{ $pesanan }} pesanan
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-coins" style="color: white;"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pendapatan Hari Ini</span>
                                    <span class="info-box-number text-sm">
                                        Rp. {{ number_format($pendapatanToday,0,',','.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Daftar Transaksi</h3>
                </div>
                <div class="card-body">
                    <table class="table w-100">
                        <thead>
                            <tr>
                                <th style="width: 10%">Invoice</th>
                                <th style="width: 20%">Nama Transaksi</th>
                                <th style="width: 15%">Dari / Kepada</th>
                                <th style="width: 10%">Jenis</th>
                                <th style="width: 15%">Tanggal</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $row)
                            <tr>
                                <td class="text-uppercase">{{ $row->invoice }}</td>
                                <td class="clickable warning dropdown-deliverable font-weight-bold" wire:click="detail({{ $row->id }})">{{ $row->name }}</td>
                                <td>{{ $row->to }}</td>
                                <td>
                                    @if($row->type == 0)    
                                        <span class="badge badge-danger">Pengeluaran</span>
                                    @elseif($row->type == 1 || $row->type == 3)
                                        <span class="badge badge-success">Pemasukan</span>
                                    @else
                                        <span class="badge badge-warning">Error</span>
                                    @endif
                                </td>
                                <td>{{ $row->created_at->translatedFormat('d F Y') }}</td>
                                <td>
                                    <button wire:click="edit({{ $row->id }})" class="btn btn-sm btn-outline-warning">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <button wire:click="delete({{ $row->id }})" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data transaksi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </section>
</div>