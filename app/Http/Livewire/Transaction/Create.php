<?php

namespace App\Http\Livewire\Transaction;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Transaction as TransactionModel;

class Create extends Component
{
    
    public $name, $to, $amount, $type, $method, $note;

    public function store()
    {
        $this->validate([
            'name'  => 'required',
            'to'    => 'required',
            'amount'=> 'required|numeric',
            'type'  => 'required',
            'note'  => 'nullable',
        ]);

        $user_id = Auth()->id();
        $invoice = 'ENV'.Str::random(7);
        TransactionModel::create([
            'invoice'   => $invoice,
            'user_id'   => $user_id,
            'name'      => $this->name,
            'to'        => $this->to,
            'amount'    => $this->amount,
            'type'      => $this->type,
            'note'      => $this->note,
        ]);

        $this->back();
    }

    public function render()
    {
        return view('livewire.transaction.create');
    }

    public function back()
    {
        return redirect()->route('transaction.index');
    }
}
