<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessOperationalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_operationals', function (Blueprint $table) {
            $table->id();
            $table->char("business_id", 36);
            $table->tinyInteger('day');
            $table->char("start", 4);
            $table->char("end", 4);
            $table->boolean("is_overnight")->default(false);
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
        Schema::dropIfExists('business_operationals');
    }
}
