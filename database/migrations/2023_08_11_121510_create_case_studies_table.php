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
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->text('seo_title')->nullable();
            $table->text('seo_meta_tags')->nullable();
            $table->string('image')->nullable();

            $table->string('title')->nullable();
            $table->string('button_title')->nullable();
            $table->string('cta')->nullable();
            $table->string('case_study_image')->nullable();
            $table->text('tags')->nullable();
            $table->longText('about_the_client')->nullable();
            $table->longText('industry_of_client')->nullable();
            $table->string('industry_of_client_image')->nullable();
            $table->longText('challenge')->nullable();
            $table->longText('value')->nullable();
            $table->longText('project_credit')->nullable();
            $table->integer('category_id')->nullable();

            // client rivew
            $table->string('client_name')->nullable();
            $table->string('client_designation')->nullable();
            $table->longText('client_review')->nullable();
            $table->string('client_image')->nullable();
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
        Schema::dropIfExists('case_studies');
    }
};
