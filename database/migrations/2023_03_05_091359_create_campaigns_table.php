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
            $table->integer('campaign_priority')->default(2);
            $table->string('sender_name',50);
            $table->string('replay_to',50);
            $table->string('replay_to_name',50);
            $table->string('description')->nullable();
            $table->string('status',30)->default('draft');
            $table->string('target_audience')->default('All');
            $table->string('target_location')->default('All');
            $table->integer('template_id')->default(0);
            $table->integer('total_audience')->default(0);
            $table->integer('audience_done')->default(0);
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
