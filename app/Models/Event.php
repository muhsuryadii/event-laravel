<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_event'
            ]
        ];
    }

    public function panitia()
    {
        return $this->belongsTo(Panitia::class, 'id_panitia');
    }
}
