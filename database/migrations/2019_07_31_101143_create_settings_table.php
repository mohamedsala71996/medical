<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('logo')->nullable();
            $table->string('login_banner')->nullable();
            $table->string('image_slider')->nullable();

            $table->string('en_title')->nullable();
            $table->string('ar_title')->nullable();

            $table->string('address1')->nullable();
            $table->string('address2')->nullable();

            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();

            $table->string('fax')->nullable();

            $table->string('android_app')->nullable();
            $table->string('ios_app')->nullable();

            $table->string('email1')->nullable();
            $table->string('email2')->nullable();

            $table->string('link')->nullable();
            $table->longText('ar_des')->nullable();
            $table->longText('en_des')->nullable();

            $table->double('latitude')->default(0);
            $table->double('longitude')->default(0);
            $table->string('address')->default(0);

            $table->string('sms_user_name')->nullable();
            $table->string('sms_user_pass')->nullable();

            $table->string('sms_sender')->nullable();

            $table->string('publisher')->nullable();

            $table->string('default_language')->default('ar');
            $table->string('default_theme')->nullable();
            $table->string('offer_muted')->nullable();
            $table->integer('offer_notification')->default(1);


            $table->integer('site_commission')->default(1);
            $table->integer('driver_debt_limit')->default(1);
            $table->integer('driver_max_current_order')->default(1);


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
        Schema::dropIfExists('settings');
    }
}
