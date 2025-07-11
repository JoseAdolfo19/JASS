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
        Schema::create('reported_incidences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_associates');
            $table->foreign('id_associates')
                ->references('id')
                ->on('associates')
                ->onDelete('cascade');
            $table->text('description');
            $table->string('type_incidence');
            $table->date('date_reported');
            $table->date('date_resolved')->nullable();
            $table->string('location');
            $table->decimal('repair_cost', 10, 2)->nullable();
            $table->boolean('status')->default(false); // false for unresolved, true for resolved
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reported_incidences');
    }
};
