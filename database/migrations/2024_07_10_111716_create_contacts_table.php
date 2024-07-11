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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('de_contact_fullname')->nullable();
            $table->string('de_contact_business_email')->nullable();
            $table->string('de_contacting_organization')->nullable();
            $table->string('de_contacting_phone')->nullable();
            $table->string('de_contacting_country')->nullable();
            $table->text('relationship_to_deknows')->nullable();
            $table->text('de_job_title')->nullable();
            $table->text('how_can_we_help_you')->nullable();
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
        Schema::dropIfExists('contacts');
    }
};
