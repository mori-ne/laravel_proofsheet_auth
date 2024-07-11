<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'mail_subject',
        'mail_content',
    ];

    // 日付形式としてキャスト
    protected $dates = [
        'is_deadline',
    ];

    // UUIDを生成するイベントを追加
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}
