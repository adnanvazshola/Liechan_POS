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
<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transaksi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                Tambah Transaksi
                            </h3>
                        </div>
                        <form wire:submit.prevent="store">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Transaksi</label>
                                    <input type="text" class="form-control" wire:model="name" placeholder="contoh : DP Tempat">
                                    @error('name') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Dari / Kepada</label>
                                    <input type="text" class="form-control" wire:model="to" placeholder="contoh : John Doe">
                                    @error('to') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Total Transaksi</label>
                                    <input type="number" class="form-control" wire:model="amount" placeholder="contoh : Rp. 1.000.000">
                                    @error('amount') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Jenis Transaksi</label>
                                        <select class="form-control" wire:model="type">
                                            <option>Pilih Jenis Transaksi</option>
                                            <option value="0">Pengeluaran</option>
                                            <option value="1">Pemasukan</option>
                                        </select>
                                        @error('type') <small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Metode Transaksi</label>
                                    <select class="form-control" wire:model="method">
                                        <option>Pilih Jenis Transaksi</option>
                                        <option value="0">Tunai</option>
                                        <option value="1">Transfer</option>
                                    </select>
                                    @error('method') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea class="form-control" wire:model="note"></textarea>
                                    @error('note') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm w-100">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Transaksi</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 col-xs-12">Filter</div>
                                <div class="col-3 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="masukan nama transaksi...">
                                    </div>
                                </div>
                            </div>
                        <table class="table w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">No.</th>
                                        <th style="width: 35%">Nama Transaksi</th>
                                        <th style="width: 20%">Dari / Kepada</th>
                                        <th style="width: 15%">Jenis</th>
                                        <th style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse($transaction as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td class="clickable warning dropdown-deliverable" wire:click="show({{ $row->id }})">{{ $row->name }}</td>
                                        <td>{{ $row->to }}</td>
                                        <td>
                                            @if($row->type == 0)    
                                                <span class="badge badge-danger">Pengeluaran</span>
                                            @elseif($row->type == 1)
                                                <span class="badge badge-success">Pemasukan</span>
                                            @else
                                                <span class="badge badge-warning">Error</span>
                                            @endif
                                        </td>
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
                        </div>
                    </div>
                </div>
            </div>
            @if($detail)
                @include('livewire.transaction.detail')
            @endif
        </div>
    </section>
</div>
