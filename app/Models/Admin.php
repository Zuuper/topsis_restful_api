<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasFactory,Notifiable, HasApiTokens;
    protected $table = 'tb_admin';
    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'id_fintech',
        'nama_admin',
        'nik_admin',
        'alamat_admin',
        'username_admin',
        'password_admin',
        'tipe_admin',
        'status_admin'
    ];
    public $timestamps = true;

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
