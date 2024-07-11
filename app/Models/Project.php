<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // DBとの関連付け
    protected $table = 'projects';

    // ホワイトリスト
    protected $fillable = [
        'uuid',
        'project_name',
        'description',
        'status',
        'is_deadline',
    ];

    // 日付形式としてキャスト
    protected $dates = [
        'is_deadline',
    ];
}
