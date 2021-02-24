<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;
    protected $fillabel = [
        'id_fintech',
        'id_membership',
        'nama_nasabah',
        'nik_nasabah',
        'alamat',
        'username_nasabah',
        'password',
        'pin_transaksi',
        'no_rekening',
        'no_telpon',
        'status',
        'tanggal_aktif'
    ];
    protected $table = 'tb_nasabah';
    protected $primaryKey = 'id_nasabah';
    public $timestamps = false;
}
