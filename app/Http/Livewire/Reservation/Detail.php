<?php

namespace App\Http\Livewire\Reservation;

use Livewire\Component;
use App\Models\Reservation as ReservationEditModel;

class Detail extends Component
{
    public $reservationId, $invoice, $type, $name, $telephone, $date, $time, $downpayment, $note, $status;

    public function mount($id)
    {
        $reservation = ReservationEditModel::find($id);

        if($reservation){
            $this->reservationId= $reservation->id;
            $this->invoice  = $reservation->invoice;
            $this->type     = $reservation->type;
            $this->name     = $reservation->name;
            $this->telephone= $reservation->telephone;
            $this->date     = $reservation->date;
            $this->time     = $reservation->time;
            $this->downpayment  = $reservation->downpayment;
            $this->note     = $reservation->note;
            $this->status   = $reservation->status;
        }
    }

    public function render()
    {
        return view('livewire.reservation.detail');
    }

    public function back()
    {
        return redirect()->route('reservation.index');
    }
}
