<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoStat;
use Carbon\Carbon;
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
					$item['created_at'] = date('Y-m-d H:i:s');
					$item['updated_at'] = date('Y-m-d H:i:s');

					return $item;
				});

			if( !empty($stats->toArray()) ){
				VideoStat::insert($stats->toArray());
			}

		} catch (\Exception $e) {
		    Log::error('Location: VideoController storeVideoStats Line: ' . $e->getLine(). ' - Message ' . $e->getMessage());
		}
	}

	public function getVideoStats( Request $request, Video $video ) {

		$graphData = [];

		try {

			$graph = empty($request->graph) ? 0 : $request->graph;
			$columns = [
				[
					'buffer_length',
					'bitrate_downloading',
					'dropped_frames',
				],
				[
					'index_downloading',
					'index_playing',
					'bufferLengthValue',
				],
				[
					'latency',
					'download',
					'ratio'
				]
			];

			$type = $request->has('type') ? $request->type : 'video';
			$columns[$graph][] = 'created_at';
			$stats = $video->stats()->select($columns[$graph])->where('type', $type)->oldest()->get();

			$graphData = [
				$columns[$graph][0] => $stats->map(function ($item) use ($graph, $columns){
					return [Carbon::parse($item->created_at)->format('Y-m-d H:i:s'), (int)$item->{$columns[$graph][0]}];
				}),
				$columns[$graph][1] => $stats->map(function ($item) use ($graph, $columns){
					return [Carbon::parse($item->created_at)->format('Y-m-d H:i:s'), (int)$item->{$columns[$graph][1]}];
				}),
				$columns[$graph][2] => $stats->map(function ($item) use ($graph, $columns){
					return [Carbon::parse($item->created_at)->format('Y-m-d H:i:s'), (int)$item->{$columns[$graph][2]}];
				}),
			];

		} catch (\Exception $e) {
		    Log::error('Location: VideoController storeVideoStats Line: ' . $e->getLine(). ' - Message ' . $e->getMessage());
		}

		return $graphData;
	}
}
