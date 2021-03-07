<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'tb_produk';
    protected $primaryKey = 'id_produk';
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
