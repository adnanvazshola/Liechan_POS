<?php

namespace App\Http\Livewire\Transaction;

use Livewire\Component;
use App\Models\Transaction as TransactionModel;

class Detail extends Component
{
    public $transactionId, $invoice, $user_id, $name, $to, $amount, $type, $note;

    public function mount($id)
    {
        $transaction = TransactionModel::find($id);

        if($transaction){
            $this->transactionId = $transaction->id;
            $this->invoice = $transaction->invoice;
            $this->user_id  = $transaction->user_id;
            $this->name = $transaction->name;
            $this->to = $transaction->to;
            $this->amount = $transaction->amount;
            $this->type = $transaction->type;
            $this->note = $transaction->note;
        }
    }

    public function render()
    {
        return view('livewire.transaction.detail');
    }

    public function back()
    {
        return redirect()->route('transaction.index');
    }
}
