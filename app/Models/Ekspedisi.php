<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    protected $table = 'ekspedisi';
    protected $primaryKey = 'id_ekspedisi';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_ekspedisi',
        'nama_kurir',
        'ekspedisi',
        'no_telpon',
    ];

    public function kedatanganEkspedisi()
    {
        return $this->hasMany(KedatanganEkspedisi::class, 'id_ekspedisi', 'id_ekspedisi');
    }
}
