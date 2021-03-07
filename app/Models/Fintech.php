<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fintech extends Model
{
    use HasFactory;
    protected $table = 'tb_fintech';
    protected $primaryKey = 'id_fintech';
    protected $fillable = [
        'nama',
        'alamat',
        'no_telpon',
        'status'
    ];
    public $timestamps = true;
    public function fintech_membership()
    {
        return $this->hasMany(Fintech::class, 'id_membership');
    }
}
