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
        Schema::create('basis_kasus', function (Blueprint $table) {
            $table->id();
            $table->string('id_basis_kasus', 10)->unique();
            $table->string('nama_basis_kasus');
            $table->string('detail_basis_kasus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basis_kasus');
    }
};
