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
        Schema::create('hoa_don_khach_hangs', function (Blueprint $table) {
            $table->id();
            $table->integer('tong_tien_truoc_giam')->nullable();
            $table->integer('phan_tram_giam')->nullable();
            $table->integer('tien_thuc_nhan')->nullable();
            $table->string('ghi_chu')->nullable();
            $table->integer('id_ban');
            $table->integer('is_done')->default(0);
            $table->integer('id_nhan_vien')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_don_khach_hangs');
    }
};
