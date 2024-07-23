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
        Schema::create('forms', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->unsignedBigInteger('project_id')->comment('プロジェクトID:FK');
            $table->string('form_name', 100)->required()->comment('フォーム名');
            $table->text('form_description')->nullable()->comment('フォームの説明');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
