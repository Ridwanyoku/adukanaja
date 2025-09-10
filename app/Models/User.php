<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nik', 'name', 'username', 'password', 'telephone'];
    protected $hidden = ['password', 'remember_token'];

    public function reports() {
        return $this->hasMany(Report::class, 'user_nik', 'nik');
    }
}

