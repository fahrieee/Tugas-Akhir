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
        Schema::create('mandors', function (Blueprint $table) {
            $table->id();
            $table->integer('pengawas_id')->nullable()->index();
            $table->string('pengawas_status')->nullable();
            $table->string('nama');
            $table->string('kategori');
            $table->integer('periode');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('mandors');
    }
};
