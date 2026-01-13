<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('invoice_number')->after('id')->change();
            $table->dateTime('transaction_date')->after('invoice_number')->change();
            $table->string('customer_name')->after('transaction_date')->change();
            $table->string('customer_address')->after('customer_name')->change();
            $table->string('customer_phone')->after('customer_address')->change();
            $table->string('payment_method')->after('customer_phone')->change();
            $table->decimal('subtotal', 15, 2)->after('payment_method')->change();
            $table->decimal('discount_persent', 5, 2)->after('subtotal')->change();
            $table->decimal('discount_amount', 15, 2)->after('discount_persent')->change();
            $table->decimal('total_payment', 15, 2)->after('discount_amount')->change();
            $table->decimal('amount_received', 15, 2)->after('total_payment')->change();
            $table->decimal('change', 15, 2)->after('amount_received')->change();
            $table->string('status')->after('change')->change();
            $table->text('notes')->nullable()->after('status')->change();
        });
    }

    public function down(): void {}
};
