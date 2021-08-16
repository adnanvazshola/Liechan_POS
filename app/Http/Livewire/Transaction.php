<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction as TransactionModel;
use Carbon\Carbon;
use Livewire\WithPagination;

class Transaction extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $transaction, $name, $to, $amount, $type, $method, $note, $invoice;
    
    public function render()
    {
        //Mengambil data hari ini
        $today = Carbon::now();
        $bulan = $today->month;
        $hari = $today->day;
        
        $transactions = TransactionModel::orderBy('created_at', 'DESC')->where('type', '!=', 3)->paginate(10);
        $pendapatanKotor = TransactionModel::whereIn('type', [1,3])->whereMonth('created_at', $bulan)->sum('amount');
        $pengeluaran = TransactionModel::where('type', 0)->whereMonth('created_at', $bulan)->sum('amount');
        $pesanan = TransactionModel::where('type', 3)->whereDay('created_at',$hari)->count();
        $pendapatanPos = TransactionModel::where('type', 3)->where('status',1)->whereDay('created_at', $hari)->sum('amount');
        return view('livewire.transaction', [
            'transactions'      => $transactions,
            'pendapatanKotor'   => $pendapatanKotor,
            'pengeluaran'       => $pengeluaran,
            'pesanan'           => $pesanan,
            'pendapatanToday'   => $pendapatanPos, 
            'today'             => $today,
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
