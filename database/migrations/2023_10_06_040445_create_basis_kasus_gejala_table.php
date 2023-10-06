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
        Schema::create('basis_kasus_gejala', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gejala_id');
            $table->unsignedBigInteger('basis_kasus_id');
            $table->timestamps(); // This line is correct and should be kept.

            $table->foreign('gejala_id')->references('id')->on('gejala')->onDelete('cascade');
            $table->foreign('basis_kasus_id')->references('id')->on('basis_kasus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basis_kasus_gejala');
    }
};
