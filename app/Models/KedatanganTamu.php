<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class KedatanganTamu extends Model
{
    use HasFactory;

    protected $table = 'kedatangan_tamu';
    protected $primaryKey = 'id_kedatangan';
    public $incrementing = false;

    protected $fillable = [
        'id_kedatangan',
        'NIP',
        'id_tamu',
        'id_user',
        'qr_code',
        'instansi',
        'tujuan',
        'waktu_perjanjian',
        'foto',
        'waktu_kedatangan',
        'status',
        'token'
    ];

    public static function generateToken()
    {
        return \Illuminate\Support\Str::random(32); // Generate random string 32 karakter
    }

    public function tamu()
    {
        return $this->belongsTo(Tamu::class, 'id_tamu', 'id_tamu');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
