<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrePostUser extends Model
{
    use HasFactory;

    protected $table = 'pre_postuser';

    protected $fillable = [
        'email',
    ];
}
