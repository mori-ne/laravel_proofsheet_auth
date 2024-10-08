<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Form;

class Project extends Model
{
    use HasFactory, SerializeDate;

    // DBとの関連付け
    protected $table = 'projects';

    // ホワイトリスト
    protected $fillable = [
        'uuid',
        'project_name',
        'project_message',
        'project_description',
        'status',
        'is_deadline',
        'mail_subject',
        'mail_content',
        'created_at',
        'updated_at',
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

    // 親から子（Project -> Form）
    public function forms()
    {
        return $this->hasMany(Form::class, 'project_id');
    }
}
