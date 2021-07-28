@push('css')
    .btn-outline-warning:hover{
        color: white;
    }
    .clickable {
        cursor: pointer;
    }
    .right-col {
        text-align: center;
    }
@endpush
<div class="pl-3 pr-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transaction</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button wire:click="create" class="btn btn-sm btn-outline-primary rounded-pill">+ Add transaction</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Daftar Transaksi</h3>
                </div>
                <div class="card-body">
                    <table class="table w-100">
                        <thead>
                            <tr>
                                <th style="width: 10%">No.</th>
                                <th style="width: 20%">Nama Transaksi</th>
                                <th style="width: 15%">Dari / Kepada</th>
                                <th style="width: 10%">Total</th>
                                <th style="width: 10%">Jenis</th>
                                <th style="width: 25%">Note</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $row)
                            <tr>
                                <td class="text-uppercase">{{ $row->invoice }}</td>
                                <td class="clickable warning dropdown-deliverable" wire:click="#">{{ $row->name }}</td>
                                <td>{{ $row->to }}</td>
                                <td>Rp. {{ number_format($row->amount,0,',','.') }}</td>
                                <td>
                                    @if($row->type == 0)    
                                        <span class="badge badge-danger">Pengeluaran</span>
                                    @elseif($row->type == 1)
                                        <span class="badge badge-success">Pemasukan</span>
                                    @else
                                        <span class="badge badge-warning">Error</span>
                                    @endif
                                </td>
                                <td>{{ $row->note }}</td>
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
                    <nav>
                        <ul class="pagination pagination-sm">
                            {{ $transactions->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</div>
