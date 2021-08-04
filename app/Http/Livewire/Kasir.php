<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation as ReservationModel;
use App\Models\Product as ProductModel;
use Carbon\Carbon;

class Kasir extends Component
{
    public function render()
    {
        $today = Carbon::today();
        $date = $today->format('Y-m-d');
        
        $reservations = ReservationModel::where('date',$date)->orderBy('date', 'desc')->orderBy('time', 'asc')->get();
        $emptyMenu = ProductModel::where('status',0)->orderBy('name','asc')->get();
        return view('livewire.kasir', [
            'reservations'  => $reservations,
            'menu'          => $emptyMenu,
            'today'         => $today,
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
