<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product as ProductModel;
use Carbon\Carbon;

use function PHPSTORM_META\type;

class Order extends Component
{
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

        return view('livewire.order', [
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
}
