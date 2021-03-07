<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;
    protected $table = 'tb_tabungan';
    protected $primaryKey = 'id_tabungan';
    protected $fillable = [
        'no_rekening',
        'id_fintech',
        'saldo',
        'status'
    ];
    public $timestamps = true;
}
