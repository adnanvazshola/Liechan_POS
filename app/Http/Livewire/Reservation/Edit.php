<?php

namespace App\Http\Livewire\Reservation;

use Livewire\Component;
use App\Models\Reservation as ReservationModel;

class Edit extends Component
{
    public $reservation_id, $invoice, $type, $name, $telephone, $date, $time, $downpayment, $note, $status;

    public function mount($id)
    {
        $reservation = ReservationModel::find($id);

        if ($reservation) {
            $this->reservation_id = $reservation->id;
            $this->invoice = $reservation->invoice;
            $this->type = $reservation->type;
            $this->name = $reservation->name;
            $this->telephone = $reservation->telephone;
            $this->date = $reservation->date;
            $this->time = $reservation->time;
            $this->downpayment = $reservation->downpayment;
            $this->note = $reservation->note;
            $this->status = $reservation->status;
        }
    }

    public function update()
    {
        $this->validate([
            'type'  => 'required',
            'name'  => 'required',
            'telephone' => 'nullable|numeric',
            'date'  => 'required',
            'time'  => 'required',
            'downpayment' => 'nullable|numeric',
            'note'  => 'nullable',
            'status'=> 'required',
        ]);

        if ($this->reservation_id) {
            $reservation = ReservationModel::find($this->reservation_id);

            if ($reservation) {
                $reservation->update([
                    'type'  => $this->type,
                    'name'  => $this->name,
                    'telephone' => $this->telephone,
                    'date'  => $this->date,
                    'time'  => $this->time,
                    'downpayment'   => $this->downpayment,
                    'note'  => $this->note,
                    'status'=> $this->status,
                ]);
            }
        }

        $this->back();
    }

    public function render()
    {
        return view('livewire.reservation.edit');
    }

    public function back()
    {
        return redirect()->route('reservation.index');
    }
}
