<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Form extends Model
{
    use HasFactory, SerializeDate;

    // DBとの関連付け
    protected $table = 'forms';

    // ホワイトリスト
    protected $fillable = [
        'project_id',
        'form_name',
        'form_description',
    ];

    // 子から親（Project <- Form）
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // 親から子（Form -> Input）
    public function input()
    {
        return $this->hasOne(Input::class, 'form_id');
    }
}
