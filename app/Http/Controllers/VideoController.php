<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\User;
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

	public function setVideoRating( Request $request, Video $video ) {

		try {

			$userId = Auth::check() ? Auth::user()->id : 2;
			$score = empty($request->data['score']) ? 0 : $request->data['score'];

			$rating = Rating::firstOrCreate([
				'user_id' => $userId,
				'video_id' => $video->id,
			]);

			$rating->score = $score;
			$rating->save();

			return response()->json(['success' => 'success'], 200);

		} catch (\Exception $e) {
			return response()->json(['error' => 'error'], 500);
			Log::error('Location: VideoController setVideoRating Line: ' . $e->getLine(). ' - Message ' . $e->getMessage());
		}
	}

	public function getVideoStats( Request $request, Video $video, User $user = NULL) {

		$graphData = [];

		try {

			$graph = empty($request->data['graph']) ? 0 : $request->data['graph'];
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

			$type = empty($request->data['type']) ? 'video' : $request->data['type'];
			$columns[$graph][] = 'time';
			$stats = $video->stats()->select($columns[$graph])->where('type', $type);

			if( !is_null($user) ){
				$stats->where('user_id', $user->id);
			}

			$stats = $stats->oldest('time')->get();

			$graphData = [
				$columns[$graph][0] => $stats->map(function ($item) use ($graph, $columns){
					return [number_format($item->time), (float)($item->{$columns[$graph][0]})];
				}),
				$columns[$graph][1] => $stats->map(function ($item) use ($graph, $columns){
					return [number_format($item->time), (float)($item->{$columns[$graph][1]})];
				}),
				$columns[$graph][2] => $stats->map(function ($item) use ($graph, $columns){
					return [number_format($item->time), (float)($item->{$columns[$graph][2]})];
				}),
			];

		} catch (\Exception $e) {
		    Log::error('Location: VideoController storeVideoStats Line: ' . $e->getLine(). ' - Message ' . $e->getMessage());
		}

		return $graphData;
	}
}
