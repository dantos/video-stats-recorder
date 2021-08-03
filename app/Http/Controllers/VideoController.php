<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VideoController extends Controller
{
	public function storeVideoStats( Request $request, Video $video ) {

		try {

			$stats = collect($request->data)
				->filter()
				->transform(function ($item) use ($video) {
					$item['user_id'] = Auth::check() ? Auth::user()->id : 2;
					$item['video_id'] = $video->id;
					return $item;
				});

			if( !empty($stats->toArray()) ){
				VideoStat::insert($stats->toArray());
			}

		} catch (\Exception $e) {
		    Log::error('Location: VideoController storeVideoStats Line: ' . $e->getLine(). ' - Message ' . $e->getMessage());
		}
	}
}
