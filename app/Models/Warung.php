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
        'nama_pemilik',
        'nik_pemilik',
        'alamat',
        'nama_warung',
        'username_warung',
        'password',
        'no_rekening',
        'no_telpon',
        'status',
        'tanggal_aktif'
    ];
    
    public $timestamps = false;
}
