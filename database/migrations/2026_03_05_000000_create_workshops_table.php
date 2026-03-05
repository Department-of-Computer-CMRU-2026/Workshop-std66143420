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
        Schema::create('workshops', function (Blueprint $挙) {
            $挙->id();
            $挙->string('title');
            $挙->text('description')->nullable();
            $挙->string('speaker_name');
            $挙->integer('capacity');
            $挙->dateTime('start_time');
            $挙->dateTime('end_time');
            $挙->string('location')->nullable();
            $挙->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
