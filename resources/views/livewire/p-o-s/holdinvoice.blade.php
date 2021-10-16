<div class="pl-3 pr-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pos.index') }}">Point of Sales</a></li>
                        <li class="breadcrumb-item active">Belum Dibayar</li>
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
            <div class="row">
                <div class="col-lg-8 col-md-8 col-xs-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Pesanan Belum Dibayar</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>    
                                        <th>No.</th>
                                        <th>Invoice</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;    
                                    @endphp
                                    @forelse ($historyOrders as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td class="text-uppercase">{{ $row->invoice }}</td>
                                            <td class="text-capitalize">{{ $row->to }}</td>
                                            <td>{{ $row->created_at->translatedFormat('d F Y') }} || {{ $row->created_at->format('H:i') }}</td>
                                            <td>
                                                <button wire:click="show({{ $row->id }})" class="btn btn-sm btn-outline-success">Detail</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    @if ($detailOrder)
                        @include('livewire.p-o-s.detail')
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>