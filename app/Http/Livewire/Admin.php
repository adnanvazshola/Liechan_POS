<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation as ReservationModel;
use App\Models\Product as ProductModel;
use App\Models\Transaction as TransactionModel;
use Carbon\Carbon;

class Admin extends Component
{
    public $month = [];

    public function mount()
    {
        $this->month = collect(range(1,12))->map(function($item){
            return $item;
            // return Carbon::createFromFormat('F', $item);
        });
    }

    public function render()
    {
        $today = Carbon::today();
        $date = $today->format('Y-m-d');
        
        $pendapatanKotor = TransactionModel::whereIn('type', [1,3])->whereMonth('created_at', $today->format('m'))->sum('amount');
        $pengeluaran = TransactionModel::where('type', 0)->whereMonth('created_at', $today->format('m'))->sum('amount');
        $pendapatanBersih = $pendapatanKotor-$pengeluaran;
        
        //BULAN KEMARIN
        $pendapatanKotorLalu = TransactionModel::whereIn('type', [1,3])->whereMonth('created_at', $today->format('m')-1)->sum('amount');
        $pengeluaranLalu = TransactionModel::where('type', 0)->whereMonth('created_at', $today->format('m')-1)->sum('amount');
        $pendapatanBersihLalu = $pendapatanKotorLalu-$pengeluaranLalu;

        $persentasePendapatan = ($pendapatanBersih-$pendapatanBersihLalu)/$pendapatanBersihLalu*100;
        $reservations = ReservationModel::where('date',$date)->orderBy('date', 'desc')->orderBy('time', 'asc')->get();
        $emptyMenu = ProductModel::where('status',0)->orderBy('name','asc')->get();
        return view('livewire.admin', [
            'reservations'  => $reservations,
            'menu'          => $emptyMenu,
            'today'         => $today,
            'pendapatan'    => $pendapatanBersih,
            'persentase'    => $persentasePendapatan
        ]);
    }

    public function changeStatus($id)
    {
        $product = ProductModel::find($id);
        $product->update([
            'status' => 1
        ]);
    }

    public function detail($id)
    {
        $reservation = ReservationModel::find($id);
        return redirect()->route('reservation.detail', $reservation->id);
    }
}
