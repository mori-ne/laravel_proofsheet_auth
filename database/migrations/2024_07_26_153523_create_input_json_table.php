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
        Schema::create('input_json', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id')->comment('FK:フォームID');
            $table->json('inputs')->nullable()->comment('入力項目');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_json');
    }
};
