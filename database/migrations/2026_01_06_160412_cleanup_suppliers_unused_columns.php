<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {

            // kolom lama yang sering bikin konflik
            if (Schema::hasColumn('suppliers', 'name')) {
                $table->dropColumn('name');
            }

            if (Schema::hasColumn('suppliers', 'phone')) {
                $table->dropColumn('phone');
            }

            if (Schema::hasColumn('suppliers', 'telephone')) {
                $table->dropColumn('telephone');
            }

            if (Schema::hasColumn('suppliers', 'contact')) {
                $table->dropColumn('contact');
            }
        });
    }

    public function down(): void
    {
        // tidak perlu rollback, ini migration pembersihan
    }
};
