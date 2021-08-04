<div class="pl-3 pr-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reservation.index') }}">Reservation</a></li>
                        <li class="breadcrumb-item active">Create</li>
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
            <form wire:submit.prevent="store">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-primary pb-3">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Add Reservation
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" wire:model="name" placeholder="contoh : Pak John">
                                    @error('name') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Pesanan</label>
                                    <select class="form-control" wire:model="type">
                                        <option>Pilih Jenis Pesanan</option>
                                        <option value="0">Nasi Box</option>
                                        <option value="1">Satuan</option>
                                        <option value="2">Reservasi Tempat</option>
                                        <option value="3">Lainnya</option>
                                    </select>
                                    @error('type') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Note</label><br>
                                    <textarea wire:model="note" name="note" class="form-control"></textarea>
                                    @error('note') <small class="text-danger">{{ $message }}</small>@enderror
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
                                        <label>Tanggal</label>
                                        <div class="row g-3">
                                            <div class="col">
                                                <input type="date" wire:model="date" class="form-control">
                                                @error('date') <small class="text-danger">{{ $message }}</small>@enderror
                                            </div>
                                            <div class="col">
                                                <input type="time" wire:model="time" class="form-control">
                                                @error('time') <small class="text-danger">{{ $message }}</small>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Telephone</label>
                                    <input type="number" wire:model="telephone" class="form-control">
                                    @error('telephone') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Down Payment</label>
                                    <input type="number" wire:model="downpayment" class="form-control">
                                    @error('downpayment') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" wire:model="status">
                                        <option>Pilih status</option>
                                        <option value="0">Belum Lunas</option>
                                        <option value="1">Lunas</option>
                                    </select>
                                    @error('status') <small class="text-danger">{{ $message }}</small>@enderror
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
@push('js')
    <script src="https://cdn.ckeditor.com/4.16.1/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'note' );
    </script>
@endpush