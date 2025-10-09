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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('left_signatory_id')->default(0);
            $table->foreignId('right_signatory_id')->default(0);
            $table->date('signature_date')->nullable();
            $table->string('qr_sl', 100)->nullable();
            $table->string('qr_code_id', 100)->nullable();
            $table->string('brtc_no', 100)->nullable();
            $table->date('brtc_date')->nullable();
            $table->string('ref_no', 100)->nullable();
            $table->date('ref_date')->nullable();
            $table->text('sent_by')->nullable();
            $table->text('sample')->nullable();
            $table->text('sample_note')->nullable();
            $table->text('project')->nullable();
            $table->string('location', 255)->nullable();
            $table->string('test_name', 255)->nullable();
            $table->date('date_of_test')->nullable();
            $table->integer('total_day_of_test')->default(1);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
