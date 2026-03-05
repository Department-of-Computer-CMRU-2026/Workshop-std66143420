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
        Schema::create('registrations', function (Blueprint $挙) {
            $挙->id();
            $挙->foreignId('workshop_id')->constrained()->cascadeOnDelete();
            $挙->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $挙->string('student_id');
            $挙->string('student_name');
            $挙->timestamps();
            
            // ป้องกันการลงทะเบียนซ้ำในหัวข้อเดียวกันสำหรับรหัสนักศึกษาเดิม
            $挙->unique(['workshop_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
