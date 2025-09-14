<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable {
    use Notifiable;
    protected $fillable = ['name', 'username', 'password', 'telephone', 'level'];
    protected $hidden = ['password', 'remember_token'];

    public function isAdmin() { return $this->level === 'admin'; }
    public function isStaff() { return $this->level === 'staff'; }

    public function responses() {
        return $this->hasMany(Response::class, 'admin_id');
    }
}
