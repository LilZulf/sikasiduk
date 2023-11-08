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
        Schema::create('tps', function (Blueprint $table) {
            $table->string('tps')->primary();
            $table->string('nama_tps');
            $table->string('alamat');
            $table->integer('rt');
            $table->integer('rw');
            $table->string('foto');
            $table->string('long')->nullable();
            $table->string('lat')->nullable();
            $table->string('uid');
            $table->smallInteger('status');
            $table->integer('id_alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tps');
    }
};
