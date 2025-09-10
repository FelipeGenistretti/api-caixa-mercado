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
        Schema::create('sales', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('custumer_id')->constrained('costumers')->onDelete('cascade');
            $table->decimal('total', 10, 2);
            $table->enum('payment_type', ['dinheiro', 'cartao', 'pix', 'cheque']);
            $table->enum('status', ['concluida', 'cancelada', 'pendente'])->default('concluida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
