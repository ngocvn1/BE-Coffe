<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('danh_mucs', function (Blueprint $table) {
            $table->id();
            $table->string('ten_danh_muc');
            $table->string('slug_danh_muc');
            $table->integer('id_danh_muc_cha');
            $table->integer('tinh_trang');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('danh_mucs');
    }
};
