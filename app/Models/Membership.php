<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $table = 'tb_membership';
    protected $primaryKey = 'id_membership';
    protected $fillable = [
        'id_fintech',
        'kategori',
        'limit'
    ];
    public $timestamps = false;
    public function membership()
    {
        return $this->belongsTo(Fintech::class, 'id_fintech','id_fintech');
    }
}
