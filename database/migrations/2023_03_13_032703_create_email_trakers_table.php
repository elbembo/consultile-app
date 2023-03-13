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
        Schema::create('email_trakers', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('email_campaign');
            $table->integer('capmaign_id');
            $table->integer('contact_id');
            $table->integer('priority');
            $table->string('massage_id')->unique();
            $table->string('delivered')->nullable();
            $table->string('opend')->nullable();
            $table->integer('views')->nullable();
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
        Schema::dropIfExists('email_trakers');
    }
};
