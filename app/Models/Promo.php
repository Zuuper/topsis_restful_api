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
        'tanggal_mulai',
        'tanggal_berakhir',
        'diskon',
        'keterangan',
        'gambar_promo',
        'status'
    ];
    public $timestamps = true;
}
