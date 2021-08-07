<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

	public function stats(): \Illuminate\Database\Eloquent\Relations\HasMany {
		return $this->hasMany(VideoStat::class);
    }

	public function ratings(): \Illuminate\Database\Eloquent\Relations\HasMany {
		return $this->hasMany(Rating::class);
    }
}
