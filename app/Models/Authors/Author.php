<?php

namespace App\Models\Authors;

use App\Models\Authors\Articles\Article;
use App\Models\Authors\WorkHistory\WorkHistory;
use App\Models\Company\Company;
use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Author extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $primaryKey = 'author_id';

    protected $fillable = [
        'user_id',
        'name',
        'biography',
        'date_of_birth', 
        'place_of_birth', 
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
                    ->using(WorkHistory::class)
                    ->withPivot(['position', 'start', 'end'])
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
