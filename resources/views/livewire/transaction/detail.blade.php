<div class="pl-3 pr-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Finance</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button wire:click="back" class="btn btn-sm btn-outline-danger rounded-pill">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        Detail Transaction <span class="font-weight-bold">{{ $name }}</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <table class="table table-hover">
                                <tr>
                                    <th>Invoice</th><td>:</td><td>{{ $invoice }}</td>
                                </tr><tr>
                                    <th>Name</th><td>:</td><td>{{ $name }}</td>
                                </tr><tr>
                                    <th>Dari / Ke</th><td>:</td><td>{{ $to }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <table class="table table-hover">
                                <tr>
                                    <th>Total Transaksi</th><td>:</td><td>Rp. {{ number_format($amount,0,',','.') }}</td>
                                </tr><tr>
                                    <th>Jenis Transaksi</th><td>:</td>
                                    <td>
                                        @if($type == 0)    
                                            <span class="text-danger">Pengeluaran</span>
                                        @elseif($type == 1 || $row->type == 3)
                                            <span class="text-success active">Pemasukan</span>
                                        @else
                                            <span class="text-warning">Error</span>
                                        @endif
                                    </td>
                                </tr><tr>
                                    <th>Note</th><td>:</td><td>{{ $note }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>