<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class mapelsiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapelsiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mapel')->constrained('mapel')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_siswa')->constrained('siswa')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->unique(['id_mapel', 'id_siswa']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas_siswa');
    }
}
