<?php

namespace App\Http\Livewire\POS;

use Livewire\Component;
use App\Models\ProductTransaction;
use App\Models\Transaction;
use Livewire\WithPagination;

class History extends Component
{
    use WithPagination;

    public $id_transaction, $invoice, $amount, $date, $id_product, $name, $quantity, $productPrice, $totalProductPrice, $status, $to;
    public $cartItem;
    public $detailOrder = 0;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $historyOrders = Transaction::with('product')->orderBy('created_at', 'desc')->where('type', 3)->where('status', 1)->paginate(10);
        
        return view('livewire.p-o-s.history',[
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
                'singlePrice'   => $item->product->price,
                'quantity'      => $item->quantity,
            ];
        });
        // dd($this->cartItem);

        foreach ($this->cartItem as $row) {
            $this->id_product = $row['product_id'];
            $this->name = $row['name'];
            $this->quantity = $row['quantity'];   
            $this->productPrice = $row['singlePrice'];
        }
        $this->to = $historyOrder->to;
        $this->invoice = $historyOrder->invoice;
        $this->amount = $historyOrder->amount;
        $this->id_transaction = $historyOrder->id;
        $this->status = $historyOrder->status;
        $this->showDetail();
        // dd($this->id_transaction);
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
