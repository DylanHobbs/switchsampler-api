<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keyboard_id');
            $table->string('display_name');
            $table->string('country');
            $table->date('date_recieved');
            $table->float('shipping_cost');
            $table->text('note');
            $table->string('currency');
            $table->timestamps();

            $table->foreign('keyboard_id')->references('id')->on('keyboards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
