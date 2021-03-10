<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Nasabah extends Model
{
    use HasFactory,Notifiable, HasApiTokens;
    protected $table = 'tb_nasabah';
    protected $primaryKey = 'id_nasabah';
    protected $fillable = [
        'id_fintech',
        'id_membership',
        'id_dompet',
        'nama_nasabah',
        'nik_nasabah',
        'alamat_nasabah',
        'username_nasabah',
        'password_nasabah',
        'pin_transaksi_nasabah',
        'no_rekening_nasabah',
        'no_telpon_nasabah',
        'status_nasabah',
        'tanggal_aktif_nasabah'
        // ganti jadi tanggal_aktif,soalnya di migration ada typo
    ];
    public $timestamps = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password_admin',
        'remember_token',
    ];
}
