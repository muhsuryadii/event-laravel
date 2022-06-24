<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'no_transaksi';
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event');
    }

    public function panitia()
    {
        return $this->belongsTo(User::class, 'id_panitia');
    }



    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
