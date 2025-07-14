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
        Schema::create('incidences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('associate_id');
            $table->foreign('associate_id')->references('id')->on('associates')->onDelete('cascade');
            $table->text('description');
            $table->string('location');
            $table->dateTime('date_reported');
            $table->dateTime('date_resolved')->nullable();
            $table->string('type_incidence');
            $table->decimal('repair_cost', 10, 2)->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidences');
    }
};
