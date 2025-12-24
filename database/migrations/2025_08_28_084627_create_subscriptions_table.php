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

            $table->date('subscription_date');          // date début
            $table->date('expiration_date');            // date fin
            $table->integer('remind_before_days');      // ex: 2, 3, 20
            $table->string('type');                     // type abonnement


            $table->boolean('position')->default(false)->nullable();
            $table->boolean('status')->default(true)->nullable();
            $table->boolean('resilier')->default(false)->nullable();
            $table->boolean('qnadb')->default(false)->nullable();

            $table->string('motif')->nullable();

            $table->foreignId('parent_id')              // abonnement précédent
        ->nullable()
        ->constrained('subscriptions')
        ->onDelete('cascade');


            $table->foreignId('client_id')
            ->nullable()
            ->constrained('clients')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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
