<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_number')->unique();

            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('customer_phone');

            $table->string('payment_method');

            $table->decimal('subtotal', 15, 2);
            $table->decimal('discount_persent', 5, 2);
            $table->decimal('discount_amount', 15, 2);

            $table->decimal('total_payment', 15, 2);
            $table->decimal('amount_received', 15, 2);
            $table->decimal('change', 15, 2);

            $table->string('status');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
