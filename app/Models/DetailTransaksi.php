<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'tb_detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';
    protected $fillable = [
        'id_transaksi',
        'id_nasabah',
        'id_warung',
        'jumlah_transaksi',
        'catatan'
    ];
    public $timestamps = true;
}
