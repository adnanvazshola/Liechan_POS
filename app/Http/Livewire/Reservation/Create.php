<?php

namespace App\Http\Livewire\Reservation;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Reservation as ReservationModel;

class Create extends Component
{
    public $invoice, $type, $name, $telephone, $date, $time, $downpayment, $note, $status;

    public function render()
    {
        return view('livewire.reservation.create');
    }

    public function store()
    {
        $this->validate([
            'name'      => 'required',
            'type'      => 'required',
            'telephone' => 'nullable',
            'date'      => 'required',
            'time'      => 'required',
            'downpayment'  => 'nullable',
            'note'      => 'nullable',
            'status'    => 'required',
        ]);

        $invoice = 'ENV'.Str::random(7);
        ReservationModel::create([
            'invoice'   => $invoice,
            'name'      => $this->name,
            'type'      => $this->type,
            'telephone' => $this->telephone,
            'date'      => $this->date,
            'time'      => $this->time,
            'downpayment'=> $this->downpayment,
            'note'      => $this->note,
            'status'    => $this->status,
        ]);

        $this->back();
    }

    public function back()
    {
        return redirect()->route('reservation.index');
    }
}
