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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('code', 200)->unique();

            $table->string('date_panne')->nullable()->default(0);
            $table->string('observation')->nullable();
            $table->string('motif')->nullable();
            $table->string('dure')->nullable()->default(0);
            $table->string('status')->nullable()->default('En Reparation');
            $table->longText('reparation')->nullable();

            $table->foreignId('materiel_id')
            ->nullable()
            ->constrained('materiels')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->foreignId('user_id')
            ->nullable()
            ->constrained('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenances');
    }
};
