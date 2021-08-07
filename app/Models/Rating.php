<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use HasFactory;
    use SoftDeletes;

	protected $guarded = ['id'];

	public function scopeGetByUserAndVideo( $query, $userId, $videoId ) {
		$query->where('user_id', $userId)
		      ->where('video_id', $videoId);
	}

}
