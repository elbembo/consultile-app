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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subject');
            $table->string('campaign_priority',50);
            $table->string('sender_name',50);
            $table->string('replay_to',50);
            $table->string('replay_to_name',50);
            $table->string('description')->nullable();
            $table->string('status',30)->nullable();
            $table->string('target_audience')->default('All');
            $table->string('target_location')->default('All');
            $table->integer('template_id')->default(0);
            $table->integer('total_audience')->nullable();
            $table->integer('audience_done')->nullable();
            $table->json('details')->nullable();
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
        Schema::dropIfExists('campaigns');
    }
};
