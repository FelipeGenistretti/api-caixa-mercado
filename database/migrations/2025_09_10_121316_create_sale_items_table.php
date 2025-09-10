<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->uuid('id')->primary();         // PK UUID
            $table->uuid('sale_id');               // FK para sales.id
            $table->uuid('product_id');            // FK para products.id
            $table->integer('quantity');           // Quantidade do produto
            $table->decimal('price', 10, 2);       // Preço unitário
            $table->timestamps();

            // Foreign keys
            $table->foreign('sale_id')
                  ->references('id')
                  ->on('sales')
                  ->onDelete('cascade');

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
