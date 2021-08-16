<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation as ReservationModel;
use Livewire\WithPagination;
use Carbon\Carbon;

class Reservation extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $today = Carbon::now()->format('Y-m-d');
        // dd($today);
        $reservations = ReservationModel::where('date','>=',$today)->orderBy('date', 'ASC')->orderby('time', 'asc')->paginate(10);
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

    public function history()
    {
        return redirect()->route('reservation.history');
    }
}
