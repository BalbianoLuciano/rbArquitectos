<?php

namespace App\Models\Projects;

use App\Models\Authors\Articles\Article;
use App\Models\Authors\Author;
use App\Models\Company\Company;
use App\Models\Company\Contribution\Contribution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'direction',
        'description',
        'start',
        'end',
    ];

    /**
     * Get the authors associated with the project.
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'authors_projects', 'project_id', 'author_id')
                    ->withPivot('project_role')
                    ->withTimestamps();
    }

    /**
     * Get the articles associated with the project.
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'project_articles')
                    ->withPivot('project_role')  // O cualquier otra columna que desees.
                    ->withTimestamps();
    }

    /**
     * Get the companies associated with the project through contributions.
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'contributions')
                    ->using(Contribution::class)
                    ->withPivot(['description', 'company_role', 'project_update', 'start', 'end'])
                    ->withTimestamps();
    }
}
