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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            $table->string('code', 200)->unique();
            $table->string('name');                     // nom abonnement
            $table->string('entity');                   // entité
            $table->date('subscription_date');          // date début
            $table->date('expiration_date');            // date fin
            $table->integer('remind_before_days');      // ex: 2, 3, 20
            $table->string('type');                     // type abonnement
            $table->string('file_path')->nullable();    // fichier uploadé

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
        Schema::dropIfExists('subscriptions');
    }
};
