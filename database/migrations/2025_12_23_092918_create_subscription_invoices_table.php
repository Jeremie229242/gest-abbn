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
        Schema::create('subscription_invoices', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_number', 200)->unique();
            $table->date('invoice_date');
            $table->date('due_date')->nullable(); // date limite paiement

            $table->decimal('amount', 15, 2);
            $table->string('currency', 10)->default('XAF');

            $table->enum('status', [
                'unpaid',
                'paid',
                'partial',
                'cancelled'
            ])->default('unpaid');

            $table->date('paid_at')->nullable();

            $table->string('payment_method')->nullable(); // cash, mobile money, bank
            $table->string('transaction_ref')->nullable();

            $table->string('file_path')->nullable(); // PDF facture

            $table->foreignId('subscription_id')
                ->constrained('subscriptions')
                ->cascadeOnDelete();

            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete();

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
        Schema::dropIfExists('subscription_invoices');
    }
};
