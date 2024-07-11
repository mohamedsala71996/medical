<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone_code')->default('0020');
            $table->string('phone')->nullable()->unique();
            $table->enum('is_busy',['busy','not_busy'])->default('not_busy');
            $table->enum('status', ['active', 'inactive', 'critical'])->default('active');
            $table->double('balance')->default(0);
            $table->double('rating')->default(0);
            $table->string('logo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->integer('is_blocked')->default(0);//1- blocked / 0- not block
            $table->string('block_reason')->nullable();
            $table->double('longitude')->default(0);
            $table->double('latitude')->default(0);
            $table->integer('type')->default(1); //1=>user   //2=>doctor   //3=>Clinical nutritionist
            $table->integer('is_login')->default(0);
            $table->integer('logout_time')->nullable();
            $table->string('face_id_card')->nullable();
            $table->string('back_id_card')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->boolean('is_approved')->default(false); // New column for approval status
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
