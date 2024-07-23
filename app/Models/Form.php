<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Form extends Model
{
    use HasFactory;

    protected $table = 'forms';

    protected $fillable = [
        'project_id',
        'form_name',
        'form_description',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
