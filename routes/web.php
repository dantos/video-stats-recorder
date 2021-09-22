<?php

	use App\Http\Controllers\UserController;
	use App\Http\Controllers\VideoController;
	use App\Models\User;
	use App\Models\Video;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Redirect;
	use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$videos = Video::all();
    return view('home', compact('videos'));
})->name('home');

Route::get('/dashboard', function () {

	if( Auth::user()->role !== 'admin' ){
		return Redirect::route('home');
	}

	$videos = Video::whereHas('stats')->get()->all();
	$users = User::whereHas('videoStats')->get()->pluck('name', 'id');

    return view('dashboard', compact('videos', 'users'));

})->middleware('auth')->name('dashboard');

Route::post('video/{video}/stats', [VideoController::class, 'storeVideoStats'])->name('video.stats.store');
Route::get('video/{video}/stats/{user?}', [VideoController::class, 'getVideoStats'])->name('video.stats.get');
Route::post('video/{video}/rate', [VideoController::class, 'setVideoRating'])->name('video.rate');
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('videos', VideoController::class)->middleware('auth');

require __DIR__.'/auth.php';
