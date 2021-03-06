<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTopUp extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_topup';
    protected $primaryKey = 'id_detail_topup';
    protected $fillable = [
        'id_topup',
        'id_fintech',
        'id_dompet',
        'jumlah_transaksi',
        'no_rekening',
        'status'
    ];
    public $timestamps = true;

}
