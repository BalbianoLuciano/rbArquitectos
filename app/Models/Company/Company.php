<?php

namespace App\Models\Company;

use App\Models\Authors\Author;
use App\Models\Authors\WorkHistory\WorkHistory;
use App\Models\Company\Contribution\Contribution;
use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

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
}
