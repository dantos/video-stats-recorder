<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id')->constrained();
            $table->foreignId('user_id')->constrained();
	        $table->string('time')->nullable();
	        $table->string('buffer_length')->nullable();
	        $table->string('bitrate_downloading')->nullable();
	        $table->string('index_downloading')->nullable();
	        $table->string('index_playing')->nullable();
	        $table->string('dropped_frames')->nullable();
	        $table->string('bufferLengthValue')->nullable();
	        $table->string('latency')->nullable();
	        $table->string('download')->nullable();
	        $table->string('ratio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_stats');
    }
}
