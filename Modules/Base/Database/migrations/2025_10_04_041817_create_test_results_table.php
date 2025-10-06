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
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_id');  // FK to reports
            $table->date('date_of_casting')->nullable();
            $table->string('specimen_designation')->nullable(); // e.g. PA
            $table->decimal('specimen_area', 8, 2)->nullable(); // sq in
            $table->decimal('maximum_load', 10, 2)->nullable(); // lb
            $table->decimal('crushing_strength', 10, 2)->nullable(); // psi
            $table->decimal('average_strength', 10, 2)->nullable();
            $table->string('mode_of_failure')->nullable(); // Combined, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
