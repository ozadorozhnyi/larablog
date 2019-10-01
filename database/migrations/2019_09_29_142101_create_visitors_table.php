<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("raw", 200)->comment("user agent full string");
            $table->string("browser", 64)->comment("browser name: Chrome, IE, Safari, Firefox");
            $table->string("version", 64)->comment("browser version (not the same platform version");
            $table->string("device", 64)->comment("device name, if mobile: iPhone, Nexus, AsusTablet...");
            $table->string("platform", 64)->comment("operating system: Ubuntu, Windows, OS X...");
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
        Schema::dropIfExists('visitors');
    }
}
