<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_transactions', function (Blueprint $table) {
            $table->uuid("business_id");
            $table->unsignedBigInteger("transaction_id");
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');;
            $table->foreign('transaction_id')->references('id')->on('master_transactions')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_transactions');
    }
}
