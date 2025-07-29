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
        Schema::table('todos', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
//onDelete('cascade')=ユーザーが削除されたら、それに紐づいたToDoも一緒に削除される
//constrained()=外部キー制約をつける
//foreignId('user_id')=user_id というカラムを作る
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // 外部キー制約を削除
            $table->dropColumn('user_id'); // カラムを削除
        });
    }
};
