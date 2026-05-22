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
    Schema::create('role_applications', function (Blueprint $table) {
        $table->id();
        // Relasi ke id di tabel users. Jika user dihapus, pengajuannya ikut terhapus.
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('organization_name');
        $table->text('reason');
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_applications');
    }
};
