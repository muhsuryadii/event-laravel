<?php


namespace App\Traits;

trait WithDataTable
{

    public function get_pagination_data()
    {
        switch ($this->name) {
            case 'report_user':
                $users = $this->model::getReportUser($this->event)
                    ->where($this->sortField, 'like', '%' . $this->search . '%')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
                return [
                    "view" => 'livewire.admin.table.users',
                    "users" => $users,

                ];
                break;

            default:
                # code...
                break;
        }
    }
}
