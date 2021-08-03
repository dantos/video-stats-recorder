<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoStat extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

	public function video() {
		return $this->belongsTo(Video::class);
    }

	public function user() {
		return $this->belongsTo(User::class);
    }
}
