<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Response extends Model {
    protected $fillable = ['report_id', 'admin_id', 'date', 'response_content'];

    public function report() {
        return $this->belongsTo(Report::class, 'report_id');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}