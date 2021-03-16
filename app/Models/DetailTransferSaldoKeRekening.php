<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransferSaldoKeRekening extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_transfer_saldo_ke_rekening';
    protected $primaryKey = 'id_detail_transfer_saldo_ke_rekening';
    protected $fillable = [
        'id_fintech',
        'id_transfer_ke_rekening',
        'id_dompet',
        'jumlah_transaksi',
        'no_rekening',
        'status'
    ];
    public $timestamps = true;
}
