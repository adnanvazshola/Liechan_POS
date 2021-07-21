<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction as TransactionModel;
use Illuminate\Support\Facades\Log;

class Transaction extends Component
{
    public $transaction, $name, $to, $amount, $type, $method, $note, $id_transaction;
    //Untuk Bagian Detail
    public $detailName, $detailTo, $detailAmount, $detailType, $detailMethod, $detailNote, $detailDate;
    public $detail = 0;
    
    public function render()
    {
        $this->transaction = TransactionModel::latest()->get();

        return view('livewire.transaction');
    }

    public function show($id)
    {
        $transaction = TransactionModel::find($id);

        $this->detailName = $transaction->name;
        $this->detailTo = $transaction->to;
        $this->detailAmount = $transaction->amount;
        $this->detailType = $transaction->type;
        $this->detailMethod = $transaction->method;
        $this->detailNote = $transaction->note;
        $this->detailDate = $transaction->created_at;
        
        $this->openModal();
    }

    public function openModal()
    {
        $this->detail = true;
    }

    public function closeModal()
    {
        $this->detail = false;
    }

    public function resetFields()
    {
        $this->name = '';
        $this->to = '';
        $this->amount = '';
        $this->type = '';
        $this->method = '';
        $this->note = '';
    }

    public function store()
    {
        $this->validate([
            'name'  => 'required',
            'to'    => 'required',
            'amount'=> 'required|numeric',
            'type'  => 'required',
            'method'=> 'required',
            'note'  => 'nullable',
        ]);

        TransactionModel::updateOrCreate(['id' => $this->id_transaction],[
            'name'  => $this->name,
            'to'    => $this->to,
            'amount'=> $this->amount,
            'type'  => $this->type,
            'method'=> $this->method,
            'note'  => $this->note,
        ]);

        session()->flash('message', $this->id_transaction ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->resetFields();
    }

    public function edit($id)
    {
        $transaction = TransactionModel::find($id);

        $this->id_transaction = $transaction->id;
        $this->name = $transaction->name;
        $this->to = $transaction->to;
        $this->amount = $transaction->amount;
        $this->type = $transaction->type;
        $this->method = $transaction->method;
        $this->note = $transaction->note;
    }

    public function delete($id)
    {
        $transaction = TransactionModel::find($id);
        $transaction->delete();
    }
}
