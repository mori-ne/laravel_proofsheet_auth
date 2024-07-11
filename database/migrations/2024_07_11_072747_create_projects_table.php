<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->autoIncrement()->comment('ID');
            $table->string('project_name', 100)->comment('プロジェクト名');
            $table->uuid('uuid')->unique()->comment('UUID');
            $table->text('description')->nullable()->comment('説明');
            $table->boolean('status')->default(0)->comment('0:無効・1:有効');
            $table->string('mail_subject', 255)->nullable()->comment('返信メール件名');
            $table->text('mail_content')->nullable()->comment('返信メール内容');
            $table->timestamp('is_deadline')->nullable()->comment('公開期限');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
