<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation as ReservationModel;

class Reservation extends Component
{   
    public function render()
    {
        $reservations = ReservationModel::orderBy('date', 'ASC')->orderby('time', 'asc')->get();
        return view('livewire.reservation', [
            'reservations'  => $reservations,
        ]);
    }

    public function create()
    {
        return redirect()->route('reservation.create');
    }

    public function edit($id)
    {
        $reservation = ReservationModel::find($id);
        return redirect()->route('reservation.edit', $reservation->id);
    }

    public function detail($id)
    {
        $reservation = ReservationModel::find($id);
        return redirect()->route('reservation.detail', $reservation->id);
    }

    public function destroy($id)
    {
        $reservation = ReservationModel::find($id);
        $reservation->delete();
    }
}
