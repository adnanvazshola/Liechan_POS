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
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reservation.index') }}">Reservasi</a></li>
                        <li class="breadcrumb-item active">Riwayat</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button wire:click="back" class="btn btn-sm btn-outline-danger rounded-pill mr-2">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h6 class="card-title">Reservasi</h6>
                </div>
                <div class="card-body">
                    <table class="table  w-100">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Pesanan</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $row)
                            <tr>
                                <td class="text-uppercase">{{ $row->invoice }}</td>
                                <td>
                                    @if ($row->type == 0)
                                        Nasi Box
                                    @elseif($row->type == 1)
                                        Satuan
                                    @elseif($row->type == 2)
                                        Reservasi
                                    @else
                                        Lainnya
                                    @endif
                                <td><span class="clickable font-weight-bold" wire:click="detail({{ $row->id }})">{{ $row->name }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($row->date)->translatedFormat('d F Y') }} || {{ \Carbon\Carbon::parse($row->time)->format('H:i') }}</td>
                                <td>
                                    @if ($row->status == 0)
                                        <span class="badge rounded-pill bg-danger">Belum Lunas</span>
                                    @else
                                        <span class="badge rounded-pill bg-success">Lunas</span>
                                    @endif
                                </td>
                                <td>
                                    <button wire:click="destroy({{$row->id}})" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada Data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $reservations->links() }}
                </div>
            </div>      
        </div>
    </section>
</div>