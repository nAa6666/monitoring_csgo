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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('map');
            $table->string('game');
            $table->integer('players');
            $table->integer('maxplayers');
            $table->integer('bots');
            $table->string('os');
            $table->string('version');
            $table->string('ip');
            $table->string('port');
            $table->string('specport')->nullable();
            $table->string('mode');
            $table->string('country');
            $table->longText('players_list')->nullable();
            $table->string('password');
            $table->string('status');
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
        Schema::dropIfExists('servers');
    }
};
