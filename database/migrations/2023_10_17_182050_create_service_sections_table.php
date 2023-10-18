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
        Schema::create('service_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->string('breadcrumb_title')->nullable();
            $table->string('breadcrumb_slug')->nullable();
            $table->text('service_title')->nullable();
            $table->text('service_description')->nullable();
            $table->string('service_background_color')->nullable();
            $table->string('service_content_direction')->default('ltr');
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
        Schema::dropIfExists('service_sections');
    }
};
