<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Tamu extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'tamu';
    protected $primaryKey = 'id_tamu';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id_tamu',
        'nama',
        'email',
        'alamat',
        'no_telpon',
        'email_verified_at',
        'remember_token',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function kedatanganTamu()
    {
        return $this->hasMany(KedatanganTamu::class, 'id_tamu', 'id_tamu');
    }
}
