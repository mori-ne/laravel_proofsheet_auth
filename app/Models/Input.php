<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use HasFactory;

    // MySQL関連付け
    protected $table = 'inputs';

    // ホワイトリスト
    protected $fillable = [
        'inputType',
        'inputCode',
        'inputTitle',
        'inputLabel',
        'inputLimit',
        'inputContent',
        'checkContent',
        'radioContent',
        'selectContent',
        'isRequired',
        'isOpen',

    ];

    // 子から親（Form <- Input）
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
