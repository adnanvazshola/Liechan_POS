<?php

namespace App\Http\Livewire\POS;

use App\Models\ProductTransaction;
use App\Models\Transaction;
use Livewire\Component;

class HoldInvoice extends Component
{
    public $id_transaction, $invoice, $amount, $date, $id_product, $name, $quantity, $productPrice, $totalProductPrice, $status, $to;
    public $detailOrder = 0;
    public $cartItem;

    public function render()
    {
        $historyOrders = Transaction::with('product')->orderBy('created_at', 'desc')->where('type', 3)->where('status', 0)->get();
        return view('livewire.p-o-s.holdinvoice',[
            'historyOrders' => $historyOrders,
        ]);
    }

    public function show($id)
    {
        $historyOrder = Transaction::with('product')->where('id', $id)->first();
        $productHistory = ProductTransaction::with('product')->where('invoice', $historyOrder->invoice)->get();
        $this->cartItem = $productHistory->map(function ($item){
            return [
                'product_id'    => $item->product_id,
                'name'          => $item->product->name,
                'description'   => $item->product->description,
                'singlePrice'   => $item->product->price,
                'quantity'      => $item->quantity,
            ];
        });

        foreach ($this->cartItem as $row) {
            $this->id_product = $row['product_id'];
            $this->name = $row['name'];
            $this->quantity = $row['quantity'];   
            $this->productPrice = $row['singlePrice'];
            $totalPrice = $row['quantity'] * $row['singlePrice'];
            $this->totalProductPrice = $totalPrice;
        }
        $this->to = $historyOrder->to;
        $this->invoice = $historyOrder->invoice;
        $this->amount = $historyOrder->amount;
        $this->id_transaction = $historyOrder->id;
        $this->status = $historyOrder->status;
        $this->showDetail();
        // dd($this->id_transaction);
    }

    public function payment($id)
    {
        $invoice = Transaction::find($id);
        // dd($invoice);
        $invoice->update([
            'status' => 1,
        ]);

        $this->closeDetail();
    }

    public function showDetail()
    {
        $this->detailOrder = true;
    }

    public function closeDetail()
    {
        $this->detailOrder = false;
    }

    public function back()
    {
        return redirect()->route('pos.index');
    }
}
