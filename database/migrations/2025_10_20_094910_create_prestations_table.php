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
            $table->string('status')->default(false)->nullable();
            $table->date('pest_date')->nullable();
            $table->integer('duration_days')->nullable();
            $table->enum('patr', ['oui','non']);
            $table->string('montant')->default(0)->nullable();
            $table->string('file_path')->nullable();

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
