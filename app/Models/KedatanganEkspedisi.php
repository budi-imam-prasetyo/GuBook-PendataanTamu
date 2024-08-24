<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KedatanganEkspedisi extends Model
{
    protected $table = 'kedatangan_ekspedisi';
    protected $primaryKey = 'id_kedatangan';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_kedatangan',
        'id_ekspedisi',
        'NIP',
        'id_user',
        'foto',
        'waktu_kedatangan',
    ];

    public function ekspedisi()
    {
        return $this->belongsTo(Ekspedisi::class, 'id_ekspedisi', 'id_ekspedisi');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'NIP', 'NIP');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
