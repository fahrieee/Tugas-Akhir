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
        Schema::dropIfExists('pembayarans');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tagihan_id')->index();
            $table->foreignId('pengawas_id')->index();
            $table->dateTime('tanggal_bayar');
            $table->string('status_konfirmasi')->nullable();
            $table->double('jumlah_bayar');
            $table->string('bukti_bayar')->nullable();
            $table->string('metode_pembayaran');
            $table->foreignId('user_id')->nullable()->index();
            $table->timestamps();
        });
    }
};
