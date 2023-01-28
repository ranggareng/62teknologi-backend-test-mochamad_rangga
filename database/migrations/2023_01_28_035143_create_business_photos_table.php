<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_photos', function (Blueprint $table) {
            $table->id();
            $table->char("business_id", 36);
            $table->string("file_path");
            $table->boolean("is_thumbnail")->default(false);
            $table->timestamps();

            $table->foreign('business_id')->references('id')->on('businesses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_photos');
    }
}
