<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_kirims')->nullable()->constrained('kirims')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_metodes')->nullable()->constrained('metodes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode')->nullable();
            $table->integer('jumlah_barang');
            $table->integer('sub_total');
            $table->integer('harga_total');
            $table->date('tanggal')->nullable();
            $table->enum('status_bayar', ['belum_bayar', 'sudah_bayar']);
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
        Schema::dropIfExists('keranjangs');
    }
}
