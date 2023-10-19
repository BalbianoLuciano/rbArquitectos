<?php

namespace App\Models\Projects;

use App\Models\Authors\Articles\Article;
use App\Models\Authors\Author;
use App\Models\Company\Company;
use App\Models\Company\Contribution\Contribution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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
        return $this->belongsToMany(Company::class, 'contributions', 'project_id', 'company_id')
                    ->using(Contribution::class)
                    ->withPivot(['description', 'company_role', 'project_update', 'start', 'end'])
                    ->withTimestamps();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->useDisk('media')
            ->withResponsiveImages()
            ->singleFile();
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }
}
