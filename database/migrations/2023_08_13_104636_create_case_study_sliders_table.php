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
        Schema::create('case_study_sliders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_study_id');
            $table->string('title')->nullable();
            $table->text('descriptive_title')->nullable();
            $table->string('image')->nullable();
            $table->string('cta')->nullable();
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
        Schema::dropIfExists('case_study_sliders');
    }
};
