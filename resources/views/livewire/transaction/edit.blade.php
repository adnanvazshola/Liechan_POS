<div class="pl-3 pr-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Transaction</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
            <form wire:submit.prevent="update">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Update Transaction
                                </h3>
                            </div>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Lainnya
                                </h3>
                            </div>
                            <div class="card-body">
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
                                    <label for="catatan">Catatan</label>
                                    <textarea class="form-control" wire:model="note"></textarea>
                                    @error('note') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>