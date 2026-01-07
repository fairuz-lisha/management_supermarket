<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {

            // TAMBAH kolom kalau belum ada
            if (!Schema::hasColumn('suppliers', 'supplier_code')) {
                $table->string('supplier_code', 20)->after('id');
            }

            if (!Schema::hasColumn('suppliers', 'supplier_name')) {
                $table->string('supplier_name')->after('supplier_code');
            }

            if (!Schema::hasColumn('suppliers', 'contact_name')) {
                $table->string('contact_name')->nullable()->after('supplier_name');
            }

            if (!Schema::hasColumn('suppliers', 'no_telephone')) {
                $table->string('no_telephone', 20)->after('contact_name');
            }

            if (!Schema::hasColumn('suppliers', 'email')) {
                $table->string('email')->nullable()->after('no_telephone');
            }

            if (!Schema::hasColumn('suppliers', 'address')) {
                $table->text('address')->after('email');
            }

            if (!Schema::hasColumn('suppliers', 'city')) {
                $table->string('city', 100)->nullable()->after('address');
            }

            if (!Schema::hasColumn('suppliers', 'status')) {
                $table->enum('status', ['aktif', 'nonaktif'])
                      ->default('aktif')
                      ->after('city');
            }
        });
    }

    public function down(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn([
                'supplier_code',
                'supplier_name',
                'contact_name',
                'no_telephone',
                'email',
                'address',
                'city',
                'status',
            ]);
        });
    }
};
