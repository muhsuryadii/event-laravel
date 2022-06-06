<?php

namespace App\Http\Livewire\Admin\Event;

use Livewire\Component;

class Show extends Component
{
    public $sortBy = '';
    public $sortDirection = 'asc';

    public function render()
    {
        return view('livewire.admin.event.show');
    }
}
