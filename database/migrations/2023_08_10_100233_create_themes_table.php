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
        Schema::create('theme', function (Blueprint $table) {
            $table->id();
            $table->text('about_heroic_block_pre_title')->nullable();
            $table->text('about_heroic_block_title')->nullable();
            $table->string('about_cta_link')->nullable();
            $table->longText('about_open_source_culture')->nullable();

            $table->text('services_heroic_block_pre_title')->nullable();
            $table->text('services_heroic_block_title')->nullable();
            $table->string('services_process_image')->nullable();

            $table->text('casestudy_heroic_block_pre_title')->nullable();
            $table->text('casestudy_heroic_block_title')->nullable();
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
        Schema::dropIfExists('theme');
    }
};
