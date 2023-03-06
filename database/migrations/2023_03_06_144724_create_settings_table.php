<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value')->nullable();
            $table->timestamps();
        });
        DB::table('settings')->insert([
            [
                'key' => 'stmp_sender_name',
                'value' => 'Consultile'
            ],
            [
                'key' => 'stmp_replay_email',
                'value' => 'info@consultile.com'
            ],
            [
                'key' => 'stmp_replay_name',
                'value' => 'Consultile '
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
