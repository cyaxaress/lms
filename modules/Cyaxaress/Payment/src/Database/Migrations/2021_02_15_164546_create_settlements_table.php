<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->string("transaction_id", 30)->nullable();
            $table->json("from")->nullable();
            $table->json("to")->nullable();
            $table->timestamp("settled_at")->nullable();
            $table
                ->enum("status", \Cyaxaress\Payment\Models\Settlement::$statues)
                ->default(\Cyaxaress\Payment\Models\Settlement::STATUS_PENDING);
            $table->float("amount")->unsigned();
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
        Schema::dropIfExists('settlements');
    }
}
