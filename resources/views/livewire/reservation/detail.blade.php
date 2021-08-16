<div class="pl-3 pr-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reservation.index') }}">Reservasi</a></li>
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
                        Detail Reservasi <span class="font-weight-bold">{{ $name }}</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <table class="table table-hover">
                                <tr>
                                    <th>Invoice</th><td>:</td><td class="text-uppercase">{{ $invoice }}</td>
                                </tr><tr>
                                    <th>Nama</th><td>:</td><td>{{ $name }}</td>
                                </tr><tr>
                                    <th>Jenis Reservasi</th><td>:</td>
                                    <td>
                                        @if($type == 0)    
                                            <span>Nasi Box</span>
                                        @elseif($type == 1)
                                            <span>Satuan</span>
                                        @elseif($type == 2)
                                            <span>Reservasi Tempat</span>
                                        @elseif($type == 3)
                                            <span>Lainnya</span>
                                        @else
                                            <span>Error</span>
                                        @endif
                                    </td>
                                </tr><tr>
                                    <th>Tanggal</th><td>:</td><td>{{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }} || {{ \Carbon\Carbon::parse($time)->format('H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <table class="table table-hover">
                                <tr>
                                    <th>Telephone</th><td>:</td><td>{{ $telephone ?? 'tidak ada' }}</td>
                                </tr><tr>
                                    <th>Down Payment</th><td>:</td><td>Rp. {{ number_format($downpayment,0,',','.') }}</td>
                                </tr><tr>
                                    <th>Status Pembayaran</th><td>:</td>
                                    <td>
                                        @if($status == 0)    
                                            <span class="text-danger">Belum Lunas</span>
                                        @elseif($status == 1)
                                            <span class="text-success">Lunas</span>
                                        @else
                                            <span class="text-warning">Error</span>
                                        @endif
                                    </td>
                                </tr><tr>
                                    <th>Note</th><td>:</td><td>{!! $note !!}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>