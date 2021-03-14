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
        'id_warung',
        'nama_produk',
        'keterangan_produk',
        'harga_produk',
        'stok_produk',
        'gambar_produk'
    ];
    public $timestamps = true;
}
