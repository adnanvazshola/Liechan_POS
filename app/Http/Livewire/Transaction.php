<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction as TransactionModel;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;

class Transaction extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $transaction, $name, $to, $amount, $type, $method, $note, $invoice;
    
    public function render()
    {
        $transactions = TransactionModel::orderBy('created_at', 'DESC')->where('type', '!=', 3)->paginate(8);
        return view('livewire.transaction', [
            'transactions' => $transactions,
        ]);
    }

    public function create()
    {
        return redirect()->route('transaction.create');
    }

    public function edit($id)
    {
        $transaction = TransactionModel::find($id);

        return redirect()->route('transaction.edit', $transaction->id);
    }

    public function delete($id)
    {
        $transaction = TransactionModel::find($id);
        $transaction->delete();
    }

    public function detail($id)
    {
        $transaction = TransactionModel::find($id);

        return redirect()->route('transaction.detail', $transaction->id);
    }
}
