<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'tb_promo';
    protected $primaryKey = 'id_promo';
    protected $fillable = [
        'id_warung',
        'nama_produk',
        'keterangan_produk',
        'harga_produk',
        'stok_produk',
        'gambar_promo'
    ];
    public $timestamps = true;
}
