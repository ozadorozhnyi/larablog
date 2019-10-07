<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_id');
            $table->string('path', 128)->comment('path, where file is physically stored');
            $table->string('name_original', 255)->comment('for the human eyes');
            $table->char('name_hash', 40)->comment('gen. and used by the app only');
            $table->string('extension', 10);
            $table->unsignedBigInteger('bytes')->comment('size, for the stats in future...');
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
        Schema::dropIfExists('post_uploads');
    }
}
