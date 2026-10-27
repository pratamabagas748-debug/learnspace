<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel log penambahan XP (untuk Leaderboard Mingguan, Harian, dll)
        if (!Schema::hasTable('xp_logs')) {
            Schema::create('xp_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->integer('points');
                $table->string('source'); // 'lesson_completed', 'pomodoro_session', 'daily_quest'
                $table->string('description')->nullable();
                $table->timestamps();

                $table->index(['user_id', 'created_at']);
                $table->index('created_at');
            });
        }

        // Tabel klaim Misi Harian (Daily Quests)
        if (!Schema::hasTable('user_quests')) {
            Schema::create('user_quests', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->string('quest_key'); // 'daily_lesson', 'daily_focus', 'daily_streak'
                $table->date('quest_date');
                $table->boolean('claimed')->default(false);
                $table->timestamp('claimed_at')->nullable();
                $table->timestamps();

                $table->unique(['user_id', 'quest_key', 'quest_date']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('user_quests');
        Schema::dropIfExists('xp_logs');
    }
};
