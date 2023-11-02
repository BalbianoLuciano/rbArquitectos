<?php

namespace App\Models\Company;

use App\Models\Authors\Author;
use App\Models\Authors\WorkHistory\WorkHistory;
use App\Models\Company\Contribution\Contribution;
use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Company extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $primaryKey = 'company_id';

    protected $fillable = [
        'name',
        'direction',
        'description',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'work_histories', 'company_id', 'author_id')
                    ->using(WorkHistory::class)
                    ->withPivot(['position', 'start', 'end'])
                    ->withTimestamps();
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'contributions', 'company_id', 'project_id')
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
