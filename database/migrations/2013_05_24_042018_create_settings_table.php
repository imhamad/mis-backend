<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->longText('terms_of_use');
            $table->longText('privacy_policy');
            $table->text('app_name')->nullable();
            $table->text('app_logo')->nullable();
            $table->text('app_icon')->nullable();
            $table->text('app_email')->nullable();
            $table->text('app_phone')->nullable();
            $table->text('app_address')->nullable();
            $table->text('about_us')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
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
};
