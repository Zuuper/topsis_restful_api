<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferSaldoKeRekening extends Model
{
    use HasFactory;
    protected $table = 'tb_transfer_saldo_ke_rekening';
    protected $primaryKey = 'id_transfer_saldo_ke_rekening';
    protected $fillable = [
        'id_warung',
        'tgl_transaksi'
    ];
    public $timestamps = true;
}
