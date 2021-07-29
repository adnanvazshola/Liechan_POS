<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction as TransactionModel;
use App\Models\Product as ProductModel;
use App\Models\ProductTransaction as ProductTransactionModel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Cart;

class Pos extends Component
{
    public $name;
    public $tax = "0%";

    public function render()
    {
        $makanan    = ProductModel::orderBy('name', 'asc')->where('jenis_makanan', '0')->where('quantity','>', 0)->get();
        $minuman    = ProductModel::orderBy('name', 'asc')->where('jenis_makanan', '1')->where('quantity','>', 0)->get();
        $tambahan   = ProductModel::orderBy('name', 'asc')->where('jenis_makanan', '2')->where('quantity','>', 0)->get();

        $condition = new \Darryldecode\Cart\CartCondition([
            'name'  => 'tax',
            'type'  => 'tax',
            'target'=> 'total',
            'value' => $this->tax,
            'order' => 1,
        ]);

        $CartSession = \Cart::session(Auth()->id());

        $CartSession->condition($condition);
        $items = $CartSession->getContent()->sortBy(function($cart){
            return $cart->attributes->get('added_at');
        });

        if (\Cart::isEmpty()) {
            $cartData = [];
        }else {
            foreach ($items as $row) {
                $cart[] = [
                    'rowId' => $row->id,
                    'name'  => $row->name,
                    'qty'   => $row->quantity,
                    'price'   => $row->price,
                    'totalPrice' => $row->getPriceSum(),
                ];
            }

            $cartData = collect($cart);
        }

        $sub_total = $CartSession->getSubTotal();
        $total = $CartSession->getTotal();

        $newCondition = $CartSession->getCondition('tax');
        $pajak = $newCondition->getCalculatedValue($sub_total);

        $summary = [
            'sub_total' => $sub_total,
            'tax'   => $pajak,
            'total' => $total,
        ];

        return view('livewire.pos', [
            'makanan'   => $makanan,
            'minuman'   => $minuman,
            'tambahan'  => $tambahan,
            'carts'     => $cartData,
            'summary'   => $summary,
        ]);
    }

    public function addItem($id)
    {
        $rowId  = 'cart'.$id;
        $cart   = \Cart::session(Auth()->id())->getContent();
        $cekItemId = $cart->whereIn('id', $rowId);

        if($cekItemId->isNotEmpty()) {
            \Cart::session(Auth()->id())->update($rowId, [
                'quantity'  => [
                    'relative'  => true,
                    'value'     => 1,
                ]
            ]);
        }else {
            $product = ProductModel::findOrFail($id);
            
            \Cart::session(Auth()->id())->add([
                'id'    => 'Cart'.$product->id,
                'name'  => $product->name,
                'price' => $product->price,
                'quantity'  => 1,
                'attributes'    => [
                    'added_at'  => Carbon::now(),
                ],
            ]);
        }
    }

    public function addTax()
    {
        $this->tax = "10%";
    }

    public function removeTax()
    {
        $this->tax = "0%";
    }

    public function plusItem($rowId)
    {
        $idProduct = (substr($rowId, 4, 5));
        $product = ProductModel::find($idProduct);
        
        $cart = \Cart::session(Auth()->id())->getContent();
        $checkItem = $cart->whereIn('id',$rowId);

        if ($product->quantity == $checkItem[$rowId]->quantity) {
            session()->flash('error', 'menu habis');
        }else {
            \Cart::session(Auth()->id())->update($rowId, [
                'quantity'  => [
                    'relative'  => true,
                    'value'     => 1,
                ]
            ]);
        }
    }

    public function minusItem($rowId)
    {
        $idProduct = (substr($rowId, 4, 5));
        $product = ProductModel::find($idProduct);
        
        $cart = \Cart::session(Auth()->id())->getContent();
        $checkItem = $cart->whereIn('id',$rowId);

        if ($checkItem[$rowId]->quantity == 1) {
            \Cart::session(Auth()->id())->remove($rowId);
        }else {
            \Cart::session(Auth()->id())->update($rowId, [
                'quantity'  => [
                    'relative'  => true,
                    'value'     => -1,
                ]
            ]);
        }
    }

    public function removeItem($rowId)
    {
        \Cart::session(Auth()->id())->remove($rowId);
    }

    public function saveInvoice()
    {
        $invoice = 'ENV'.Str::random(7);
        $total  = \Cart::session(Auth()->id())->getTotal();
        $cart   = \Cart::session(Auth()->id())->getContent();

        $filterCart = $cart->map(function ($item){
            return [
                'id' => substr($item->id, 4,5),
                'quantity' => $item->quantity,
            ];
        });

        foreach ($filterCart as $row) {
            $products = ProductModel::find($row['id']);

            if($products->quantity === 0){
                return session()->flash('error','Jumlah item kurang');
            }
            
            $products->update([
                'quantity' => $products->quantity - $row['quantity'],
            ]);

            ProductTransactionModel::create([
                'product_id'    => $row['id'],
                'invoice'       => $invoice,
                'quantity'      => $row['quantity'],
            ]);
            
        }

        $user_id = Auth()->id();
        if (Cart::isEmpty()) {
            return session()->flash('emptyCart', 'No item in cart');
        }else {
            TransactionModel::create([
                'invoice'   => $invoice,
                'user_id'   => $user_id,
                'name'      => 'Pesanan '.$invoice,
                'to'        => $this->name ?? 'unnamed',
                'amount'    => $total,
                'type'      => 3,
                'note'      => '',
                'status'    => 0,
            ]);
        }

        $this->name = '';
        Cart::session(Auth()->id())->clear();
    }

    public function payment()
    {
        $invoice = 'ENV'.Str::random(7);
        $total  = \Cart::session(Auth()->id())->getTotal();
        $cart   = \Cart::session(Auth()->id())->getContent();

        $filterCart = $cart->map(function ($item){
            return [
                'id' => substr($item->id, 4,5),
                'quantity' => $item->quantity,
            ];
        });

        foreach ($filterCart as $row) {
            $products = ProductModel::find($row['id']);

            if($products->quantity === 0){
                return session()->flash('error','Jumlah item kurang');
            }
            
            $products->update([
                'quantity' => $products->quantity - $row['quantity'],
            ]);

            ProductTransactionModel::create([
                'product_id'    => $row['id'],
                'invoice'       => $invoice,
                'quantity'      => $row['quantity'],
            ]);
            
        }

        $user_id = Auth()->id();
        if (Cart::isEmpty()) {
            return session()->flash('emptyCart', 'No item in cart');
        }else {
            TransactionModel::create([
                'invoice'   => $invoice,
                'user_id'   => $user_id,
                'name'      => 'Pesanan '.$invoice,
                'to'        => $this->name ?? 'unnamed',
                'amount'    => $total,
                'type'      => 3,
                'note'      => '',
                'status'    => 1,
            ]);
        }

        $this->name = '';
        Cart::session(Auth()->id())->clear();
    }

    public function holdInvoice()
    {
        return redirect()->route('pos.hold.invoice');
    }

    public function historyOrders()
    {
        return redirect()->route('pos.history');
    }
}