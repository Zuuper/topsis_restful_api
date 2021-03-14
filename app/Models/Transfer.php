<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Warung extends Model
{
    use HasFactory,Notifiable, HasApiTokens;
    protected $table = 'tb_transfer';
    protected $primaryKey = 'id_transfer';
    protected $fillable = [
        'id_nasabah',
        'id_nasabah_penerima',
        'jumlah_transfer',
        'catatan'
    ];
    
    public $timestamps = true;
}
