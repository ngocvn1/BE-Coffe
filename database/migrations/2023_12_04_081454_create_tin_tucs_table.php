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
        Schema::create('tin_tucs', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de_tin_tuc');
            $table->string('slug_tin_tuc');
            $table->string('hinh_anh_tin_tuc');
            $table->text('mo_ta_ngan_tin_tuc');
            $table->longText('mo_ta_chi_tiet_tin_tuc');
            $table->integer('id_chuyen_muc_tin_tuc');
            $table->integer('tinh_trang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tin_tucs');
    }
};
