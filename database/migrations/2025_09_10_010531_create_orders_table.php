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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('customer_name');
        $table->string('customer_email');
        $table->string('customer_phone');
        $table->text('customer_address');
        $table->decimal('total_price', 15, 2);
        $table->string('status')->default('waiting'); // waiting, process, dikirim, done
        $table->string('payment_proof')->nullable(); // Path ke file bukti pembayaran
        $table->string('shipping_receipt')->nullable(); // Nomor resi pengiriman
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
