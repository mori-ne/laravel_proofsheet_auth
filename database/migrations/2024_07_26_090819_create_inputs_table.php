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
        Schema::create('inputs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pos')->default(0)->comment('並び順');
            $table->unsignedBigInteger('form_id')->unique()->comment('FK:フォームID');
            $table->string('inputType', 100)->required()->comment('入力タイプ');
            $table->string('inputCode', 100)->required()->comment('コード');
            $table->string('inputTitle', 255)->nullable()->comment('タイトル');
            $table->text('inputLabel')->nullable()->comment('ラベル');
            $table->unsignedBigInteger('inputLimit')->nullable()->comment('文字数制限');
            $table->text('inputContent')->nullable()->comment('入力内容');
            $table->text('checkContent')->nullable()->comment('チェックボックス項目'); // json型がいい？
            $table->text('radioContent')->nullable()->comment('ラジオ項目');
            $table->text('selectContent')->nullable()->comment('セレクト項目');
            $table->boolean('isRequired')->default(false)->required()->comment('必須項目 0:許容 1:必須');
            $table->boolean('isOpen')->default(false)->required()->comment('input開閉項目 0:閉じる 1:開く');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inputs');
    }
};
