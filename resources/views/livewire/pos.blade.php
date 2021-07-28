<div class="pl-3 pr-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Point of Sales</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button wire:click="holdInvoice" class="btn btn-sm btn-outline-success rounded-pill">Pesanan Belum Dibayar</button>
                        <button wire:click="historyOrders" class="btn btn-sm btn-outline-info rounded-pill">History</button>
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
                            <h6 class="card-title">Makanan</h6>
                            {{-- <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($makanan as $row)
                                <div class="col-lg-3 col-md-4 col-xs-12 mb-4">
                                    <div class="card h-100" style="border-top-right-radius: 10px; border-top-left-radius: 10px;">
                                        <img class="card-img-top" style="border-top-right-radius: 10px; border-top-left-radius: 10px; " src="{{ asset('storage/images/'.$row->image) }}" alt="{{ $row->name }}">
                                        <div class="card-body">
                                            <p class="h6 text-capitalize">{{ $row->name }}</p>
                                            <figcaption class="blockquote-footer">
                                                Rp. {{ $row->price }}
                                            </figcaption>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-sm btn-primary btn-block" wire:click="addItem({{ $row->id }})">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Minuman</h6>
                            {{-- <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($minuman as $row)
                                <div class="col-lg-3 col-md-4 col-sm-12 mb-4">
                                    <div class="card h-100" style="border-top-right-radius: 10px; border-top-left-radius: 10px;">
                                        <img class="card-img-top" style="border-top-right-radius: 10px; border-top-left-radius: 10px; " src="{{ asset('storage/images/'.$row->image) }}" alt="{{ $row->name }}">
                                        <div class="card-body">
                                            <p class="h6 text-capitalize">{{ $row->name }}</p>
                                            <figcaption class="blockquote-footer">
                                                Rp. {{ $row->price }}
                                            </figcaption>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-sm btn-primary btn-block" wire:click="addItem({{ $row->id }})">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Tambahan</h6>
                            {{-- <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($tambahan as $row)
                                <div class="col-lg-3 col-md-4 col-sm-12 mb-4">
                                    <div class="card h-100" style="border-top-right-radius: 10px; border-top-left-radius: 10px;">
                                        <img class="card-img-top" style="border-top-right-radius: 10px; border-top-left-radius: 10px; " src="{{ asset('storage/images/'.$row->image) }}" alt="{{ $row->name }}">
                                        <div class="card-body">
                                            <p class="h6 text-capitalize">{{ $row->name }}</p>
                                            <figcaption class="blockquote-footer">
                                                Rp. {{ $row->price }}
                                            </figcaption>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-sm btn-primary btn-block" wire:click="addItem({{ $row->id }})">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="card card-primary sticky-top">
                        <div class="card-header">
                            <h6 class="card-title">Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            @if (session()->has('error'))
                                <small class="text-danger">Menu habis</small>
                            @endif
                            <div class="row">
                                <div class="col-5">
                                    <b>Menu</b>
                                </div>
                                <div class="col-3">
                                    <b>Qty</b>
                                </div>
                                <div class="col-4">
                                    <b>Total</b>
                                </div>
                            </div>
                            <hr>
                            @forelse ($carts as $row)
                                <div class="row">
                                    <div class="col-1">
                                        <button class="btn btn-danger btn-xs" wire:click="removeItem('{{ $row['rowId'] }}')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        {{ $row['name'] }}<br>
                                        <figcaption class="blockquote-footer">
                                            Rp. {{ number_format($row['price'],0,',','.') }}
                                        </figcaption>
                                    </div>
                                    <div class="col-3">
                                        <button wire:click="minusItem('{{ $row['rowId'] }}')" class="btn btn-xs btn-danger active"><i class="fas fa-minus"></i></button>
                                        x{{ $row['qty'] }}
                                        <button wire:click="plusItem('{{ $row['rowId'] }}')" class="btn btn-xs btn-success active"><i class="fas fa-plus"></i></button>
                                    </div>
                                    <div class="col-4">
                                        Rp. {{ number_format($row['totalPrice'],0,',','.') }}
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <span>Kosong</span>
                                </div>
                            @endforelse
                            <hr class="w-100">
                            <div class="row">
                                <div class="col-md-7">
                                    <b>Subtotal</b>
                                </div>
                                <div class="col-md-5">
                                    <b>Rp. {{ number_format($summary['sub_total'],0,',','.') }}</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <b>Pajak</b>
                                </div>
                                <div class="col-md-5">
                                    <b>Rp. {{ number_format($summary['tax'],0,',','.') }}</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <b>Total</b>
                                </div>
                                <div class="col-5">
                                    <b>Rp. {{ number_format($summary['total'],0,',','.') }}</b>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-sm btn-block btn-success" wire:click="addTax">Tambah Pajak</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-sm btn-block btn-danger" wire:click="removeTax">Hapus Pajak</button>
                                </div>
                            </div>
                            <form wire:submit.prevent="saveInvoice">
                                <button class="btn btn-sm btn-primary w-100 mt-3">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
