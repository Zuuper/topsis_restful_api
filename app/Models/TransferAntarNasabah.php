<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TransferAntarNasabah extends Model
{
    use HasFactory,Notifiable, HasApiTokens;
    protected $table = 'tb_transfer_antar_nasabah';
    protected $primaryKey = 'id_transfer_antar_nasabah';
    protected $fillable = [
        'id_nasabah_pengirim',
        'id_nasabah_penerima',
        'jumlah_transfer',
        'catatan'
    ];
    
    public $timestamps = true;
}
