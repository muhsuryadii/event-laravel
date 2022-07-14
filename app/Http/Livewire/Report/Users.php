<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;

use Livewire\WithPagination;
use App\Traits\WithDataTable;

class Users extends Component
{
    use WithPagination, WithDataTable;

    public $model;
    public $name;
    public $event;

    public $perPage = 10;
    public $sortField = "nama_user";
    public $sortAsc = true;
    public $search = '';

    protected $listeners = ["deleteItem" => "delete_item"];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $data = $this->get_pagination_data();
        // return view('livewire.show-users');
        return view($data['view'], $data);
    }
}
