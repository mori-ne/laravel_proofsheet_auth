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
            $table->unsignedBigInteger('id')->primary()->autoIncrement();
            $table->string('project_name', 100)->comment('プロジェクト名');
            $table->uuid('uuid')->unique()->default(DB::raw('uuid()'))->comment('UUID');
            $table->text('description')->nullable()->comment('説明');
            $table->boolean('status')->default(0)->comment('0:無効・1:有効');
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
