<?php

namespace App\Http\Livewire;

use App\Event;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UsersTable extends LivewireDatatable
{
    public $model = Event::class;

    public function columns()
    {
        //
    }
}