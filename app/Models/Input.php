<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use HasFactory;

    // MySQL関連付け
    protected $table = 'input_json';

    // ホワイトリスト
    protected $fillable = [
        'inputs',
        'form_id',
    ];

    // 子から親（Form <- Input）
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
