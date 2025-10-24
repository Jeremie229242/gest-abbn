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
        Schema::create('prestation_observations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestation_id')
                ->constrained('prestations')
                ->onDelete('cascade');

            $table->text('observation')->nullable();
            $table->date('obs_debut_date')->nullable();
            $table->date('obs_fin_date')->nullable();
            $table->time('obs_debut_time')->nullable();
            $table->time('obs_fin_time')->nullable();
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
        Schema::dropIfExists('prestation_observations');
    }
};
