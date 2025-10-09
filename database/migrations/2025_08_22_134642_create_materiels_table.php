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
        Schema::create('materiels', function (Blueprint $table) {
            $table->id();
            $table->string('code', 200)->unique();
            $table->string('ordi');
            $table->string('type')->nullable();
            $table->string('numero', 200)->nullable()->unique();
            $table->string('capacite')->nullable();
            $table->string('ram')->nullable();
            $table->string('marque');

            $table->enum('apartpers',['oui','non']);
            $table->enum('apartsite',['oui','non']);

            $table->string('etat');


            $table->foreignId('personnel_id')
            ->nullable()
            ->constrained('personnels')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreignId('site_id')
            ->nullable()
            ->constrained('sites')
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
        Schema::dropIfExists('materiels');
    }
};
