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
        Schema::create('home_page', function (Blueprint $table) {
            $table->id();
            $table->text('seo_title')->nullable();
            $table->text('seo_meta_tags')->nullable();
            $table->string('image')->nullable();
            $table->text('countries')->nullable();
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
        Schema::dropIfExists('home_pages');
    }
};
