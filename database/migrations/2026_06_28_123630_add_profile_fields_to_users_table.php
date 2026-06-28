<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom profil jika belum ada
            if (!Schema::hasColumn('users', 'prodi')) {
                $table->string('prodi')->nullable();
            }
            if (!Schema::hasColumn('users', 'semester')) {
                $table->unsignedTinyInteger('semester')->nullable();
            }
            if (!Schema::hasColumn('users', 'whatsapp_number')) {
                $table->string('whatsapp_number')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['prodi', 'semester', 'whatsapp_number']);
        });
    }
};
