<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
        $table->string('invoice_number')->after('id');
        $table->string('transaction_date')->nullable();
        $table->integer('discount_persent')->default(0);
        $table->integer('discount_amount')->default(0);
        $table->integer('total_payment')->after('subtotal');
        $table->integer('amount_received')->nullable();
        $table->integer('change')->nullable();
        $table->text('notes')->nullable();

        // OPTIONAL: hapus kolom lama
        $table->dropColumn(['transaction_code', 'discount', 'total']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
