<?php

namespace App\Http\Livewire;

use App\Event;
use App\Models\Event as ModelsEvent;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class EventsTable extends LivewireDatatable
{
    public $model = ModelsEvent::class;

    public function columns()
    {
        return [
            /* Index Row */
            Column::index($this)->label('No'),

            Column::name('nama_event')
                ->label('Nama'),

            Column::callback(['harga_tiket'], function ($harga_tiket) {
                $price = number_format($harga_tiket);

                return 'Rp.' . $price;
            }),


            DateColumn::name('tanggal_acara')
                ->label('Tanggal'),





        ];
    }

    public function cellClasses($row, $column)
    {
        return 'px-4';
    }
}
