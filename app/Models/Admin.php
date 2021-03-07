<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'tb_admin';
    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'id_fintech',
        'id_tabungan',
        'nama_pemilik',
        'nik_pemilik',
        'alamat_warung',
        'nama_warung',
        'username_warung',
        'password_warung',
        'no_telpon_warung',
        'status',
        'tanggal_aktif'
    ];
    public $timestamps = true;
}
