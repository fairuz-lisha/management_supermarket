<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {

            // RENAME name -> supplier_name
            if (Schema::hasColumn('suppliers', 'name') && !Schema::hasColumn('suppliers', 'supplier_name')) {
                $table->renameColumn('name', 'supplier_name');
            }

            // RENAME phone -> no_telephone
            if (Schema::hasColumn('suppliers', 'phone') && !Schema::hasColumn('suppliers', 'no_telephone')) {
                $table->renameColumn('phone', 'no_telephone');
            }
        });
    }

    public function down(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            // Revert RENAME supplier_name -> name
            if (Schema::hasColumn('suppliers', 'supplier_name') && !Schema::hasColumn('suppliers', 'name')) {
                $table->renameColumn('supplier_name', 'name');
            }
            
            // Revert RENAME no_telephone -> phone
            if (Schema::hasColumn('suppliers', 'no_telephone') && !Schema::hasColumn('suppliers', 'phone')) {
                $table->renameColumn('no_telephone', 'phone');
            }
        });
    }
};
