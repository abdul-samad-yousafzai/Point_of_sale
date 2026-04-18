<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            if (!Schema::hasColumn('sales', 'total')) {
                $table->decimal('total', 10, 2)->default(0)->after('invoice_no');
            }
            if (!Schema::hasColumn('sales', 'tax')) {
                $table->decimal('tax', 10, 2)->default(0)->after('total');
            }
            if (!Schema::hasColumn('sales', 'discount')) {
                $table->decimal('discount', 10, 2)->default(0)->after('tax');
            }
            if (!Schema::hasColumn('sales', 'customer_name')) {
                $table->string('customer_name')->nullable()->after('discount');
            }
            if (!Schema::hasColumn('sales', 'customer_phone')) {
                $table->string('customer_phone')->nullable()->after('customer_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            if (Schema::hasColumn('sales', 'total')) $table->dropColumn('total');
            if (Schema::hasColumn('sales', 'tax')) $table->dropColumn('tax');
            if (Schema::hasColumn('sales', 'discount')) $table->dropColumn('discount');
            if (Schema::hasColumn('sales', 'customer_name')) $table->dropColumn('customer_name');
            if (Schema::hasColumn('sales', 'customer_phone')) $table->dropColumn('customer_phone');
        });
    }
};
