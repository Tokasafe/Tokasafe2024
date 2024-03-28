<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hazard_ids', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique()->nullable();
            $table->date('tanggal_kejadian')->nullable();
            $table->date('tanggal_tutup')->nullable();
            $table->string('waktu')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('closeby')->nullable();
            $table->string('documentation')->nullable();
            $table->text('rincian_bahaya')->nullable();
            $table->text('tindakan_perbaikan')->nullable();
            $table->text('tindakan_perbaikan_disarankan')->nullable();
            $table->text('komentar')->nullable();
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hazard_ids');
    }
};
