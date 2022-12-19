<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'programming_language',
        'team_id',
        'leader_id',
        'github_repository',
        'image',
        'status'
    ];
}
