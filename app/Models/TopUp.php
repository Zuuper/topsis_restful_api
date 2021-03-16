<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopUp extends Model
{
    use HasFactory;
    protected $table = 'tb_topup';
    protected $primaryKey = 'id_topup';
    protected $fillable = [
        'id_nasabah',
        'tgl_transaksi'
    ];
    public $timestamps = false;
}
