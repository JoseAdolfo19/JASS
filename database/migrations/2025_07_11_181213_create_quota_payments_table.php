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
        Schema::create('quota_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_associate');
            $table->foreign('id_associate')->references('id')->on('associates')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('expiration_date');
            $table->date('issue_date');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quota_payments');
    }
};
