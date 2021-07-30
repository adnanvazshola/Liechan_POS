<div class="card card-primary sticky-top">
    <div class="card-header">
        <h6 class="card-title">Detail <span class="text-uppercase font-weight-bold">{{ $to }}</span></h6>
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
        @foreach ($cartItem as $row)
            <div class="row">
                <div class="col-5">
                    {{ $row['name'] }}<br>
                    <figcaption class="blockquote-footer">
                        Rp. {{ number_format($row['singlePrice'],0,',','.') }}
                    </figcaption>
                </div>
                <div class="col-3">
                    x{{ $row['quantity'] }}
                </div>
                @php
                    $totalProductPrice = $row['quantity'] * $row['singlePrice'];
                @endphp
                <div class="col-4">
                    Rp. {{ number_format($totalProductPrice,0,',','.') }}
                </div>
            </div>
        @endforeach
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