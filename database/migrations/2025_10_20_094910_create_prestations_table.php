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
        Schema::create('prestations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('code', 200)->unique();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->default('Prestation planifier')->nullable();
            $table->date('pest_date')->nullable();
            $table->integer('duration_days')->nullable();
            $table->string('observation')->nullable();
            $table->date('obs_debut_date')->nullable();
            $table->date('obs_fin_date')->nullable();
            $table->time('obs_debut_time')->nullable();
            $table->time('obs_fin_time')->nullable();
            $table->string('montant')->default(0)->nullable();
            $table->string('file_path')->nullable();
            $table->date('pest_fin_date')->nullable();

            $table->foreignId('user_id')
            ->nullable()
            ->constrained('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('prestations');
    }
};
