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
        Schema::create('rekam_meds', function (Blueprint $table) {
            $table->id('id_rm');
            $table->integer('id_pasien');
            $table->integer('id_dokter');
            $table->integer('id_diagnosis');
            $table->string('keluhan', 45);
            $table->text('anamnesis');
            $table->text('pfisik');
            $table->text('id_labs')->nullable();
            $table->text('hasil_labs')->nullable();
            // Lampiran lab
            $table->text('id_obats')->nullable();
            $table->text('jumlah_obats')->nullable();
            $table->text('aturan_obats')->nullable();
            $table->tinyInteger('status_lab');
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_meds');
    }
};
