<?php

namespace App\Models\Authors;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $primaryKey = 'author_id';

    protected $fillable = [
        'user_id',
        'name',
        'biography',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'authors_projects', 'author_id', 'project_id')
                    ->withPivot('project_role')
                    ->withTimestamps();
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'work_histories', 'author_id', 'company_id')
                    ->withPivot(['position', 'start', 'end'])
                    ->withTimestamps();
    }
}
