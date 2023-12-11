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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->text('seo_title')->nullable();
            $table->text('seo_meta_tags')->nullable();
            $table->string('image')->nullable();

            $table->text('service_pre_title')->nullable();
            $table->text('service_title')->nullable();
            $table->text('service_description')->nullable();
            $table->string('service_icon')->nullable();

            $table->string('client_name')->nullable();
            $table->string('client_designation')->nullable();
            $table->text('client_review')->nullable();
            $table->string('client_image')->nullable();

            $table->text('keywords')->nullable();
            $table->text('og_url')->nullable();
            $table->string('process_image')->nullable();
            $table->string('video')->nullable();
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
        Schema::dropIfExists('services');
    }
};
