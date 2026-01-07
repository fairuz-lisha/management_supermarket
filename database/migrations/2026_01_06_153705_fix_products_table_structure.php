<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // RENAME kolom lama → baru
            if (Schema::hasColumn('products', 'code')) {
                $table->renameColumn('code', 'product_code');
            }

            if (Schema::hasColumn('products', 'name')) {
                $table->renameColumn('name', 'product_name');
            }

            if (Schema::hasColumn('products', 'price')) {
                $table->renameColumn('price', 'sale_price');
            }

            // TAMBAH kolom baru
            if (!Schema::hasColumn('products', 'purchase_price')) {
                $table->decimal('purchase_price', 12, 2)
                      ->nullable()
                      ->after('product_name');
            }

            if (!Schema::hasColumn('products', 'minimum_stock')) {
                $table->integer('minimum_stock')
                      ->nullable()
                      ->after('stock');
            }

            if (!Schema::hasColumn('products', 'unit')) {
                $table->string('unit', 20)
                      ->nullable()
                      ->after('minimum_stock');
            }

            if (!Schema::hasColumn('products', 'status')) {
                $table->enum('status', ['aktif', 'nonaktif'])
                      ->default('aktif')
                      ->after('unit');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // BALIKKAN rename
            if (Schema::hasColumn('products', 'product_code')) {
                $table->renameColumn('product_code', 'code');
            }

            if (Schema::hasColumn('products', 'product_name')) {
                $table->renameColumn('product_name', 'name');
            }

            if (Schema::hasColumn('products', 'sale_price')) {
                $table->renameColumn('sale_price', 'price');
            }

            // HAPUS kolom tambahan
            $table->dropColumn([
                'purchase_price',
                'minimum_stock',
                'unit',
                'status'
            ]);
        });
    }
};
