<div class="card card-primary sticky-top">
    <div class="card-header">
        <h6 class="card-title">Detail <span class="text-uppercase font-weight-bold">{{ $invoice }}</span></h6>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
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
            <div class="row">
                <div class="col-5">
                    {{ $name }}<br>
                    <figcaption class="blockquote-footer">
                        Rp. {{ number_format($productPrice,0,',','.') }}
                    </figcaption>
                </div>
                <div class="col-3">
                    x{{ $quantity }}
                </div>
                <div class="col-4">
                    Rp. {{ number_format($totalProductPrice,0,',','.') }}
                </div>
            </div>
        <hr class="w-100">
        <div class="row">
            <div class="col-7">
                <b>Total</b>
            </div>
            <div class="col-5">
                <b>Rp. {{ number_format($amount,0,',','.') }}</b>
            </div>
        </div>
    </div>
    @if ($status == 0)
        <div class="card-footer">
            <button wire:click="payment({{ $id_transaction }})" class="btn btn-sm btn-primary btn-block">Bayar</button>
        </div>
    @endif
</div>