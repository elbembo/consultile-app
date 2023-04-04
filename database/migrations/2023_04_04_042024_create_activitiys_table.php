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
        Schema::create('activitiys', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->string('url')->nullable();
            $table->string('account',50)->nullable();
            $table->string('action',50)->nullable();
            $table->integer('connections_count')->nullable();
            $table->integer('new_opportunities')->nullable();
            $table->integer('type')->default(1);
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
        Schema::dropIfExists('activitiys');
    }
};
