<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nama_user', 'like', '%' . $query . '%');
    }

    public static function getReportUser($eventId)
    {
        return static::join('transaksis', 'laporans.id_transaksi', '=', 'transaksis.id')
            ->join('users', 'transaksis.id_peserta', '=', 'users.id')
            ->join('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $eventId)
            ->select('users.nama_user', 'pesertas.*', 'laporans.*');
    }
}
