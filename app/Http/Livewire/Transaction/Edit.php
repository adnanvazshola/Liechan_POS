<?php

namespace App\Http\Livewire\Transaction;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Transaction as TransactionModel;

class Edit extends Component
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

    public function update()
    {
        $this->validate([
            'name'  => 'required',
            'to'    => 'required',
            'amount'=> 'required',
            'type'  => 'required',
            'note'  => 'nullable',
        ]);
        
        $user_id = Auth()->id();

        if ($this->transactionId) {
            $transaction = TransactionModel::find($this->transactionId);

            if ($transaction) {
                $transaction->update([
                    'user_id'   => $user_id, 
                    'name'      => $this->name,
                    'to'        => $this->to,
                    'amount'    => $this->amount,
                    'type'      => $this->type,
                    'note'      => $this->note,
                ]);
            }
        }

        $this->back();
    }

    public function render()
    {
        return view('livewire.transaction.edit');
    }

    public function back()
    {
        return redirect()->route('transaction.index');
    }
}
