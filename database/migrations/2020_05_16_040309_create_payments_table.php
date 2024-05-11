<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->double('amount')->nullable();
            $table->double('last_amount')->nullable();
            $table->double('last_image')->nullable();
            $table->double('amount_added')->nullable();

            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->tinyInteger('status')->default(0);

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
        Schema::dropIfExists('payments');
    }
}
