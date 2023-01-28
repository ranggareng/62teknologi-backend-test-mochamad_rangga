<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_to_categories', function (Blueprint $table) {
            $table->char("business_id", 36);
            $table->unsignedInteger("category_id");

            $table->foreign('business_id')->references('id')->on('businesses');
            $table->foreign('category_id')->references('id')->on('business_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_to_categories');
    }
}
