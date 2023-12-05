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
        Schema::create('about_page', function (Blueprint $table) {
            $table->id();
            $table->text('seo_title')->nullable();
            $table->text('seo_meta_tags')->nullable();
            $table->string('image')->nullable();

            $table->text('about_heroic_block_pre_title')->nullable();
            $table->text('about_heroic_block_title')->nullable();
            $table->string('about_cta_link')->nullable();
            $table->longText('about_open_source_culture')->nullable();

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
        Schema::dropIfExists('about_pages');
    }
};
