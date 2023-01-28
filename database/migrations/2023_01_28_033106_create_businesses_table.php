<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->char(36)->primary();
            $table->string('name', 191);
            $table->string('alias', 191)->unique();
            $table->boolean('is_claimed')->default(false);
            $table->boolean('is_closed')->default(false);
            $table->string('phone', 15)->nullable();
            $table->json("address");
            $table->decimal("latitude", 8, 6)->nullable();
            $table->decimal("longitude", 8, 6)->nullable();
            $table->tinyInteger("price")->unsigned();
            $table->json("transactions");
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
        Schema::dropIfExists('businesses');
    }
}
