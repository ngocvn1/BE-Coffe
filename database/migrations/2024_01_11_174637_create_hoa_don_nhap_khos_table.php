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
        Schema::create('hoa_don_nhap_khos', function (Blueprint $table) {
            $table->id();
            $table->string('ma_hoa_don')->nullable();
            $table->string('tong_tien')->nullable();
            $table->integer('id_nhan_vien');
            $table->integer('id_nha_cung_cap');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_don_nhap_khos');
    }
};
