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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('left_signatory_id')->default(0);
            $table->foreignId('right_signatory_id')->default(0);
            $table->string('qr_code_id')->nullable();       // e.g. 5Xg7htz7Z
            $table->string('brtc_no')->nullable();          // e.g. 1103-54536/CE/24-25
            $table->date('brtc_date')->nullable();          // e.g. 17/06/2025
            $table->string('ref_no')->nullable();           // Ref No.
            $table->date('ref_date')->nullable();
            $table->string('sent_by')->nullable();          // Person / org sending sample
            $table->text('sample')->nullable();             // Sample description
            $table->string('project')->nullable();          // Project name
            $table->string('location')->nullable();         // e.g. Floor Casting
            $table->string('test_name')->nullable();        // e.g. Compressive Strength Test
            $table->date('date_of_test')->nullable();
            $table->text('notes')->nullable();              // "Samples received sealed"
            $table->string('page_ref')->nullable();         // "Page 1 of 2"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
