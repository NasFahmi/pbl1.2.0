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
        Schema::create('beban_kewajibans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_beban_kewajiban_id');
            $table->string('nama');
            $table->string('nominal');
            $table->timestamp('tanggal');
            $table->softDeletes();
            $table->foreign('jenis_beban_kewajiban_id')->references('id')->on('jenis_beban_kewajibans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beban_kewajibans');
    }
};
