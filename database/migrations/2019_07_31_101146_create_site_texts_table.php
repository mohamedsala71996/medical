<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_texts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('link')->nullable();
            $table->string('key_word')->nullable();
            $table->enum('type', ['client', 'company']);
            $table->string('lang')->nullable();
            $table->text('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();

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
        Schema::dropIfExists('site_texts');
    }
}
