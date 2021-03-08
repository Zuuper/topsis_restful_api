<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warung extends Model
{
    use HasFactory;
    protected $table = 'tb_warung';
    protected $primaryKey = 'id_warung';
    protected $fillable = [
        'id_fintech',
        'id_dompet',
        'nama_pemilik',
        'nik_pemilik',
        'alamat_warung',
        'nama_warung',
        'username_warung',
        'password_warung',
        'no_rekening_warung',
        'no_telpon_warung',
        'status',
        'tanggal_aktif'
    ];
    
    public $timestamps = true;
}
