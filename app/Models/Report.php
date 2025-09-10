<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Report extends Model {
    protected $fillable = ['user_nik', 'date', 'content', 'image', 'status'];

    public function user() {
        return $this->belongsTo(User::class, 'user_nik', 'nik');
    }

    public function responses() {
        return $this->hasMany(Response::class, 'report_id');
    }
}