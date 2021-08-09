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
		Video::insert( [
			[
				'name'     => 'SegmentBase, ondemand profile',
				'url'      => 'https://dash.akamaized.net/dash264/TestCases/1a/sony/SNE_DASH_SD_CASE1A_REVISED.mpd',
				'provider' => 'dashif',
			],
			[
				'name'     => 'SegmentTemplate/Number, live profile, 250kbps up to 15Mbps@4K.',
				'url'      => 'https://dash.akamaized.net/akamai/bbb_30fps/bbb_30fps.mpd',
				'provider' => 'dashif',
			],
			[
				"url"      => "https://dash.akamaized.net/dash264/TestCases/2c/qualcomm/1/MultiResMPEG2.mpd",
				"name"     => "SegmentTemplate/SegmentTimeline time, ondemand profile",
				"provider" => "dashif"
			],
			[
				"url"      => "https://dash.akamaized.net/dash264/TestCases/5a/nomor/1.mpd",
				"name"     => "Multiperiod, 2 periods, SegmentTemplate number",
				"provider" => "dashif"
			],
			[
				"url"      => "https://dash.akamaized.net/envivio/EnvivioDash3/manifest.mpd",
				"name"     => "SegmentTemplate, live profile",
				"provider" => "envivio"
			],
			[
				"url"      => "http://rdmedia.bbc.co.uk/dash/ondemand/testcard/1/client_manifest-events.mpd",
				"name"     => "SegmentTemplate/Number, live profile",
				"provider" => "bbc"
			],
			[
				"name"     => "SegmentTemplate with SegmentTimeline",
				"url"      => "https://demo.unified-streaming.com/video/tears-of-steel/tears-of-steel.ism/.mpd",
				"provider" => "unified"
			],
			[
				"name"     => "1080p without encryption",
				"url"      => "https://media.axprod.net/TestVectors/v7-Clear/Manifest_1080p.mpd",
				"provider" => "axinom"
			],
			[
				"name"     => "2160p without encryption",
				"url"      => "https://media.axprod.net/TestVectors/v7-Clear/Manifest.mpd",
				"provider" => "axinom"
			],
			[
				"name"     => "Multi-period 1080p without encryption",
				"url"      => "https://media.axprod.net/TestVectors/v7-Clear/Manifest_MultiPeriod_1080p.mpd",
				"provider" => "axinom"
			],
			[
				"name"     => "Multi-period 2160p without encryption",
				"url"      => "https://media.axprod.net/TestVectors/v7-Clear/Manifest_MultiPeriod.mpd",
				"provider" => "axinom"
			],
			[
				"name"     => "Complex multi-period with different content, clear",
				"url"      => "https://media.axprod.net/TestVectors/v8-MultiContent/Clear/Manifest.mpd",
				"provider" => "axinom"
			],
			[
				"name"     => "4K SegmentBase",
				"url"      => "https://dash.akamaized.net/akamai/streamroot/050714/Spring_4Ktest.mpd",
				"provider" => "streamroot"
			],
			[
				"name"     => "Caminandes 01, Llama Drama (25fps, 75gop, 1080p)",
				"url"      => "http://refapp.hbbtv.org/videos/01_llama_drama_1080p_25f75g6sv3/manifest.mpd",
				"provider" => "hbbtv"
			],
			[
				"name"     => "Caminandes 02, Gran Dillama (25fps, 75gop, 1080p, KID=1236, subob,evtib) v5",
				"url"      => "http://refapp.hbbtv.org/videos/02_gran_dillama_1080p_25f75g6sv5/manifest_subob_evtib.mpd",
				"provider" => "hbbtv"
			],
			[
				"name"     => "Tears of Steel (25fps, 75gop, 1080p, KID=1237) v3",
				"url"      => "http://refapp.hbbtv.org/videos/tears_of_steel_1080p_25f75g6sv3/manifest.mpd",
				"provider" => "hbbtv"
			],
			[
				"name"     => "Caminandes 02, Gran Dillama (25fps, 75gop, 1080p, KID=1236), multiaudio v4",
				"url"      => "http://refapp.hbbtv.org/videos/02_gran_dillama_1080p_ma_25f75g6sv4/manifest_subob_evtib.mpd",
				"provider" => "hbbtv"
			],
			[
				"name"     => "Caminandes 02, Gran Dillama (25fps, 75gop, 1080p, KID=1236), multiaudio v5",
				"url"      => "http://refapp.hbbtv.org/videos/02_gran_dillama_1080p_ma_25f75g6sv5/manifest.mpd",
				"provider" => "hbbtv"
			],
			[
				"name"     => "Spring (25fps, 75gop, 1920x804(2.40) h264, KID=148D) v1",
				"url"      => "http://refapp.hbbtv.org/videos/spring_804p_v1/manifest.mpd",
				"provider" => "hbbtv"
			],
			[
                    "url" => "https://livesim.dashif.org/livesim/testpic_2s/Manifest.mpd",
                    "name" => "SegmentTemplate without manifest updates (livesim)",
                    "provider" => "dashif"
                ],
            [
                "url" => "https://livesim.dashif.org/livesim/mup_30/testpic_2s/Manifest.mpd",
                "name" => "SegmentTemplate with manifest updates every 30s (livesim)",
                "provider" => "dashif"
            ],
            [
                "url" => "https://livesim.dashif.org/livesim/segtimeline_1/testpic_2s/Manifest.mpd",
                "name" => "SegmentTimeline (livesim)",
                "provider" => "dashif"
            ],
            [
                "url" => "https://livesim.dashif.org/livesim/periods_60/continuous_1/testpic_2s/Manifest.mpd",
                "name" => "Multiperiod SegmentTemplate. New period every minute (livesim)",
                "provider" => "dashif"
            ],
            [
                "url" => " https://livesim.dashif.org/livesim/ato_10/testpic_2s/Manifest.mpd",
                "name" => "10 seconds availabilityTimeOffset (livesim)",
                "provider" => "dashif"
            ],
            [
                "url" => "https://livesim.dashif.org/livesim/ato_inf/testpic_2s/Manifest.mpd",
                "name" => "Infinite offset - all segments available at availability start (livesim)",
                "provider" => "dashif"
            ],
            [
                "url" => "https://livesim.dashif.org/livesim/scte35_2/testpic_2s/Manifest.mpd",
                "name" => "SCTE35 events",
                "provider" => "dashif"
            ],
            [
                "url" => "https://live.unified-streaming.com/scte35/scte35.isml/.mpd",
                "name" => "Unified Streaming reference stream with scte35 markers",
                "provider" => "unified"
            ],
            [
                "name" => "Clear Dynamic SegmentTimeline",
                "url" => "//wowzaec2demo.streamlock.net/live/bigbuckbunny/manifest_mvtime.mpd",
                "provider" => "wowza"
            ],
            [
                "name" => "Clear Dynamic SegmentTemplate",
                "url" => "//wowzaec2demo.streamlock.net/live/bigbuckbunny/manifest_mvnumber.mpd",
                "provider" => "wowza"
            ],
            [
                "name" => "Clear Dynamic SegmentList",
                "url" => "//wowzaec2demo.streamlock.net/live/bigbuckbunny/manifest_mvlist.mpd",
                "provider" => "wowza"
            ],
            [
                "name" => "Multiperiod - Number + Timeline - Compact manifest - Thumbnails (1 track) - In-the-clear",
                "url" => "https://d24rwxnt7vw9qb.cloudfront.net/v1/dash/e6d234965645b411ad572802b6c9d5a10799c9c1/All_Reference_Streams/4577dca5f8a44756875ab5cc913cd1f1/index.mpd",
                "provider" => "aws"
            ],
            [
                "name" => "Multiperiod - Number + Timeline - Full manifest - Thumbnails (1 track) - In-the-clear",
                "url" => "https://d24rwxnt7vw9qb.cloudfront.net/v1/dash/e6d234965645b411ad572802b6c9d5a10799c9c1/All_Reference_Streams/ee565ea510cb4b4d8df5f48918c3d6dc/index.mpd",
                "provider" => "aws"
            ],
            [
                "name" => "Multiperiod - Time + Timeline - Compact manifest - Thumbnails (1 track) - In-the-clear",
                "url" => "https://d24rwxnt7vw9qb.cloudfront.net/v1/dash/e6d234965645b411ad572802b6c9d5a10799c9c1/All_Reference_Streams/91d37b0389de47e0b5266736d3633077/index.mpd",
                "provider" => "aws"
            ],
            [
                "name" => "Multiperiod - Time + Timeline - Full manifest - Thumbnails (1 track) - In-the-clear",
                "url" => "https://d24rwxnt7vw9qb.cloudfront.net/v1/dash/e6d234965645b411ad572802b6c9d5a10799c9c1/All_Reference_Streams/6ba06d17f65b4e1cbd1238eaa05c02c1/index.mpd",
                "provider" => "aws"
            ],
            [
                "name" => "Single period - Number + Duration - Full manifest - Thumbnails (2 tracks: 174p/1080p) - In-the-clear",
                "url" => "https://d10gktn8v7end7.cloudfront.net/out/v1/6ee19df3afa24fe190a8ae16c2c88560/index.mpd",
                "provider" => "aws"
            ],
            [
                "name" => "LiveSIM Caminandes 02, Gran Dillama (25fps, 25gop, 2sec, multi MOOF/MDAT, 1080p, KID=1236) v2",
                "url" => "http://refapp.hbbtv.org/livesim/02_llamav2/manifest.mpd",
                "provider" => "hbbtv"
            ],
			[
				"url" => "https://akamaibroadcasteruseast.akamaized.net/cmaf/live/657078/akasource/out.mpd",
                "name" => "Akamai Low Latency Stream (Single Rate)",
                "provider" => "akamai"
            ],
            [
                "url" => "https://cmafref.akamaized.net/cmaf/live-ull/2006350/akambr/out.mpd",
                "name" => "Akamai Low Latency Stream (Multi Rate)",
                "provider" => "akamai"
            ],
            [
                "url" => "https://livesim.dashif.org/livesim/chunkdur_1/ato_7/testpic4_8s/Manifest300.mpd",
                "name" => "Low Latency (Single-Rate) (livesim-chunked)",
                "provider" => "dashif"
            ],
            [
                "url" => "https://livesim.dashif.org/livesim/chunkdur_1/ato_7/testpic4_8s/Manifest.mpd",
                "name" => "Low Latency (Multi-Rate) (livesim-chunked)",
                "provider" => "dashif"
            ],
			[
				"url" => "https://dash.akamaized.net/akamai/test/caption_test/ElephantsDream/elephants_dream_480p_heaac5_1.mpd",
                "name" => "External VTT subtitle file",
                "provider" => "dashif"
            ],
            [
                "name" => "TTML Segmented Subtitles VoD",
                "url" => "https://livesim.dashif.org/dash/vod/testpic_2s/multi_subs.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "TTML Segmented Subtitles Live (livesim)",
                "url" => "https://livesim.dashif.org/livesim/testpic_2s/multi_subs.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "TTML Sideloaded XML Subtitles",
                "url" => "https://livesim.dashif.org/dash/vod/testpic_2s/xml_subs.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "Embedded CEA-608 Closed Captions",
                "url" => "https://livesim.dashif.org/dash/vod/testpic_2s/cea608.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "Embedded CEA-608 Closed Captions (livesim)",
                "url" => "https://livesim.dashif.org/livesim/testpic_2s/cea608.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "Embedded CEA-608 Closed Captions and TTML segments VoD",
                "url" => "https://livesim.dashif.org/dash/vod/testpic_2s/cea608_and_segs.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "Embedded CEA-608 Closed Captions and TTML segments Live (livesim)",
                "url" => "https://livesim.dashif.org/livesim/testpic_2s/cea608_and_segs.mpd",
                "provider" => "dashif"
            ],
            [
                "url" => "https://livesim.dashif.org/dash/vod/testpic_2s/imsc1_img.mpd",
                "name" => "IMSC1 (CMAF) Image Subtitles",
                "provider" => "dashif"
            ],
            [
                "name" => "TTML Image Subtitles embedded (VoD)",
                "url" => "https://livesim.dashif.org/dash/vod/testpic_2s/img_subs.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "TTML Segmented 'snaking' subtitles (with random text) (Ondemand)",
                "url" => "http://rdmedia.bbc.co.uk/dash/ondemand/elephants_dream/1/client_manifest-snake.mpd",
                "provider" => "bbc"
            ],
            [
                "name" => "BBC R&D EBU-TT-D Subtitling Test",
                "url" => "http://rdmedia.bbc.co.uk/dash/ondemand/elephants_dream/1/client_manifest-all.mpd",
                "provider" => "bbc"
            ],
            [
                "url" => "https://dash.akamaized.net/dash264/CTA/imsc1/IT1-20171027_dash.mpd",
                "name" => "IMSC1 Text Subtitles via sidecar file",
                "provider" => "cta"
            ],
            [
                "url" => "https://pl8q5ug7b6.execute-api.eu-central-1.amazonaws.com/2.mpd",
                "name" => "Subtitles in multi period live",
                "provider" => "unified"
            ],
			[
				"name" => "Multiperiod - Number + Timeline - Compact manifest - Thumbnails (1 track) - Encryption (1 key) PlayReady/Widevine (DRMtoday) - Key rotation (60s)",
                "url" => "https://d24rwxnt7vw9qb.cloudfront.net/v1/dash/e6d234965645b411ad572802b6c9d5a10799c9c1/All_Reference_Streams/2fc23947945841b9b1be9768f9c13e75/index.mpd",
                "provider" => "aws"
            ],
            [
                "name" => "Multiperiod - Number + Timeline - Compact manifest - Thumbnails (1 track) - Encryption (2 keys : audio + video) - No key rotation",
                "url" => "https://d24rwxnt7vw9qb.cloudfront.net/v1/dash/e6d234965645b411ad572802b6c9d5a10799c9c1/All_Reference_Streams//6e16c26536564c2f9dbc5f725a820cff/index.mpd",
                "provider" => "aws"
            ],
            [
                "name" => "Shaka Demo Assets: Angel-One Widevine",
                "url" => "https://storage.googleapis.com/shaka-demo-assets/angel-one-widevine/dash.mpd",
                "provider" => "google"
            ],
            [
                "name" => "1080p with Widevine DRM, license expired after 60s",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-SingleKey/Manifest_1080p.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "1080p with PlayReady and Widevine DRM, single key",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-SingleKey/Manifest_1080p.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "1080p with PlayReady and Widevine DRM, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-MultiKey/Manifest_1080p.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "1080p with W3C Clear Key, single key",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-SingleKey/Manifest_1080p_ClearKey.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "1080p with W3C Clear Key, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-MultiKey/Manifest_1080p_ClearKey.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "2160p with PlayReady and Widevine DRM, single key",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-SingleKey/Manifest.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "2160p with PlayReady and Widevine DRM, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-MultiKey/Manifest.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "2160p with W3C Clear Key, single key",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-SingleKey/Manifest_ClearKey.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "2160p with W3C Clear Key, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-MultiKey/Manifest_ClearKey.mpd",

                "provider" => "axinom"
            ],
            [
                "name" => "Audio with PlayReady and Widevine DRM, single key",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-SingleKey/Manifest_AudioOnly.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Audio with PlayReady and Widevine DRM, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-MultiKey/Manifest_AudioOnly.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Audio with W3C Clear Key, single key",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-SingleKey/Manifest_AudioOnly_ClearKey.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Audio with W3C Clear Key, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-MultiKey/Manifest_AudioOnly_ClearKey.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Multi-period 1080p with PlayReady and Widevine DRM, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-MultiKey-MultiPeriod/Manifest_1080p.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Multi-period 1080p with W3C Clear Key, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-MultiKey-MultiPeriod/Manifest_1080p_ClearKey.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Multi-period 2160p with PlayReady and Widevine DRM, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-MultiKey-MultiPeriod/Manifest.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Multi-period 2160p with W3C Clear Key, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-MultiKey-MultiPeriod/Manifest_ClearKey.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Multi-period audio with PlayReady and Widevine DRM, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-MultiKey-MultiPeriod/Manifest_AudioOnly.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Multi-period audio with W3C Clear Key, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v7-MultiDRM-MultiKey-MultiPeriod/Manifest_AudioOnly_ClearKey.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Complex multi-period with different content, encrypted",
                "url" => "https://media.axprod.net/TestVectors/v8-MultiContent/Encrypted/Manifest.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Microsoft AZURE MEDIA SERVICES ON DEMAND H264 AAC 4K CENC PLAYREADY 2.0",
                "url" => "https://profficialsite.origin.mediaservices.windows.net/c51358ea-9a5e-4322-8951-897d640fdfd7/tearsofsteel_4k.ism/manifest(format=mpd-time-csf)",
                "provider" => "microsoft"
            ],
            [
                "name" => "Microsoft AZURE MEDIA SERVICES ON DEMAND H264 AAC 4K CENC PLAYREADY 2.0 (persistent)",
                "url" => "https://profficialsite.origin.mediaservices.windows.net/c51358ea-9a5e-4322-8951-897d640fdfd7/tearsofsteel_4k.ism/manifest(format=mpd-time-csf)",
                "provider" => "microsoft"
            ],
            [
                "name" => "Source: XBox One commercial video",
                "url" => "https://profficialsite.origin.mediaservices.windows.net/9cc5e871-68ec-42c2-9fc7-fda95521f17d/dayoneplayready.ism/manifest(format=mpd-time-csf)",
                "provider" => "microsoft"
            ],
            [
                "name" => "AZURE MEDIA SERVICES LIVE PLAYREADY 2.0",
                "url" => "https://profficialsite.origin.mediaservices.windows.net/9cc5e871-68ec-42c2-9fc7-fda95521f17d/dayoneplayready.ism/manifest(format=mpd-time-csf)",
                "provider" => "microsoft"
            ],
            [
                "name" => "Unified Streaming (Widevine, persistent)",
                "url" => "//demo.unified-streaming.com/video/tears-of-steel/tears-of-steel-dash-widevine.ism/.mpd",
                "provider" => "unified"
            ],
            [
                "name" => "Live Dash WV and PR with unencrypted ad breaks -- Always starts in encrypted content - Keys never change",
                "url" => "https://content.uplynk.com/playlist/6c526d97954b41deb90fe64328647a71.mpd?ad=bbbads&delay=25",
                "provider" => "vdms"
            ],
            [
                "name" => "Live Dash WV and PR - Starting in unencrypted ad (preroll) - Moving into encrypted content - Keys never change",
                "url" => "https://content.uplynk.com/playlist/4f1a9815a1af43d5ba64465d85bf11cf.mpd?ad=sintelads",
                "provider" => "vdms"
            ],
			[
				"name" => "1080p with PlayReady and Widevine DRM, single key",
                "url" => "https://media.axprod.net/TestVectors/v6.1-MultiDRM/Manifest_1080p.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "1080p with PlayReady and Widevine DRM, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v6.1-MultiDRM-MultiKey/Manifest_1080p.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "2160p with PlayReady and Widevine DRM, single key",
                "url" => "https://media.axprod.net/TestVectors/v6.1-MultiDRM/Manifest.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "2160p with PlayReady and Widevine DRM, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v6.1-MultiDRM-MultiKey/Manifest.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Multi-period 1080p with PlayReady and Widevine DRM, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v6.1-MultiDRM-MultiKey-MultiPeriod/Manifest_1080p.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Multi-period 2160p with PlayReady and Widevine DRM, multiple keys",
                "url" => "https://media.axprod.net/TestVectors/v6.1-MultiDRM-MultiKey-MultiPeriod/Manifest.mpd",
                "provider" => "axinom"
            ],
			[
				"name" => "Single adaption set, 7 tiles at 10x1, each thumb 320x180",
                "url" => "//dash.akamaized.net/akamai/bbb_30fps/bbb_with_tiled_thumbnails.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "Single adaption set, 4 tiles at 10x1, each thumb 205x115",
                "url" => "//dash.akamaized.net/akamai/bbb_30fps/bbb_with_4_tiles_thumbnails.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "Single adaption set, 1 tile at 10x20, each thumb 102x58",
                "url" => "//dash.akamaized.net/akamai/bbb_30fps/bbb_with_tiled_thumbnails_2.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "Two adaption sets with different thumb resolutions",
                "url" => "//dash.akamaized.net/akamai/bbb_30fps/bbb_with_multiple_tiled_thumbnails.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "Live stream, Single adaptation set, 1x1 tiles (livesim)",
                "url" => "//livesim.dashif.org/livesim/testpic_2s/Manifest_thumbs.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "SegmentBase, Single adaption set, 3x4 tiles",
                "url" => "https://demo.unified-streaming.com/video/tears-of-steel/tears-of-steel-tiled-thumbnails-static.mpd",
                "provider" => "unified"
            ],
            [
                "name" => "SegmentTemplate with SegmentTimeline",
                "url" => "https://demo.unified-streaming.com/video/tears-of-steel/tears-of-steel-tiled-thumbnails-timeline.ism/.mpd",
                "provider" => "unified"
            ],
            [
                "name" => "SegmentNumber",
                "url" => "https://demo.unified-streaming.com/video/tears-of-steel/tears-of-steel-tiled-thumbnails-numbered.ism/.mpd",
                "provider" => "unified"
            ],
			[
				"name" => "48k AAC-LC Stereo Beeps (Live)",
                "url" => "https://livesim.dashif.org/livesim/testpic_2s/audio.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "48k AAC-LC Stereo Beeps (Ondemand)",
                "url" => "https://livesim.dashif.org/dash/vod/testpic_2s/audio.mpd",
                "provider" => "dashif"
            ],
            [
                "name" => "128k AAC-LC Stereo 1kHz Tone (Ondemand)",
                "url" => "http://rdmedia.bbc.co.uk/dash/ondemand/testcard/1/client_manifest-audio-1kHz.mpd",
                "provider" => "bbc"
            ],
            [
                "name" => "128k/320k AAC-LC Stereo/5.1 'Testcard' (Ondemand)",
                "url" => "http://rdmedia.bbc.co.uk/dash/ondemand/testcard/1/client_manifest-audio.mpd",
                "provider" => "bbc"
            ],
            [
                "name" => "Audio without encryption",
                "url" => "https://media.axprod.net/TestVectors/v7-Clear/Manifest_AudioOnly.mpd",
                "provider" => "axinom"
            ],
            [
                "name" => "Multi-period audio without encryption",
                "url" => "https://media.axprod.net/TestVectors/v7-Clear/Manifest_MultiPeriod_AudioOnly.mpd",
                "provider" => "axinom"
            ],
			[
				"url" => "http://playready.directtaps.net/smoothstreaming/SSWSS720H264/SuperSpeedway_720.ism/Manifest",
                "name" => "Super Speedway",
                "provider" => "microsoft"
            ],
            [
                "url" => "http://playready.directtaps.net/smoothstreaming/SSWSS720H264PR/SuperSpeedway_720.ism/Manifest",
                "name" => "Super Speedway + PlayReady DRM",
                "provider" => "microsoft"
            ],
            [
                "url" => "http://test.playready.microsoft.com/smoothstreaming/SSWSS720H264PR/SuperSpeedway_720.ism/Manifest",
                "name" => "Super Speedway + PlayReady DRM (persistent)",
                "provider" => "microsoft"
            ]
		

		] );
	}
}
