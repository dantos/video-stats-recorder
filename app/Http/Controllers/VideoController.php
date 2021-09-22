<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoStat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class VideoController extends Controller
{
	public function storeVideoStats( Request $request, Video $video ) {

		try {

			$user = Auth::check() ? Auth::user() : User::where('role', 'guest')->first();
			if( empty($user) ){
				throw new Exception('No guest user found.');
			}

			$stats = collect($request->data)
				->filter()
				->transform(function ($item) use ($video, $user) {
					$item['user_id'] = $user->id;
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

			$user = Auth::check() ? Auth::user() : User::where('role', 'guest')->first();
			if( empty($user) ){
				throw new Exception('No guest user found.');
			}

			$score = empty($request->data['score']) || $request->data['score'] < 0  ? 0 : $request->data['score'];

			$rating = Rating::firstOrCreate([
				'user_id' => $user->id,
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

			if( $graph == 0){
				$score = 0;

				if( !is_null($user)  ){
					$rating = Rating::getByUserAndVideo($user->id, $video->id)->first();
					$score = empty($rating) ? $score : $rating->score;

				} else {
					$ratings = Rating::select('score')->where('video_id', $video->id)->get();
					$score = empty($ratings) ? $score : (int)round($ratings->avg('score'));
				}

				$graphData['score'] = $score;
			}

		} catch (\Exception $e) {
		    Log::error('Location: VideoController storeVideoStats Line: ' . $e->getLine(). ' - Message ' . $e->getMessage());
		}

		return $graphData;
	}

	public function index() {
		$videos = Video::orderByDesc('created_at')->get();
		return view('video.index', compact('videos'));
	}

	public function create() {
		return view('video.create');
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'provider' => 'required',
			'url' => 'required|url',
		]);

		//Gets video extension from url and check if is mpd
		if( last(explode('.', last(explode('/', $request->url)))) != 'mpd') {
			throw ValidationException::withMessages(['url' => ['Your video extension is invalid']]);
		}

		try {

			Video::create([
				'name' => $request->name,
				'provider' => $request->provider,
				'url' => $request->url,
			]);

		} catch (\Exception $e) {
			Log::error('Location: VideoController store Line: ' . $e->getLine(). ' - Message ' . $e->getMessage());
		}

		return Redirect::route('videos.index');
	}

	public function edit(Video $video) {
		return view('video.edit', compact('video'));
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function update(Request $request, Video $video)
	{

		$request->validate([
			'name' => 'required|string|max:255',
			'provider' => 'required',
			'url' => 'required|url',
		]);

		//Gets video extension from url and check if is mpd
		if( last(explode('.', last(explode('/', $request->url)))) != 'mpd') {
			throw ValidationException::withMessages(['url' => ['Your video extension is invalid']]);
		}

		try {

			$video->name = $request->name;
			$video->provider = $request->provider;
			$video->url = $request->url;

			$video->save();

		} catch (\Exception $e) {
			Log::error('Location: VideoController update Line: ' . $e->getLine(). ' - Message ' . $e->getMessage());
		}

		return Redirect::route('videos.index');
	}

	public function destroy(Video $video){

		try {

			$video->forceDelete();

		} catch (\Exception $e) {
			Log::error('Location: VideoController destroy Line: ' . $e->getLine(). ' - Message ' . $e->getMessage());
		}

		return Redirect::route('videos.index');
	}
}
