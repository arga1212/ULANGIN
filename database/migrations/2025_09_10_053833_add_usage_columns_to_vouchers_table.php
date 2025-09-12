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
    Schema::table('vouchers', function (Blueprint $table) {
        // Kolom untuk menyimpan ID user yang menggunakan voucher
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->after('is_active');
        
        // Kolom untuk menyimpan waktu penggunaan
        $table->timestamp('used_at')->nullable()->after('user_id');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vouchers', function (Blueprint $table) {
            //
        });
    }
};
