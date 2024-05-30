<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik');
            $table->bigInteger('no_kk');
            $table->string('nama');
            $table->date('tgl_lahir');
            $table->boolean('jenkel');
            $table->tinyInteger('agama');
            $table->bigInteger('no_tlp');
            $table->string('alamat');
            $table->string('email');
            $table->string('dokumen');
            $table->boolean('is_valid')->default(false);
            $table->timestamp('validated_at')->nullable();
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
        Schema::dropIfExists('pasiens');
    }
}
