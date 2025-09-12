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
    Schema::table('order_items', function (Blueprint $table) {
        // Tambahkan kolom untuk menyimpan ID varian
        $table->foreignId('product_variant_id')->nullable()->constrained()->onDelete('set null')->after('product_id');
        // Tambahkan kolom untuk menyimpan ukuran (data historis)
        $table->string('size')->nullable()->after('product_variant_id');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
        });
    }
};
