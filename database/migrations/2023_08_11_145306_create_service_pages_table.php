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
        Schema::create('service_page', function (Blueprint $table) {
            $table->id();
            $table->text('seo_title')->nullable();
            $table->text('seo_meta_tags')->nullable();
            $table->string('image')->nullable();

            $table->text('services_heroic_block_pre_title')->nullable();
            $table->text('services_heroic_block_title')->nullable();
            $table->string('services_process_image')->nullable();

            $table->text('keywords')->nullable();
            $table->text('og_url')->nullable();
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
        Schema::dropIfExists('service_pages');
    }
};
