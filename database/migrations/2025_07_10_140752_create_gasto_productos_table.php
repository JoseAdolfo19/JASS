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
        Schema::create('gasto_productos', function (Blueprint $table) {
            $table->id();
            $table->string('description_product');
            $table->string('supplier');
            $table->string('amount');
            $table->decimal('total_cost');
            $table->date('date_buy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gasto_productos');
    }
};
