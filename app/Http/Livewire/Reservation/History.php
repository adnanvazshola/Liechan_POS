<?php

namespace App\Http\Livewire\Reservation;

use Livewire\Component;
use App\Models\Reservation as ReservationModel;
use Livewire\WithPagination;
use Carbon\Carbon;

class History extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $today = Carbon::now()->format('Y-m-d');
        $reservations = ReservationModel::where('date','<',$today)->orderBy('date', 'ASC')->orderby('time', 'asc')->paginate(10);
        return view('livewire.reservation.history', [
            'reservations'  => $reservations,
        ]);
    }

    public function back()
    {
        return redirect()->route('reservation.index');
    }

    public function detail($id)
    {
        $reservation = ReservationModel::find($id);
        return redirect()->route('reservation.detail',$reservation->id);
    }

    public function destroy($id)
    {
        $reservation = ReservationModel::find($id);
        $reservation->delete();
    }
}
