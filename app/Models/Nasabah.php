<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;
    protected $table = 'tb_nasabah';
    protected $primaryKey = 'id_nasabah';
    protected $fillable = [
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
        // ganti jadi tanggal_aktif,soalnya di migration ada typo
    ];
    public $timestamps = true;
}
