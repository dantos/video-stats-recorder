<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Video::insert([[
		    'name' => 'SegmentBase, ondemand profile',
		    'url' => 'https://dash.akamaized.net/dash264/TestCases/1a/sony/SNE_DASH_SD_CASE1A_REVISED.mpd',
		    'provider' => 'Dash-if',
	    ],[
		    'name' => 'SegmentTemplate/Number, live profile, 250kbps up to 15Mbps@4K.',
		    'url' => 'https://dash.akamaized.net/akamai/bbb_30fps/bbb_30fps.mpd',
		    'provider' => 'Dash-if',
	    ]]);
    }
}
